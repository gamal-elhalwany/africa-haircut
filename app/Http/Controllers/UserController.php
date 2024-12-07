<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Job;
use App\Models\User;
use App\Models\Chair;
use App\Models\Daily;
use App\Models\Branch;
use Illuminate\Support\Arr;
use App\Models\ChairProcess;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use App\Http\Requests\CreateUserRequest;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:انشاء-مستخدم|تعديل-مستخدم|حذف-مستخدم', ['only' => ['index', 'show']]);
        $this->middleware('permission:انشاء-مستخدم|تعديل-مستخدم|حذف-مستخدم', ['only' => ['create', 'store']]);
        $this->middleware('permission:انشاء-مستخدم|تعديل-مستخدم|حذف-مستخدم', ['only' => ['edit', 'update']]);
        $this->middleware('permission:انشاء-مستخدم|تعديل-مستخدم|حذف-مستخدم', ['only' => ['destroy']]);
    }

    public function loginPage()
    {
        $user = auth()->user();
        if (!$user) {
            return view('dashboard.login');
        }
        return redirect()->route('dashboard.index');
    }

    //Login method
    public  function LoginMethod(Request $request)
    {
        try {
            $user = User::where('email', $request->email)->first();
            if ($user) {
                Auth::login($user);
                toastr()->success('تم تسجيل الدخول بنجاح.');
                return Redirect::route('dashboard.index');
            }
            return Redirect::back()->withErrors(['error' => 'البيانات غير صحيحة!']);
        } catch (Exception $e) {
            throw $e;
        }
    }

    // Index dashboard method
    public function IndexMethod()
    {
        $Available = Chair::where('status', 'available')->get();
        $Busy = Chair::where('status', 'busy')->get();
        $users = User::with('branch')->with('chair')->with('job')->get();

        return view('dashboard.index', compact('Available', 'Busy', 'users'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::orderBy('id', 'DESC')->get();

        return view('dashboard.users.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        $branches = Branch::all();
        $jobs = Job::all();
        return view('dashboard.users.create', compact('roles', 'branches', 'jobs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        toastr()->success('تم إنشاء المستخدم بنجاح');
        return redirect()->route('dashboard.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('dashboard.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();

        $branches = Branch::all();
        $jobs = Job::all();

        return view('dashboard.users.edit', compact('user', 'roles', 'userRole', 'branches', 'jobs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'name' => 'required|string',
                'email' => 'email|unique:users,email,' . $id,
                'password' => 'required|string',
                'username' => 'string',
                'national_id' => 'integer',
                'emp_id' => 'int',
                'job_id' => 'exists:jobs,id',
                'salary' => 'nullable|numeric',
                'work_days' => 'nullable|integer',
                'work_hours' => 'nullable|integer',
                'branch_id' => 'exists:branches,id',
            ],
            [
                'required' => 'حقل ( :attribute )  مطلوب',
                'unique' => '( :attribute ) موجود مسبقا',
                'string' => 'حقل ( :attribute ) غير صحيح ',
                'integer' => 'حقل ( :attribute )  يجب أن يكون ارقام فقط',
                'exists' => 'هذا السجل غير موجود  ( :attribute ) '
            ]
        );

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('roles'));

        toastr()->success('تم تعديل بيانات المستخدم بنجاح');
        return redirect()->route('dashboard.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('dashboard.users.index')
            ->with('success', 'تم حذف المستخدم بنجاح');
    }

    public function OpenChairMethod($id)
    {
        $CheckUserChair = Chair::where('id', $id)->first();

        try {
            DB::beginTransaction();
            if ($CheckUserChair->user_id) {
                $UpdateChairStatus = Chair::where('id', $id)->update([
                    'status' => 'Busy'
                ]);

                $ChairProcess = ChairProcess::create([
                    'user_id' => $CheckUserChair->user->id,
                    'chair_id' => $CheckUserChair->id,
                    'check_in' => Carbon::now(),
                ]);
            } else {
                return '<h3>يرجي تحديد مستخدم قبل حجز الكرسي</h3>';
            }
            DB::commit();
            toastr()->success('تم حجز الكرسي');
            return redirect()->route('dashboard.index');
        } catch (Exception $e) {
            DB::rollBack();
            return '<h3>حدث خطأ في عملية الحجز</h3>';
        }
    }


    public function CloseChairMethod($id)
    {
        $UpdateChairStatus = Chair::where('id', $id)->update([
            'status' => 'available'
        ]);

        toastr()->success('تم افراغ الكرسي');
        return redirect()->route('dashboard.index');
    }

    public function dailyMethod(Request $request, $id)
    {
        $action = $request->input('action');
        if ($action === 'checkIn') {
            $date = now()->toDateString();
            $check_in = now()->toTimeString();

            try {
                DB::beginTransaction();
                $userCheck_in = Daily::create([
                    'date' => $date,
                    'check_in' => $check_in,
                    'user_id' => $id,
                    'status' => 'حضور',
                ]);

                DB::commit();
                toastr()->success('تم حضور الموظف بنجاح.');
                return redirect()->route('dashboard.index');
            } catch (Exception $e) {
                DB::rollBack();
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }

        if ($action === 'checkOut') {
            $ChairProcess = ChairProcess::where('user_id', $id)->whereNull('check_out')->first();
            if ($ChairProcess) {
                toastr()->error('يوجد عملية جارية لهذا الموظف والكرسي التابع له. يرجي الأنتهاء من العملية أولا.');
                return redirect()->back();
            } else {
                $date = now()->toDateString();
                $check_out = now()->toTimeString();

                $userDaily = Daily::where('user_id', $id)->where('date', $date)->where('status', 'حضور')->first();

                try {
                    DB::beginTransaction();

                    if ($userDaily) {
                        // Update the record with the check-out time.
                        $userDaily->update([
                            'check_out' => $check_out,
                            'status' => 'أنصراف',
                        ]);

                        // Calculate the duration between check-in and check-out
                        $checkInTime = new Carbon($userDaily->check_in);
                        $checkOutTime = new Carbon($userDaily->check_out);

                        $durationInHours = $checkInTime->diffInHours($checkOutTime);
                        $userDaily->duration = $durationInHours;
                        $userDaily->save();

                        $chair = Chair::where('user_id', $id)->first();

                        // Check if the chair is not already assigned to another user
                        if ($chair) {
                            Cookie::queue(Cookie::forget('user_chair_' . $chair->id, $id));
                            $chair->update([
                                'user_id' => null,
                                'status' => 'available',
                            ]);
                        } else {
                            $userDaily->update([
                                'check_out' => $check_out,
                                'status' => 'أنصراف',
                            ]);

                            // Calculate the duration between check-in and check-out
                            $checkInTime = new Carbon($userDaily->check_in);
                            $checkOutTime = new Carbon($userDaily->check_out);

                            $durationInHours = $checkInTime->diffInHours($checkOutTime);
                            $userDaily->duration = $durationInHours;
                            $userDaily->save();
                        }
                    } else {
                        DB::rollBack();
                        toastr()->success('هذا الموظف لم يسجل حضور يجب تسجيل الحضور أولا.');
                        return redirect()->back();
                    }

                    DB::commit();
                    toastr()->success('تم أنصراف الموظف بنجاح.');
                    return redirect()->route('dashboard.index');
                } catch (Exception $e) {
                    DB::rollBack();
                    return response()->json(['error' => $e->getMessage()], 500);
                }
            }
        }
    }

    public function assignUserToChair(Request $request, Chair $chair, User $user)
    {
        $chair = Chair::where('id', $request->chair_id)->first();
        if ($chair) {
            $chair->user_id = $user->id;
            $chair->save();

            // Set the user's chair assignment cookie
            Cookie::queue(Cookie::make('user_chair_' . $chair->id, $user->id, 60 * 24));
            toastr()->success('تم تسجيل الموظف على الكرسي بنجاح.');
            return redirect()->route('dashboard.index');
        } else {
            toastr()->error('هذا الكرسي غير موجود.');
            return redirect()->back();
        }
    }
}

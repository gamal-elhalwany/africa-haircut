<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UserLoginRequest;
use App\Models\Branch;
use App\Models\Chair;
use App\Models\Daily;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    function __construct()
    {
        //    $this->middleware('permission:show-users', ['only' => ['index','show']]);
        //    $this->middleware('permission:create-user', ['only' => ['create','store']]);
        //    $this->middleware('permission:edit-user', ['only' => ['edit','update']]);
    }




    //Login method
    public  function LoginMethod(Request $request)
    {
        try {
            $user = User::where('email', $request->email)->first();
            if ($user) {
                Auth::login($user);
                return Redirect::route('dashboard.index')->with('success', 'Login successful');
            }
            return Redirect::back()->withErrors(['error' => 'Invalid credentials']);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    // Index dashboard method
    public function IndexMethod()
    {
        $Available = Chair::where('status', 'available')->get();
        $Busy = Chair::where('status', 'busy')->get();

        return view('dashboard.index', compact('Available', 'Busy'));
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

        return redirect()->route('dashboard.users.index')->with('success', 'تم إنشاء المستخدم بنجاح');
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

        return redirect()->route('dashboard.users.index')
            ->with('success', 'تم تعديل بيانات المستخدم بنجاح');
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

        if ($CheckUserChair->user_id) {
            $UpdateChairStatus = Chair::where('id', $id)->update([
                'status' => 'Busy'
            ]);
        } else {
            return '<h3>يرجي تحديد مستخدم قبل حجز الكرسي</h3>';
        }
        return redirect()->route('dashboard.index')
            ->with('success', 'تم حجز الكرسي');
    }


    public function CloseChairMethod($id)
    {
        $UpdateChairStatus = Chair::where('id', $id)->update([
            'status' => 'available'
        ]);

        return redirect()->route('dashboard.index')
            ->with('success', 'تم افراغ الكرسي');
    }



    public function dailyMethod(Request $request, $id)
    {
        if ($request->departure) {

            $CheckUserDaily = Daily::where('user_id', $id)->orderBy('created_at', 'desc')->first();

            $CheckIfChairBusy = Chair::where('user_id', $id)->first();
            if ($CheckIfChairBusy->status != "busy") {
                if ($CheckUserDaily) {
                    $dt = new \DateTime();
                    $start = Carbon::parse($CheckUserDaily->start_time);
                    $total = $start->diffInHours(Carbon::now());

                    $AddUserToChair = Chair::where('user_id', $id)->update([
                        'user_id' => null
                    ]);
                    if ($AddUserToChair) {
                        Daily::where('user_id', $id)->orderBy('id', 'desc')->take(1)->update([
                            'end_time' => $dt->format('H:i:s'),
                            'duration' => $total
                        ]);

                        return redirect()->route('dashboard.index')
                            ->with('success', 'تم الانصراف');
                    } else {
                        return '<p class="alert alert-danger">عفوا هذا الموظف غير موجود علي الكرسي</p>';
                    }
                } else {
                    return '<p class="alert alert-danger">حدث خطاء تأكد من حضور الموظف  اولا </p>';
                }
            } else {
                return redirect()->route('error.msg')->withErrors(['msg' => 'يرجي انهاء الفاتورة اولا']);
            }
        }



        if ($request->presence) {
            $CheckIfChairHasUser = Chair::where('id', $request->chair_id)->first();
            if (!$CheckIfChairHasUser->user_id) {
                $dt = new \DateTime();
                $AddUserToChair = Chair::where('id', $request->chair_id)->update([
                    'user_id' => $id
                ]);
                if ($AddUserToChair) {

                    Daily::where('user_id', $id)->create([
                        'start_time' => $dt->format('H:i:s'),
                        'user_id' => $id
                    ]);
                }
            } else {
                return 'عفوا يرجي عمل انصراف للموظف الحالي اولا';
            }

            return redirect()->route('dashboard.index')
                ->with('success', 'تم الحضور');
        }
    }
}

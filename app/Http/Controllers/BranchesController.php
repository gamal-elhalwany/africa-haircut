<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Chair;
use App\Models\User;
use Illuminate\Http\Request;

class BranchesController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:بدون-اذونات|انشاء-فرع|تعديل-فرع|حذف-فرع', ['only' => ['index', 'show']]);
        $this->middleware('permission:انشاء-فرع|تعديل-فرع|حذف-فرع', ['only' => ['create', 'store']]);
        $this->middleware('permission:انشاء-فرع|تعديل-فرع|حذف-فرع', ['only' => ['edit', 'update']]);
        $this->middleware('permission:انشاء-فرع|تعديل-فرع|حذف-فرع', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Branches = Branch::all();
        return view('dashboard.branches.index',compact('Branches'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Users = User::all();
        return view('dashboard.branches.create',compact('Users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $StoreNewBranch = Branch::create($request->all());
        toastr()->success('تم إضافة الفرع بنجاح');
        return redirect()->route('dashboard.branches.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $FindBranchID = Branch::where('id',$id)->with('products')->get();
        return view('dashboard.branches.show',compact('FindBranchID'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $BranchID = Branch::where('id',$id)->get();
        $Users = User::all();

        return view('dashboard.branches.edit',compact('Users','BranchID'));
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
        $BranchID = Branch::find($id)->update([
            'name'=>$request->branch_name,
            'user_id'=>$request->branch_user
        ]);
        toastr()->success('تم تعديل الفرع بنجاح');
        return redirect()->route('dashboard.branches.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $DeleteBranchChairs = Chair::where('branch_id',$id)->delete();
        $UpdateBranchUsers = User::where('branch_id',$id)->update([
            'branch_id'=>null
        ]);

        if(!$DeleteBranchChairs || !$UpdateBranchUsers){
            return redirect()->route('dashboard.branches.index')->withErrors(['BranchError'=>'حدث خطاء']);
        }
        Branch::where('id',$id)->delete();
        toastr()->success('تم حذف الفرع بنجاح');
        return redirect()->route('dashboard.branches.index');

    }
}

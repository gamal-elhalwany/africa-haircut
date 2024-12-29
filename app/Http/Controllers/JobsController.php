<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobsController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:انشاء-وظيفة|تعديل-وظيفة|حذف-وظيفة|بدون-اذونات', ['only' => ['index', 'show']]);
        $this->middleware('permission:انشاء-وظيفة|تعديل-وظيفة|حذف-وظيفة', ['only' => ['create', 'store']]);
        $this->middleware('permission:انشاء-وظيفة|تعديل-وظيفة|حذف-وظيفة', ['only' => ['edit', 'update']]);
        $this->middleware('permission:انشاء-وظيفة|تعديل-وظيفة|حذف-وظيفة', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Jobs = Job::all();
        return view('dashboard.jobs.index',compact('Jobs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Store= Job::create([
            'name'=>$request->name
        ]);
        toastr()->success('تم إضافة الوظيفه بنجاح');
        return redirect()->route('dashboard.jobs.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $GetJobById = Job::find($id);
        return view('dashboard.jobs.edit',compact('GetJobById'));
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
        Job::where('id',$id)->update([
            'name'=>$request->name
        ]);
        toastr()->success('تم تعديل الوظيفه بنجاح');
        return redirect()->route('dashboard.jobs.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Job::where('id',$id)->delete();
        toastr()->success('تم حذف الوظيفه بنجاح');
        return redirect()->route('dashboard.jobs.index');
    }
}

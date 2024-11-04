<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Chair;
use Illuminate\Http\Request;

class ChairsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Chairs = Chair::with('branch')->orderBy('id', 'DESC')->get();
        return view('dashboard.chairs.index',compact('Chairs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Branches = Branch::all();
        return view('dashboard.chairs.create',compact('Branches'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        $chair = Chair::where('user_id', $user->id)->first();
        $this->validate($request, [
            'floor' => 'required|string',
            'number'=>'required',
            'branch' => 'required',
        ]);

        if ($chair) {
            return redirect()->back()->with('error', 'لديك كرسي بالفعل ، ولا يمكنك أضافة اخر!');
        }
        $newChair = Chair::create([
            'floor'=>$request->floor,
            'number'=>$request->number,
            'branch_id'=>$request->branch,
            'user_id' => $user->id,
        ]);

        return redirect()->route('dashboard.chairs.index')->with('success','تم إضافة الكرسي بنجاح');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chair $chair)
    {
        $user = auth()->user();
        if ($chair->user_id == $user->id) {
            $chair->delete();
            return redirect()->route('dashboard.chairs.index')->with('success','تم حذف الكرسي بنجاح');
        }
        return redirect()->route('dashboard.chairs.index')->with('error','لا يمكنك حذف الكرسي او القيام بهذه العملية!');
    }
}

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
    function __construct()
    {
        $this->middleware('permission:انشاء-كرسي|تعديل-كرسي|حذف-كرسي', ['only' => ['index', 'show']]);
        $this->middleware('permission:انشاء-كرسي|تعديل-كرسي|حذف-كرسي', ['only' => ['create', 'store']]);
        $this->middleware('permission:انشاء-كرسي|تعديل-كرسي|حذف-كرسي', ['only' => ['edit', 'update']]);
        $this->middleware('permission:انشاء-كرسي|تعديل-كرسي|حذف-كرسي', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Chairs = Chair::with('user')->with('branch')->with('appointments')->orderBy('id', 'DESC')->get();
        return view('dashboard.chairs.index', compact('Chairs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Branches = Branch::all();
        return view('dashboard.chairs.create', compact('Branches'));
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
            'number' => 'required',
            'branch' => 'required',
        ]);

        if ($chair) {
            toastr()->error('لديك كرسي بالفعل ، ولا يمكنك أضافة اخر!');
            return redirect()->back();
        }
        $newChair = Chair::create([
            'floor' => $request->floor,
            'number' => $request->number,
            'branch_id' => $request->branch,
            'user_id' => $user->id,
        ]);

        toastr()->success('تم إضافة الكرسي بنجاح');
        return redirect()->route('dashboard.chairs.index');
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
        $chair->delete();
        toastr()->error('لا يمكنك حذف الكرسي او القيام بهذه العملية!');
        return redirect()->route('dashboard.chairs.index');
    }
}

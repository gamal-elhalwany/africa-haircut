<?php

namespace App\Http\Controllers;

use App\Models\Category;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:انشاء-منتج|تعديل-منتج|حذف-منتج', ['only' => ['index', 'show']]);
        $this->middleware('permission:انشاء-منتج|تعديل-منتج|حذف-منتج', ['only' => ['create', 'store']]);
        $this->middleware('permission:انشاء-منتج|تعديل-منتج|حذف-منتج', ['only' => ['edit', 'update']]);
        $this->middleware('permission:انشاء-منتج|تعديل-منتج|حذف-منتج', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'parent_id' => 'exists:categories,id',
        ],
        [
            'name.required' => 'الاسم للفئة مطلوب',
            'name.string' => 'الاسم للفئة يجب ان يكون نص',
            'description.required' => 'الوصف للفئة مطلوب',
            'description.string' => 'الوصف للفئة يجب ان يكون نص',
        ]
    );
        Category::create($request->all());
        toastr()->success('تم انشاء الفئة بنجاح');
        return redirect()->route('categories.index');
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
    public function destroy(Category $category)
    {
        $category->delete();
        toastr()->success('تم حذف الفئة بنجاح');
        return redirect()->route('categories.index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\User;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:انشاء-مرتب|تعديل-مرتب|حذف-مرتب|بدون-اذونات', ['only' => ['index', 'show']]);
        $this->middleware('permission:انشاء-مرتب|تعديل-مرتب|حذف-مرتب', ['only' => ['create', 'store']]);
        $this->middleware('permission:انشاء-مرتب|تعديل-مرتب|حذف-مرتب', ['only' => ['edit', 'update']]);
        $this->middleware('permission:انشاء-مرتب|تعديل-مرتب|حذف-مرتب', ['only' => ['destroy']]);
    }

    public function index()
    {
        $expenses = Expense::orderBy('date', 'desc')->paginate(10);
        return view('dashboard.expenses.index', compact('expenses'));
    }

    public function create()
    {
        $users = User::with('branch')->with('job')->with('chair')->with('expenses')->get();
        return view('dashboard.expenses.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'category' => 'required|string|max:255',
            'user_id'   => 'nullable|string|exists:users,id',
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ],
        [
            'date.required' => 'يرجي إدخال التاريخ',
            'date.date' => 'يجب أن يكون التاريخ صحيحا',
            'category.required' => 'يرجي إدخال الفئة',
            'category.string' => 'يرجي إدخال فئة صحيحة',
            'category.max' => 'يرجي إدخال فئة لا تتجاوز
            255 حرف',
            'user_id.required' => 'يرجي إدخال اسم الموظف',
            'user_id.string' => 'يرجي إدخال مستخدم صحيح',
            'user_id.exists' => 'يرجي إدخال مستخدم موجود',
            'amount.required' => 'يرجي إدخال المبلغ',
            'amount.numeric' => 'يرجي إدخال مبلغ صحيح',
            'amount.min' => 'يرجي إدخال مبلغ أكبر من 0',
            'description.string' => 'يرجي إدخال وصف صحيح',
        ]
    );

        Expense::create($validated);

        toastr()->success('تم إضافة قيمة المصروفة بنجاح.');
        return redirect()->route('expenses.create');
    }
}
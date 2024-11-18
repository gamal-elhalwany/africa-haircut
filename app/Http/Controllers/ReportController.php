<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Expense;
use App\Models\Invoice;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('dashboard.reports.index');
    }

    public function generate(Request $request)
    {
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date)->endOfDay();

        // Fetch revenue data
        $invoices = Invoice::whereBetween('created_at', [$startDate, $endDate])
            ->with(['orderItems', 'customer'])->get();
        $totalRevenue = $invoices->sum('total_cost');

        // Fetch expense data
        $expenses = Expense::whereBetween('date', [$startDate, $endDate])->get();
        $totalExpenses = $expenses->sum('amount');

        // Calculate profit/loss
        $profitOrLoss = $totalRevenue - $totalExpenses;

        // Group data by day
        $dailyTransactions = $invoices->groupBy(function ($invoice) {
            return Carbon::parse($invoice->created_at)->format('Y-m-d');
        });

        $dailyExpenses = $expenses->groupBy(function ($expense) {
            return Carbon::parse($expense->date)->format('Y-m-d');
        });

        return view('dashboard.reports.generate', compact('invoices', 'totalRevenue', 'totalExpenses', 'profitOrLoss', 'dailyTransactions', 'dailyExpenses', 'startDate', 'endDate'));
    }
}

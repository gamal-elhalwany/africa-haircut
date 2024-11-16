<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Invoice;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('dashboard.reports.index');
    }

    // Generate the report based on selected filters
    public function generate(Request $request)
    {
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date)->endOfDay();

        $invoices = Invoice::whereBetween('created_at', [$startDate, $endDate])
            ->with(['orderItems', 'customer'])->get();

        $totalRevenue = $invoices->sum('total_cost');

        // Group invoices by day
        $dailyTransactions = $invoices->groupBy(function ($invoice) {
            return Carbon::parse($invoice->created_at)->format('Y-m-d');
        });

        return view('dashboard.reports.generate', compact('invoices', 'totalRevenue', 'dailyTransactions', 'startDate', 'endDate'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\ChairProcess;
use App\Models\Daily;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $AllUsers = User::with('branch')->with('chair')->with('daily')->with('expense')->with('job')->get();
        return view('dashboard.salary.index', compact('AllUsers'));
    }

    public function SearchMethod(Request $request)
    {
        $this->validate(
            $request,
            [
                'user' => 'required',
                'start_date_time' => 'required',
                'end_date_time' => 'required',
            ],
            [
                'user.required' => 'يرجي تحديد المستحدم',
                'start_date_time.required' => 'حقل من تاريخ مطلوب ',
                'end_date_time.required' => 'حقل الي تاريخ مطلوب ',
            ]
        );

        $startDate = Carbon::createFromFormat('Y-m-d', $request->start_date_time)->startOfDay();
        $endDate = Carbon::createFromFormat('Y-m-d', $request->end_date_time)->endOfDay();

        $SalaryData = Daily::where('user_id', $request->user)->whereBetween('created_at', [$startDate, $endDate])->with('users')->get();

        //  For get commotion value
        $CheckUserState = User::where('id', $request->user)->first();
        $Result = 0;

        if ($CheckUserState->salary_system == 'basic') {
            $HourValue = $CheckUserState->salary / $CheckUserState->work_days /  $CheckUserState->work_hours;
            $Result = $HourValue * $SalaryData->sum('duration');

            if ($CheckUserState->expense) {
                $Result -= $CheckUserState->expense[0]->amount;
            }
        }

        if ($CheckUserState->salary_system == 'commotion') {
            $GetChairProcessUser = ChairProcess::where('user_id', $request->user)->whereBetween('created_at', [$startDate, $endDate])->get();
            $SumChiarProcess = $GetChairProcessUser->sum('money');
            $Result = $SumChiarProcess * $CheckUserState->commotion / 100;

            if ($CheckUserState->expense) {
                $Result -= $CheckUserState->expense[0]->amount;
            }
        }

        if ($CheckUserState->salary_system == 'basic_and_commotion') {
            $GetChairProcessUser = ChairProcess::where('user_id', $request->user)->whereBetween('created_at', [$startDate, $endDate])->get();

            $HourValue = $CheckUserState->salary / $CheckUserState->work_days /  $CheckUserState->work_hours;
            $CommotionValue = $GetChairProcessUser->sum('money') * $CheckUserState->commotion / 100;

            $DurationHoursAndHourValueTotal = $HourValue * $SalaryData->sum('duration');
            $Result = $DurationHoursAndHourValueTotal + $CommotionValue;

            if ($CheckUserState->expense) {
                $Result -= $CheckUserState->expense[0]->amount;
            }
        }

        $GetChairProcessUser = ChairProcess::where('user_id', $request->user)->whereBetween('created_at', [$startDate, $endDate])->get();
        $SumChiarProcess = $GetChairProcessUser->sum('cost');

        return view('dashboard.salary.search', compact('SalaryData', 'Result', 'CheckUserState'));
    }
}

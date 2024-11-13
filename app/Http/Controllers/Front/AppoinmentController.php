<?php

namespace App\Http\Controllers\Front;

use App\Models\Chair;
use App\Models\Branch;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * TODO: Make Something to update the appointment status after the process is completed or whatever its case.
 */

class AppoinmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chairs = Chair::where('status', 'available')->with('branch')->get();
        if ($chairs->count() > 0) {
            return view('front.front-chairs', compact('chairs'));
        }
        toastr()->info('لا يوجد كراسي شاغرة.');
        return redirect()->route('home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'customer_name' => 'required|string|min:3|max:20',
            'mobile' => ['required','numeric','digits_between:7,11'],
            'chair_id' => 'required|exists:chairs,id',
            'appointment_date' => 'required|date',
            'start_at' => 'required|date_format:H:i',
            'end_at' => 'date_format:H:i|after:start_at',
        ],
        [
            'customer_name.required' => 'يجب ادخال الاسم',
            'customer_name.string' => 'يجب ادخال الاسم احرف فقط',
            'customer_name.min' => 'يجب ادخال الاسم لا يقل عن 3 احرف',
            'customer_name.max' => 'يجب ادخال الاسم ولا يزيد عن 20 حرف',
            'mobile.required' => 'يجب ادخال رقم الموبايل',
            'mobile.numeric' => 'يجب ادخال رقم الموبايل أرقام فقط ',
            'mobile.min' => 'يجب ادخال رقم الموبايل',
            'mobile.max' => 'يجب ادخال رقم الموبايل لا يزيد عن 11 رقم. ',
            'appointment_date.required' => 'يجب ادخال التاريخ',
            'start_at.required' => 'يجب ادخال الساعة',
        ]);

        $isAvailable = Appointment::where('chair_id', $validatedData['chair_id'])
            ->where('appointment_date', $validatedData['appointment_date'])->where('start_at', $validatedData['start_at'])->doesntExist();

        if (!$isAvailable) {
            toastr()->error('الموعد غير متاح أختر ميعاد آخر.');
            return back();
        }

        Appointment::create($request->all());

        toastr()->success('تم حجز الكرسي بنجاح.');
        return redirect()->back();
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
    public function destroy($id)
    {
        //
    }

    /**
     * Display a lsiting of the resource
     *  @return \Illuminate\Http\Response
     */
    public function reservations(Request $request)
    {
        $chairs = Chair::all();
        $branchs = Branch::all();
        // $reservations = Appointment::with('chair')->with('branch')->paginate(100);
        $reservations = Appointment::with(['chair', 'branch'])
        ->when($request->input('date'), function ($query, $date) {
            $query->whereDate('appointment_date', $date);
        })
        ->when($request->input('chair_id'), function ($query, $chairId) {
            $query->where('chair_id', $chairId);
        })
        ->when($request->input('branch_id'), function ($query, $branchId) {
            $query->where('branch_id', $branchId);
        })
        ->when($request->input('customer_name'), function ($query, $customerName) {
            $query->where('customer_name', $customerName);
        })
        ->orderBy('appointment_date', 'asc')
        ->where('status', 'pending')
        ->paginate(10);
        return view('dashboard.chairs.reservations', compact('reservations', 'chairs', 'branchs'));
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            // 'name' => 'required',
            // 'email' => 'required|email|unique:users,email',
            // 'password' => 'required|same:confirm-password',
            // 'username'=>'required|string|unique:users,username',
            // 'national_id'=>'required|integer|unique:users,national_id',
            // 'emp_id'=>'required|integer',
            // 'job_id'=> 'required|exists:jobs,id',
            // 'salary'=> 'nullable|numeric',
            // 'work_days'=> 'nullable|integer',
            // 'work_hours'=> 'nullable|numeric',
            // 'branch_id'=> 'required|exists:branches,id',
            // 'roles' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'required'=>'حقل ( :attribute ) مطلوب لتعديل الاعدادات ',
            'unique'=>'( :attribute ) موجود مسبقا',
            'same'=>'كلمة السر غير متطابقه',
            'string'=>'حقل ( :attribute ) غير صحيح ',
            'int'=>'حقل ( :attribute )  يجب أن يكون ارقام فقط',
            'exists'=> 'هذا السجل غير موجود  ( :attribute ) '
        ];
    }
}

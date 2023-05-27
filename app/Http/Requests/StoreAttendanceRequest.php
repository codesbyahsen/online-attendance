<?php

namespace App\Http\Requests;

use App\Models\Attendance;
use Illuminate\Foundation\Http\FormRequest;

class StoreAttendanceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => ['required'],
            'status' => ['required', 'in:' . Attendance::STATUS_PRESENT . ',' . Attendance::STATUS_ABSENT]
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'The name field is required.'
        ];
    }
}

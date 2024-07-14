<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
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
            'date' => ['required','date'],
            'time' => ['required'],
            'num' => ['required'],
        ];
    }

    public function messages()
    {
      return [
        'date.required' => '日付を入力してください',
        'date.date' => '日付を入力してください',
        'time.required' => '時間を選択してください',
        'num.required' => '人数を選択してください',
      ];
    }
}

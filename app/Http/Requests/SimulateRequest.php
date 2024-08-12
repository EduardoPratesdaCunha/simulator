<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SimulateRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'initial_value' => 'required|numeric',
      'rate' => 'required|numeric',
      'months' => 'required|integer',
      'value_per_month' => 'nullable|numeric',
    ];
  }

  public function messages()
  {
    return [
      'initial_value.required' => 'O valor inicial deve ser preenchido',
      'initial_value.numeric' => 'O valor inicial deve ser um número',
      'rate.required' => 'A taxa deve ser preenchida',
      'rate.numeric' => 'A taxa deve ser um número',
      'months.required' => 'Períodos deve ser preenchido',
      'months.integer' => 'O número de períodos deve ser um número inteiro',
    ];
  }
}

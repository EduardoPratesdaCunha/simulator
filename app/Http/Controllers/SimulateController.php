<?php

namespace App\Http\Controllers;

use App\Http\Requests\SimulateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SimulateController extends Controller
{
  public function index (SimulateRequest $request)
  {
    try {
      $data = $request->validated();

      $initialValue = floatval($data['initial_value']);
      $rate = ($data['rate'] / 100) / 12;
      $months = intval($data['months']) * 12;
      $valuePerMonth = !empty($data['value_per_month']) ? floatval($data['value_per_month']) : 0;

      $result = $initialValue * pow(1 + $rate, $months);

      if ($valuePerMonth > 0) {
        $result2 = $valuePerMonth * (pow(1 + $rate, $months) - 1) / $rate;
        $result += $result2;
      }

      $result = number_format($result, 2, ',', '.');

      return view('welcome', ['result' => $result]);

    } catch (\Exception $e) {
      Log::info($e->getMessage());
      return view('welcome')->withErrors(['error' => 'Ocorreu um erro ao processar a simulação.']);
    }
  }
}

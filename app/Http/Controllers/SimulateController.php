<?php

namespace App\Http\Controllers;

use App\Http\Requests\SimulateRequest;
use App\Models\Simulate;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SimulateController extends Controller
{
  public function index(Request $request)
  {
    try {
      $simulates = Simulate::where('user_id', Auth::id())
        ->when(isset($request->name), function($query) use ($request) {
          $query->where('name', 'LIKE', "%$request->name%");
        })
        ->when(isset($request->created_at), function($query) use ($request) {
          $query->whereDate('created_at', $request->created_at);
        })
        ->get();

      return view('simulate.index',['simulates' => $simulates]);

    } catch (\Exception $e) {
      Log::info($e->getMessage());
      return redirect()->back()->withErrors(['error' => 'Ocorreu um erro ao processar a simulação.']);
    }
  }

  public function create()
  {
    return view('simulate.create');
  }
  public function edit($id)
  {
    try {
      $simulate = Simulate::orderBy('created_at', 'desc')->find($id);

      if (!isset($simulate)) {
        return back()->withErrors(['error' => 'Esse item não foi encontrado']);
      }

      return view('simulate.edit', ['simulate' => $simulate]);

    } catch (\Exception $e) {
      Log::error($e->getMessage(), [$e]);
      return back()->withErrors(['error' => 'Esse item não foi encontrado']);
    }
  }

  public function store(SimulateRequest $request)
  {
    try {
      DB::beginTransaction();
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

      $resultFromat = number_format($result, 2, ',', '.');

      if (!Auth::check()) {
        return view('welcome', [
          'result' => $resultFromat,
          'request' => $request->all()
        ]);
      }

      $simulate = new Simulate();
      $simulate->id = Str::uuid();
      $simulate->user_id = Auth::id();
      $simulate->initial_value = $initialValue;
      $simulate->rate = $data['rate'];
      $simulate->months = $months;
      $simulate->value_per_month = number_format($valuePerMonth, 2, '.', '');
      $simulate->result = number_format($result, 2, '.', '');
      $simulate->name = $data['name'] ?? null;
      $simulate->final_value = null;
      $simulate->save();

      DB::commit();

      return redirect()->route('simulate.index', [
        'simulate' => $simulate,
        'request' => $request->all()
      ]);

    } catch (Exception $e) {
      DB::rollBack();
      Log::info(['request' => $request->all(), 'error' => $e]);
      return redirect()->back()->withErrors(['error' => 'Ao deu errado'])->withInput();
    }
  }

  public function update($id, SimulateRequest $request)
  {
    try {
      DB::beginTransaction();
      $simulate = Simulate::find($id);

      if (!isset($simulate)) {
        return back()->withErrors(['error' => 'Não foi possivel encontrar esse item']);
      }

      $data = $request->validated();

      $simulate->update($data);
      DB::commit();

      return redirect()->route('simulate.index')->with('success', 'Simulado alterado com sucesso');

    } catch (\Exception $e) {
      DB::rollBack();
      Log::error($e->getMessage(), $e);
      return redirect()->route('simulate.index')->withErrors(['error' => 'Não foi possivel encontrar esse item']);;
    }
  }

  public function destroy($id)
  {
    try {
      DB::beginTransaction();
      $simulate = Simulate::find($id);

      if (!isset($simulate)) {
        return back()->withErrors(['error' => 'Não foi possivel encontrar esse item']);
      }

      $simulate->delete();
      DB::commit();

      return redirect()->route('simulate.index')->with('success', 'Simulado exluido');
    } catch (\Exception $e) {
      Db::rollBack();
      Log::error($e->getMessage(), $e);
      return back()->withErrors(['error' => 'Não foi possivel encontrar esse item']);
    }
  }
}

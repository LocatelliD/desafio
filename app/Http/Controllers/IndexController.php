<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Cities;
use App\Models\Newplan;

class IndexController extends BaseController
{

  public function showindex()
  {
    //pego as informacoes do banco de dados
    $cities = Cities::all();
    $destinys = Cities::where('cod_ddd', '!=', '11')->get();
    $destyny11 = Cities::where('cod_ddd', '=', '11')->get();
    $plans = Newplan::all();
    $tabs = null;

    //passo pra view...
    return view('index')
      ->with('cities', $cities)
      ->with('destinys', $destinys)
      ->with('destyny11', $destyny11)
      ->with('tabs', $tabs)
      ->with('plans', $plans);
  }

  public function countsMinutes(Request $request)
  {

    //pego as informacoes do banco de dados
    $cities = Cities::all();
    $destinys = Cities::where('cod_ddd', '!=', '11')->get();
    $destyny11 = Cities::where('cod_ddd', '=', '11')->get();
    $plans = Newplan::all();


    //validação
    $validated = $request->validate([
      'origin' => 'required',
      'destiny' => 'required',
      'time' => 'required|integer',
      'falemais' => 'required',
    ]);
    //informações passado pelo cliente atraves do formm
    $origin = $request->origin;
    $destiny = $request->destiny;
    $time = $request->time;
    $plan = $request->falemais;

    //verificacao dos valores sem os planos 
    if ($origin == '1') {
      if ($destiny == '2') {
        $price = $time * 1.90;
      } elseif ($destiny == '3') {
        $price = $time * 1.70;
      } elseif ($destiny == '4') {
        $price = $time * 0.90;
      }
    } elseif ($origin == '2') {
      if ($destiny == '1') {
        $price = $time * 2.9;
      }
    } elseif ($origin == '3') {
      if ($destiny == '1') {
        $price = $time * 2.70;
      }
    } elseif ($origin == '4') {
      if ($destiny == '1') {
        $price = $time * 1.90;
      }
    }

    //chamo a funcao para verificar o plano e se excedeu o tempo.
    $price_a = indexController::getplan($plan, $time, $price);

    //coloca todos as informacoes numa variavel, para retornar  view...
    $tabs = array(
      'origin' => $origin,
      'destiny' => $destiny,
      'destiny' => $time,
      'plans' =>  $plan,
      'price_a' =>  $price_a
    );

    print_r($tabs);
    return view('index')
      ->with('cities', $cities)
      ->with('destinys', $destinys)
      ->with('destyny11', $destyny11)
      ->with('tabs', $tabs)
      ->with('plans', $plans);
  }

  public function getPlan($plan, $time, $price)
  {

    $plan = Newplan::where('cod_id', '=', $plan)->get();
    $minutes = $plan[0]->minutes;
    $f = 10;
    $price_alterado = $price;

    if ($time > $minutes) {
      $price_alterado = $price_alterado + ($price_alterado * $f / 100);
    } else {
      $price_alterado = 0.00;
    }
    return $price_alterado;
  }
}

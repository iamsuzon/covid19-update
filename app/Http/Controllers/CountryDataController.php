<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Arr;

class CountryDataController extends Controller
{
  public function index()
  {
    $response_country = $this->countryList();
    $response_country_list = $response_country['response'];
  }

  function countryList()
  {
    $response_country = Http::withHeaders([
      'x-rapidapi-host' => 'covid-193.p.rapidapi.com',
      'x-rapidapi-key' => '0a05b52728msh0fdc3eecd1970fcp122c0djsn4059373cba24'
    ])->get('https://covid-193.p.rapidapi.com/statistics');

    return $response_country;
  }
}

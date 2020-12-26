<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon;

class FrontendController extends Controller
{
    public function index(Request $request)
    {

      if(value($request)==TRUE)
      {
        $country = $request->countries;
        $form_result = value($country);
      }

       $arr_ip = geoip()->getLocation($_SERVER['REMOTE_ADDR']);
       $ip_location = $arr_ip['country'];
       $ip_result = value($ip_location);

      $response_country = $this->countryList();

      $response_country_list = $response_country['response'];

      if($form_result==TRUE)
      {
        $response = $this->selectCountry($country);
      }
      else
      {
        $response = $this->defaultCountry($ip_result);
      }

      $list_data =  $response['response'];

      $mytime = Carbon\Carbon::now('Asia/Dhaka');
      $timeNow = $mytime->format('l d-M-Y h:i:s A');

      return view('welcome',compact('list_data','response_country_list','country','timeNow'));
    }

    function countryList()
    {
      $response_country = Http::withHeaders([
        'x-rapidapi-host' => 'covid-193.p.rapidapi.com',
        'x-rapidapi-key' => '0a05b52728msh0fdc3eecd1970fcp122c0djsn4059373cba24'
      ])->get('https://covid-193.p.rapidapi.com/statistics');

      return $response_country;
    }

    function selectCountry($country)
    {
      $response = Http::withHeaders([
        'x-rapidapi-host' => 'covid-193.p.rapidapi.com',
        'x-rapidapi-key' => '0a05b52728msh0fdc3eecd1970fcp122c0djsn4059373cba24'
      ])->get('https://covid-193.p.rapidapi.com/statistics',[
        'country' => $country,
      ]);

      return $response;
    }

    function defaultCountry($ip_result)
    {
      $response = Http::withHeaders([
        'x-rapidapi-host' => 'covid-193.p.rapidapi.com',
        'x-rapidapi-key' => '0a05b52728msh0fdc3eecd1970fcp122c0djsn4059373cba24'
      ])->get('https://covid-193.p.rapidapi.com/statistics',[
        'country' => $ip_result,
      ]);

      return $response;
    }
}

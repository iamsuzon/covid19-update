<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>COVID-19 Live Update | Bangladesh</title>

    <link rel="shortcut icon" href="{{ asset('corona-fav.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@600;700;800&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/fa9252884d.js" crossorigin="anonymous"></script>

    <link href="{{asset('css/svgMap.min.css')}}" rel="stylesheet">
    <script src="{{asset('js/svgMap.min.js')}}"></script>

  </head>
  <body style="background-color: #E9ECEF ">
    <style media="screen">
      body{
        font-family: 'Open Sans', sans-serif;
      }
      .navbar{
        background-color: #fff !important;
        box-shadow: 0px 1px 10px rgba(23,16,159,.1);
      }
      .card{
        padding: 0.5rem !important;
        border-top-color: transparent;
      }
      .card-body{
        padding: 0.8rem;
      }
      .shadow {
    box-shadow: 0 .5rem 1rem rgba(23,16,159,.1) !important;
      }
      .card-title{
        font-size: 25px;
        font-weight: 800;
      }
      .card-subtitle{
        font-size: 19px;
        font-weight: 700;
        width: 110%;
      }
      .image-part i{
        font-size: 45px;
        margin-top: 8px;
      }
      .heart{
        padding-left: 3px !important;
      }

      @media only screen and (max-width: 400px) {
        #lineChart {
          height: 250px !important;
        }
    }
    </style>

    <section id="nav">
      <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light py-3">
          <a class="navbar-brand" href="#">
    <img src="https://innweb.net/wp-content/uploads/2020/03/82898609_101851044706864_760547401411854336_o-1024x1024.jpg" width="30" height="auto" style="border-radius:50%;" class="d-inline-block align-top" alt="" loading="lazy">
    Innweb COVID19 Live Update
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mx-auto" style="visibility:hidden">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Overview
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Preferences</a>
      </li>
    </ul>
    <form class="form-inline" action="{{url('/')}}" method="post">
      @csrf
      <select class="selectpicker" data-live-search="true" name="countries">
        <option name="country" value="all" data-tokens="ketchup mustard">Global</option>
        @foreach($response_country_list as $list)
        <option name="country" data-tokens="ketchup mustard">{{$list['country']}}</option>
        @endforeach
      </select>
      <button class="btn btn-dark mx-3" type="submit">Search</button>
    </form>
  </div>
</nav>
      </div>
    </section>
    <section id="dashboard">
      <div class="container mt-4">
  <div class="row">
    @foreach($list_data as $data)
    <div class="col">
      <h3 style="font-weight:800;">Country -
        @if($country=='all')
          {{$mes = 'Global - World Wide'}}
        @else
          {{$data['country']}}
        @endif
      <h3>
    </div>
    <div class="col">
      <p class="float-right">{{$timeNow}}<p>
    </div>
    @endforeach
  </div>
    </section>

    <section id="1st">
      <div class="container mt-3">
  <div class="row">
    <div class="col-lg-8 col-md-8 col-sm-12">
      <div class="card shadow p-3 mb-5 bg-white rounded" style="">
        <div class="card-body">
          <!-- <div class="chart-class d-flex flex-column justify-content-center align-items-center"> -->
            <div class="inner-pie">
              <canvas id="lineChart" style="width:250px;height:90px;"></canvas>
            </div>
          <!-- </div> -->
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12">
      <div class="card shadow p-3 mb-5 bg-white rounded" style="">
        <div class="card-body ">
          <div class="card-body bg-white">
            <!-- <div class="chart-class d-flex flex-column justify-content-center align-items-center"> -->
              <div class="inner-pie">
                <canvas id="pieChart" style="width:250px;height:195px;"></canvas>
              </div>
            <!-- </div> -->
          </div>
        </div>
      </div>
    </div>
  </div>
    </section>

    <section id="2nd">
      <div class="container mt-2">
  <div class="row">
    @foreach($list_data as $data)
    <div class="col-md-3 col-sm-12">
      <div class="card shadow p-3 mb-3 bg-white rounded" style="">
  <div class="card-body row">
    <div class="text-part col-8">
      <h5 class="card-title text-danger">
        @if($data['cases']['new']==NULL)
          {{$res = 'No Result'}}
        @else
          {{$data['cases']['new']}}
        @endif
      </h5>
      <h6 class="card-subtitle mb-2 text-danger">Today's Cases</h6>
    </div>
    <div class="image-part col-4">
      <i class="fas fa-virus text-danger"></i>
    </div>
  </div>
</div>
    </div>
    <div class="col-md-3 col-sm-12">
      <div class="card shadow p-3 mb-3 bg-white rounded" style="">
        <div class="card-body row">
          <div class="text-part col-8">
            <h5 class="card-title">
              @if($data['deaths']['new']==NULL)
                {{$res = 'No Result'}}
              @else
                {{$data['deaths']['new']}}
              @endif
              </h5>
            <h6 class="card-subtitle mb-2 text-dark">Today's Deaths</h6>
          </div>
          <div class="image-part col-4">
            <i class="fas fa-heartbeat"></i>
          </div>
        </div>
      </div>
    </div>
     <div class="col-md-3 col-sm-12">
      <div class="card shadow p-3 mb-3 bg-white rounded" style="">
        <div class="card-body row">
          <div class="text-part col-8">
            <h5 class="card-title text-danger">{{$data['cases']['total']}}</h5>
            <h6 class="card-subtitle mb-2 text-danger">Total Cases</h6>
          </div>
          <div class="image-part col-4">
            <i class="fas fa-viruses text-danger"></i>
          </div>
        </div>
      </div>
    </div>
     <div class="col-md-3 col-sm-12">
      <div class="card shadow p-1 mb-3 bg-white rounded" style="">
        <div class="card-body row">
          <div class="text-part col-8">
            <h5 class="card-title">
              @if($data['deaths']['total']==NULL)
                {{$res = 'No Result'}}
              @else
                {{$data['deaths']['total']}}
              @endif
              </h5>
            <h6 class="card-subtitle mb-2 text-dark">Total Deaths</h6>
          </div>
          <div class="image-part col-4">
            <i class="fas fa-exclamation-triangle"></i>
          </div>
        </div>
      </div>
    </div>
  @endforeach
  </div>
  <div class="row">
    @foreach($list_data as $data)
    <div class="col-md-3 col-sm-12">
      <div class="card shadow p-3 mb-3 bg-white rounded" style="">
        <div class="card-body row">
          <div class="text-part col-9">
            <h5 class="card-title text-success">
              @if($data['cases']['recovered']==NULL)
                {{$res = 'No Result'}}
              @else
                {{$data['cases']['recovered']}}
              @endif
            </h5>
            <h6 class="card-subtitle mb-2 text-success">Total Recovered</h6>
          </div>
        <div class="image-part col-3 heart">
          <i class="fas fa-heart text-success"></i>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-3 col-sm-12">
    <div class="card shadow p-3 mb-3 bg-white rounded" style="">
      <div class="card-body row">
        <div class="text-part col-8">
          <h5 class="card-title" style="color:#e67e22">
            @if($data['cases']['active']==NULL)
              {{$res = 'No Result'}}
            @else
              {{$data['cases']['active']}}
            @endif
          </h5>
          <h6 class="card-subtitle mb-2" style="color:#e67e22">Total Active</h6>
        </div>
      <div class="image-part col-4">
        <i class="fab fa-creative-commons-sa" style="color:#e67e22"></i>
      </div>
    </div>
  </div>
</div>
  <div class="col-md-3 col-sm-12">
    <div class="card shadow p-3 mb-3 bg-white rounded" style="">
      <div class="card-body row">
        <div class="text-part col-8">
          <h5 class="card-title" style="color:#3742fa">
            @if($data['tests']['total']==NULL)
              {{$res = 'No Result'}}
            @else
              {{$data['tests']['total']}}
            @endif
          </h5>
          <h6 class="card-subtitle mb-2" style="color:#3742fa">Total Tests</h6>
        </div>
      <div class="image-part col-4">
        <i class="fas fa-vial" style="color:#3742fa"></i>
      </div>
    </div>
  </div>
  </div>
  <div class="col-md-3 col-sm-12">
    <div class="card shadow p-3 mb-3 bg-white rounded" style="">
      <div class="card-body row">
        <div class="text-part col-8">
          <h6 class="card-subtitle mb-2" style="color:#1abc9c">Stay Home</h6>
          <h5 class="card-title" style="color:#1abc9c">Stay Safe</h5>
        </div>
      <div class="image-part col-4">
        <i class="fas fa-virus-slash"  style="color:#1abc9c"></i>
      </div>
    </div>
  </div>
  </div>
    @endforeach
    </section>

    <section id="3rd">
      <div class="container my-5">
  <div class="row">
    <div class="col-md-4 col-sm-12">
      <div class="card shadow p-3 mb-3 bg-white rounded" style=";">
  <div class="card-body">
    <h5 class="card-title">Important Links</h5>
    <!-- <h6 class="card-subtitle mb-2 text-muted">Bangladesh Govt Health Related Sites</h6> -->
    <p class="card-text">Bangladesh Govt Health Related Sites</p>
    <ul>
      <a href="http://corona.gov.bd/" target="_blank">
        <li>Detail Information - Bangladesh Government Website</li>
      </a>
      <a href="https://corona.gov.bd/call_center" target="_blank">
        <li class="mt-2">Emergency Hotline Numbers</li>
      </a>
    </ul>
  </div>
</div>
    </div>
    <div class="col-md-4 col-sm-12">
      <div class="card shadow p-3 mb-3 bg-white rounded" style="">
  <div class="card-body ">
    <h5 class="card-title">About Us</h5>
    <h6 class="card-subtitle mb-2 text-muted">Innweb Technologies</h6>
    <p class="card-text text-justify">It is a social helping application developed by Innweb Technologies. Our main aim is to help people by........</p>
    <a href="https://innweb.net" class="card-link" target="_blank">Know More</a>
  </div>
</div>
    </div>
    <div class="col-md-4 col-sm-12">
      <div class="card shadow p-3 mb-3 bg-white rounded" style="">
  <div class="card-body overflow-hidden">
    <h5 class="card-title">Contact Us</h5>
    <h6 class="card-subtitle mb-2 text-muted">Innweb Technologies</h6>
    <p class="card-text text-justify text-center mt-3">
        <a href="https://innweb.net/contact-us/" target="_blank"><i class="fab fa-dev" style="font-size: 30px;color: #333"></i></a>
        <a href="https://www.facebook.com/InnwebBD" target="_blank"><i class="fab fa-facebook-square" style="font-size: 30px;margin-left:20px"></i></a>
        <a href="https://www.instagram.com/innweb_net/" target="_blank"><i class="fab fa-instagram" style="font-size: 30px;margin-left:20px;color: #fd1d1d;"></i></a>
    </p>
    <p class="pb-3" style="">Directly Contact At: +8801983088331</p>
  </div>
</div>
    </div>
{{--    <div class="col-md-12 col-sm-12">--}}
{{--      <div class="card shadow p-3 mb-5 bg-white rounded" style="">--}}
{{--  <div class="card-body ">--}}
{{--    <div class="demo-container">--}}
{{--      <div id="svgMapPersonHeight"></div>--}}
{{--      <!-- <script src="{{asset('js/personHeight.js')}}"></script> -->--}}
{{--      <script src="{{asset('js/countriesEN.js')}}"></script>--}}
{{--      <script>--}}
{{--      var svgMapDataPersonHeight = {--}}
{{--        data: {--}}
{{--          person: {--}}
{{--            name: 'New Case',--}}
{{--            format: '{0}',--}}
{{--            floatingNumbers: 0--}}
{{--          },--}}
{{--          male: {--}}
{{--            name: 'New Death',--}}
{{--            format: '{0}',--}}
{{--            floatingNumbers: 0--}}
{{--          },--}}
{{--          female: {--}}
{{--            name: 'Total Recoverd',--}}
{{--            format: '{0}',--}}
{{--            floatingNumbers: 0--}}
{{--          }--}}
{{--        },--}}
{{--        applyData: 'person',--}}
{{--        values: {--}}
{{--          TL: {person: 100, male: 159, female: 151},--}}
{{--          LA: {person: 155.9, male: 160.5, female: 151.3},--}}
{{--          PH: {person: 156.4, male: 163.2, female: 149.6},--}}
{{--          GT: {person: 156.4, male: 163.4, female: 149.4},--}}
{{--          MG: {person: 156.4, male: 161.5, female: 151.2},--}}
{{--          NP: {person: 156.6, male: 162.3, female: 150.9},--}}
{{--          YE: {person: 157.0, male: 159.9, female: 154.0},--}}
{{--          MH: {person: 157.1, male: 162.8, female: 151.3},--}}
{{--          BD: {--}}
{{--            person: @php--}}
{{--            foreach($response_country_list as $data){--}}
{{--              if($data['country']=="Bangladesh")--}}
{{--              echo $data['cases']['new'];--}}
{{--            }--}}
{{--            @endphp,--}}
{{--            male: @php--}}
{{--            foreach($response_country_list as $data){--}}
{{--              if($data['country']=="Bangladesh")--}}
{{--              echo $data['deaths']['new'];--}}
{{--            }--}}
{{--            @endphp,--}}
{{--            female: @php--}}
{{--            foreach($response_country_list as $data){--}}
{{--              if($data['country']=="Bangladesh")--}}
{{--              echo $data['cases']['recovered'];--}}
{{--            }--}}
{{--            @endphp--}}
{{--          },--}}
{{--          KH: {person: 158.1, male: 163.3, female: 152.9},--}}
{{--          ID: {person: 158.2, male: 163.6, female: 152.8},--}}
{{--          MW: {person: 158.3, male: 162.2, female: 154.4},--}}
{{--          IN: {person: @php--}}
{{--          foreach($response_country_list as $data){--}}
{{--            if($data['country']=="India")--}}
{{--            echo $data['cases']['new'];--}}
{{--          }--}}
{{--          @endphp, male: @php--}}
{{--          foreach($response_country_list as $data){--}}
{{--            if($data['country']=="India")--}}
{{--            echo $data['deaths']['new'];--}}
{{--          }--}}
{{--          @endphp, female: @php--}}
{{--          foreach($response_country_list as $data){--}}
{{--            if($data['country']=="India")--}}
{{--            echo $data['cases']['recovered'];--}}
{{--          }--}}
{{--          @endphp--}}
{{--        },--}}
{{--          RW: {person: 158.8, male: 162.7, female: 154.8},--}}
{{--          VN: {person: 159.0, male: 164.4, female: 153.6},--}}
{{--          PE: {person: 159.1, male: 165.2, female: 152.9},--}}
{{--          PG: {person: 159.3, male: 163.6, female: 154.9},--}}
{{--          SB: {person: 159.3, male: 164.1, female: 154.4},--}}
{{--          MZ: {person: 159.4, male: 164.8, female: 154.0},--}}
{{--          BN: {person: 159.5, male: 165.0, female: 154.0},--}}
{{--          BT: {person: 159.5, male: 165.3, female: 153.6},--}}
{{--          MM: {person: 159.6, male: 164.7, female: 154.4},--}}
{{--          LR: {person: 159.7, male: 163.7, female: 155.7},--}}
{{--          HN: {person: 160.1, male: 166.4, female: 153.8},--}}
{{--          AF: {person: @php--}}
{{--          foreach($response_country_list as $data){--}}
{{--            if($data['country']=="Afghanistan")--}}
{{--            echo $data['cases']['new'];--}}
{{--          }--}}
{{--          @endphp, male: @php--}}
{{--          foreach($response_country_list as $data){--}}
{{--            if($data['country']=="Afghanistan")--}}
{{--            echo $data['deaths']['new'];--}}
{{--          }--}}
{{--          @endphp, female: @php--}}
{{--          foreach($response_country_list as $data){--}}
{{--            if($data['country']=="Afghanistan")--}}
{{--            echo $data['cases']['recovered'];--}}
{{--          }--}}
{{--          @endphp--}}
{{--        },--}}
{{--          LK: {person: 160.2, male: 165.7, female: 154.6},--}}
{{--          BI: {person: 160.3, male: 166.6, female: 154.0},--}}
{{--          PK: {person: @php--}}
{{--          foreach($response_country_list as $data){--}}
{{--            if($data['country']=="Pakistan")--}}
{{--            echo $data['cases']['new'];--}}
{{--          }--}}
{{--          @endphp, male: @php--}}
{{--          foreach($response_country_list as $data){--}}
{{--            if($data['country']=="Pakistan")--}}
{{--            echo $data['deaths']['new'];--}}
{{--          }--}}
{{--          @endphp, female: @php--}}
{{--          foreach($response_country_list as $data){--}}
{{--            if($data['country']=="Pakistan")--}}
{{--            echo $data['cases']['recovered'];--}}
{{--          }--}}
{{--          @endphp--}}
{{--        },--}}
{{--          BO: {person: 160.4, male: 166.8, female: 153.9},--}}
{{--          TZ: {person: 160.4, male: 164.8, female: 155.9},--}}
{{--          SL: {person: 160.5, male: 164.4, female: 156.6},--}}
{{--          MR: {person: 160.5, male: 163.3, female: 157.7},--}}
{{--          NI: {person: 160.6, male: 166.7, female: 154.4},--}}
{{--          LS: {person: 160.7, male: 165.6, female: 155.7},--}}
{{--          EC: {person: 160.7, male: 167.1, female: 154.2},--}}
{{--          KM: {person: 160.9, male: 166.2, female: 155.6},--}}
{{--          CD: {person: 161.0, male: 166.8, female: 155.2},--}}
{{--          ET: {person: 161.0, male: 166.2, female: 155.7},--}}
{{--          NG: {person: 161.1, male: 165.9, female: 156.3},--}}
{{--          UG: {person: 161.2, male: 165.6, female: 156.7},--}}
{{--          ZM: {person: 161.2, male: 166.5, female: 155.8},--}}
{{--          SD: {person: 161.3, male: 166.6, female: 156.0},--}}
{{--          SO: {person: 161.4, male: 166.6, female: 156.1},--}}
{{--          DJ: {person: 161.4, male: 166.6, female: 156.1},--}}
{{--          BJ: {person: 161.7, male: 167.1, female: 156.2},--}}
{{--          SA: {person: 161.8, male: 167.7, female: 155.9},--}}
{{--          PA: {person: 162.0, male: 168.5, female: 155.5},--}}
{{--          EG: {person: 162.0, male: 166.7, female: 157.3},--}}
{{--          PW: {person: 162.0, male: 167.7, female: 156.2},--}}
{{--          MY: {person: 162.1, male: 167.9, female: 156.3},--}}
{{--          SV: {person: 162.2, male: 169.8, female: 154.5},--}}
{{--          BH: {person: 162.2, male: 167.7, female: 156.7},--}}
{{--          FM: {person: 162.3, male: 168.5, female: 156.1},--}}
{{--          AO: {person: 162.3, male: 167.3, female: 157.3},--}}
{{--          CI: {person: 162.3, male: 166.5, female: 158.1},--}}
{{--          ER: {person: 162.4, male: 168.4, female: 156.4},--}}
{{--          CF: {person: 162.4, male: 166.7, female: 158.0},--}}
{{--          ZA: {person: 162.4, male: 166.7, female: 158.0},--}}
{{--          GQ: {person: 162.4, male: 167.4, female: 157.3},--}}
{{--          CG: {person: 162.5, male: 167.4, female: 157.6},--}}
{{--          CR: {person: 162.7, male: 168.9, female: 156.4},--}}
{{--          GN: {person: 162.7, male: 167.5, female: 157.8},--}}
{{--          NA: {person: 162.9, male: 167.0, female: 158.8},--}}
{{--          MX: {person: 162.9, male: 169.0, female: 156.8},--}}
{{--          NE: {person: 163.0, male: 167.7, female: 158.3},--}}
{{--          KI: {person: 163.1, male: 169.2, female: 157.0},--}}
{{--          GW: {person: 163.1, male: 167.9, female: 158.2},--}}
{{--          OM: {person: 163.2, male: 169.2, female: 157.2},--}}
{{--          CO: {person: 163.2, male: 169.5, female: 156.9},--}}
{{--          GM: {person: 163.2, male: 165.4, female: 160.9},--}}
{{--          VU: {person: 163.2, male: 168.1, female: 158.2},--}}
{{--          ST: {person: 163.2, male: 167.4, female: 158.9},--}}
{{--          TG: {person: 163.3, male: 168.3, female: 158.3},--}}
{{--          ZW: {person: 163.4, male: 168.6, female: 158.2},--}}
{{--          GH: {person: 163.4, male: 168.8, female: 157.9},--}}
{{--          GA: {person: 163.4, male: 167.9, female: 158.8},--}}
{{--          SZ: {person: 163.4, male: 168.1, female: 158.6},--}}
{{--          UZ: {person: 163.6, male: 169.4, female: 157.8},--}}
{{--          TH: {person: 163.6, male: 169.2, female: 157.9},--}}
{{--          MN: {person: 163.7, male: 169.1, female: 158.2},--}}
{{--          KE: {person: 163.9, male: 169.6, female: 158.2},--}}
{{--          MU: {person: 163.9, male: 170.5, female: 157.2},--}}
{{--          TV: {person: 163.9, male: 169.6, female: 158.1},--}}
{{--          AZ: {person: 164.0, male: 169.7, female: 158.3},--}}
{{--          MA: {person: 164.1, male: 170.4, female: 157.8},--}}
{{--          GY: {person: 164.1, male: 170.2, female: 157.9},--}}
{{--          TJ: {person: 164.3, male: 171.3, female: 157.3},--}}
{{--          KN: {person: 164.4, male: 169.6, female: 159.2},--}}
{{--          SY: {person: 164.5, male: 170.4, female: 158.6},--}}
{{--          VE: {person: 164.5, male: 171.6, female: 157.4},--}}
{{--          AE: {person: 164.6, male: 170.5, female: 158.7},--}}
{{--          DZ: {person: 164.6, male: 170.1, female: 159.1},--}}
{{--          IQ: {person: 164.6, male: 170.4, female: 158.7},--}}
{{--          JP: {person: 164.6, male: 170.8, female: 158.3},--}}
{{--          BF: {person: 164.8, male: 169.3, female: 160.2},--}}
{{--          JO: {person: 164.9, male: 171.0, female: 158.8},--}}
{{--          CU: {person: 165.0, male: 172.0, female: 158.0},--}}
{{--          QA: {person: 165.0, male: 170.5, female: 159.4},--}}
{{--          AM: {person: 165.1, male: 172.0, female: 158.1},--}}
{{--          KG: {person: 165.3, male: 171.2, female: 159.4},--}}
{{--          TD: {person: 165.3, male: 170.4, female: 160.2},--}}
{{--          KZ: {person: 165.4, male: 171.1, female: 159.6},--}}
{{--          KP: {person: 165.5, male: 172.0, female: 159.0},--}}
{{--          PS: {person: 165.5, male: 172.1, female: 158.8},--}}
{{--          CL: {person: 165.6, male: 171.8, female: 159.4},--}}
{{--          PR: {person: 165.7, male: 172.1, female: 159.2},--}}
{{--          HT: {person: 165.7, male: 172.6, female: 158.7},--}}
{{--          CN: {person: 165.8, male: 171.8, female: 159.7},--}}
{{--          ML: {person: 165.8, male: 171.1, female: 160.5},--}}
{{--          KW: {person: 165.8, male: 172.1, female: 159.4},--}}
{{--          DO: {person: 165.9, male: 172.7, female: 159.0},--}}
{{--          HK: {person: 166.3, male: 173.6, female: 159.0},--}}
{{--          PY: {person: 166.4, male: 172.8, female: 159.9},--}}
{{--          BW: {person: 166.5, male: 171.6, female: 161.4},--}}
{{--          SG: {person: 166.5, male: 172.6, female: 160.3},--}}
{{--          AG: {person: 166.7, male: 172.7, female: 160.7},--}}
{{--          BS: {person: 166.7, male: 172.7, female: 160.7},--}}
{{--          SR: {person: 166.7, male: 172.7, female: 160.7},--}}
{{--          IR: {person: 166.7, male: 173.6, female: 159.7},--}}
{{--          VC: {person: 166.8, male: 172.8, female: 160.7},--}}
{{--          TM: {person: 166.9, male: 172.0, female: 161.7},--}}
{{--          AR: {person: 166.9, male: 174.6, female: 159.2},--}}
{{--          MT: {person: 167.1, male: 173.3, female: 160.9},--}}
{{--          LC: {person: 167.1, male: 171.9, female: 162.3},--}}
{{--          TN: {person: 167.2, male: 174.0, female: 160.4},--}}
{{--          TT: {person: 167.2, male: 173.7, female: 160.6},--}}
{{--          BR: {person: 167.3, male: 173.6, female: 160.9},--}}
{{--          CV: {person: 167.4, male: 173.2, female: 161.6},--}}
{{--          TR: {person: 167.4, male: 174.2, female: 160.5},--}}
{{--          AL: {person: 167.6, male: 173.4, female: 161.8},--}}
{{--          LY: {person: 167.8, male: 173.5, female: 162.1},--}}
{{--          SN: {person: 167.8, male: 173.1, female: 162.5},--}}
{{--          UY: {person: 167.8, male: 173.4, female: 162.1},--}}
{{--          FJ: {person: 167.8, male: 173.9, female: 161.7},--}}
{{--          TW: {person: 168.0, male: 174.5, female: 161.5},--}}
{{--          PT: {person: 168.0, male: 172.9, female: 163.0},--}}
{{--          GL: {person: 168.2, male: 174.9, female: 161.5},--}}
{{--          WS: {person: 168.2, male: 174.4, female: 162.0},--}}
{{--          SC: {person: 168.2, male: 174.2, female: 162.1},--}}
{{--          LB: {person: 168.4, male: 174.4, female: 162.4},--}}
{{--          KR: {person: 168.6, male: 174.9, female: 162.3},--}}
{{--          RO: {person: 168.7, male: 174.7, female: 162.7},--}}
{{--          GE: {person: 168.7, male: 174.3, female: 163.0},--}}
{{--          CY: {person: 168.7, male: 175.0, female: 162.3},--}}
{{--          JM: {person: 168.8, male: 174.5, female: 163.1},--}}
{{--          MK: {person: 169.1, male: 178.3, female: 159.8},--}}
{{--          IL: {person: 169.4, male: 176.9, female: 161.8},--}}
{{--          MD: {person: 169.4, male: 175.5, female: 163.2},--}}
{{--          ES: {person: 170.0, male: 176.6, female: 163.4},--}}
{{--          DM: {person: 170.3, male: 176.3, female: 164.3},--}}
{{--          US: {person: 170.3, male: 177.1, female: 163.5},--}}
{{--          HU: {person: 170.5, male: 177.3, female: 163.7},--}}
{{--          BB: {person: 170.6, male: 175.9, female: 165.3},--}}
{{--          GD: {person: 170.8, male: 177.0, female: 164.5},--}}
{{--          RU: {person: 170.9, male: 176.5, female: 165.3},--}}
{{--          AT: {person: 171.0, male: 177.4, female: 164.6},--}}
{{--          CA: {person: 171.0, male: 178.1, female: 163.9},--}}
{{--          CH: {person: 171.0, male: 178.4, female: 163.5},--}}
{{--          PL: {person: 171.0, male: 177.3, female: 164.6},--}}
{{--          GB: {person: 171.0, male: 177.5, female: 164.4},--}}
{{--          GR: {person: 171.1, male: 177.3, female: 164.9},--}}
{{--          IT: {person: 171.2, male: 177.8, female: 164.6},--}}
{{--          LU: {person: 171.2, male: 177.9, female: 164.4},--}}
{{--          TO: {person: 171.2, male: 176.8, female: 165.5},--}}
{{--          NZ: {person: 171.3, male: 177.7, female: 164.9},--}}
{{--          BG: {person: 171.5, male: 178.2, female: 164.8},--}}
{{--          ME: {person: 171.6, male: 178.3, female: 164.9},--}}
{{--          IE: {person: 172.0, male: 178.9, female: 165.1},--}}
{{--          FR: {person: 172.3, male: 179.7, female: 164.9},--}}
{{--          UA: {person: 172.4, male: 178.5, female: 166.3},--}}
{{--          BY: {person: 172.4, male: 178.4, female: 166.3},--}}
{{--          AU: {person: 172.6, male: 179.2, female: 165.9},--}}
{{--          SE: {person: 172.7, male: 179.7, female: 165.7},--}}
{{--          NO: {person: 172.7, male: 179.7, female: 165.6},--}}
{{--          LT: {person: 172.8, male: 179.0, female: 166.6},--}}
{{--          FI: {person: 172.8, male: 179.6, female: 165.9},--}}
{{--          DE: {person: 172.9, male: 179.9, female: 165.9},--}}
{{--          SI: {person: 173.0, male: 179.8, female: 166.1},--}}
{{--          IS: {person: 173.2, male: 180.5, female: 165.9},--}}
{{--          HR: {person: 173.2, male: 180.8, female: 165.6},--}}
{{--          BA: {person: 173.4, male: 180.9, female: 165.8},--}}
{{--          SK: {person: 173.5, male: 179.5, female: 167.5},--}}
{{--          BE: {person: 173.6, male: 181.7, female: 165.5},--}}
{{--          RS: {person: 174.2, male: 180.6, female: 167.7},--}}
{{--          DK: {person: 174.3, male: 181.4, female: 167.2},--}}
{{--          CZ: {person: 174.3, male: 180.1, female: 168.5},--}}
{{--          EE: {person: 175.2, male: 181.6, female: 168.7},--}}
{{--          NL: {person: 175.6, male: 182.5, female: 168.7},--}}
{{--          LV: {person: 175.6, male: 181.4, female: 169.8}--}}
{{--        }--}}
{{--      }--}}

{{--        new svgMap({--}}
{{--          targetElementID: 'svgMapPersonHeight',--}}
{{--          countryNames: svgMapCountryNamesEN,--}}
{{--          data: svgMapDataPersonHeight,--}}
{{--          colorMin: '#ec939c',--}}
{{--          colorMax: '#d92638',--}}
{{--          hideFlag: false,--}}
{{--          noDataText: 'No Result Found'--}}
{{--        });--}}
{{--      </script>--}}
{{--    </div>--}}
{{--  </div>--}}
{{--</div>--}}
{{--    </div>--}}
  </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI=" crossorigin="anonymous"></script>
      <script type="text/javascript">
        let ctx = document.getElementById('pieChart').getContext('2d');
        let labels = ['Cases','Recovered','Deaths'];
        let colorHex = ['#dc3545','#28a745','#343a40'];

        let pieChart = new Chart(ctx, {
          type: 'doughnut',
          data: {
            datasets: [{
              data: [
                @php foreach ($list_data as $data) {
                  echo $data['cases']['total'];
                } @endphp,
                @php foreach ($list_data as $data) {
                  echo $data['cases']['recovered'];
                } @endphp,
                @php foreach ($list_data as $data) {
                  echo $data['deaths']['total'];
                } @endphp
              ],
              backgroundColor: colorHex
            }],
            labels: labels
          },
          options: {
            responsive: true,
            legend: {
              position: 'bottom',
            },
            plugins: {
              datalabels: {
                color: '#fff',
                anchor: 'center',
                align: 'center',
                borderWidth: 2,
                borderColor: '#fff',
                borderRadius: 25
              }
            }
          }
        })

        let cty = document.getElementById('lineChart').getContext('2d');
        let labelss = ['Cases','Recovered','Deaths','Active','Tests'];
        let colorHexx = ['#dc3545','#28a745','#343a40','#eccc68','#3742fa'];

        let lineChart = new Chart(cty, {
          type: 'line',
          data: {
              datasets: [{
                  label: 'Total Result',
                  fill: false,
                  lineTension: 0.5,
                  borderColor: "#a4b0be",
                  borderCapStyle: 'butt',
                  borderDash: [],
                  borderDashOffset: 0.0,
                  borderJoinStyle: 'miter',
                  pointBorderColor: ['#dc3545','#28a745','#343a40','#eccc68','#3742fa'],
                  pointBorderWidth: 10,
                  pointHoverRadius: 10,
                  pointHitRadius: 10,
                  data: [
                    @php foreach ($list_data as $data) {
                      echo $data['cases']['total'];
                    } @endphp,
                    @php foreach ($list_data as $data) {
                      echo $data['cases']['recovered'];
                    } @endphp,
                    @php foreach ($list_data as $data) {
                      echo $data['deaths']['total'];
                    } @endphp,
                    @php foreach ($list_data as $data) {
                      echo $data['cases']['active'];
                    } @endphp,
                    @php foreach ($list_data as $data) {
                      echo $data['tests']['total'];
                    } @endphp
                  ],
                  backgroundColor: colorHexx
                }],
                  labels: labelss,
              },
              options: {
            responsive: true
          }
        })

      </script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>
  </body>
</html>

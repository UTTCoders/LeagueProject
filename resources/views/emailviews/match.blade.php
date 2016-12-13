<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="{{elixir('css/app.css')}}">
    <style media="screen">
      .no-padding{
        padding: 0;
      }
      .players-container{
        background: #111;
      }
      .logo{
        height: 100px;
        width: auto;
        margin: auto;
        display: block;
      }
    </style>
  </head>
  <body>
    <div class="col-xs-6 col-xs-offset-3 well">
      <div class="col-xs-5">
        <div class="col-xs-12">
          <img src="{{asset('storage/'.$match->localTeam->logo)}}" alt="" class="logo">
        </div>
      </div>
      <div class="col-xs-2" style="text-align:center;">
        <h3>VS</h3>
      </div>
      <div class="col-xs-5">
        <div class="col-xs-12">
          <img src="{{asset('storage/'.$match->visitorTeam->logo)}}" alt="" class="logo">
        </div>
      </div>
    </div>
    <div class="col-xs-6 col-xs-offset-3">
      <h2>Season: {{date('F Y',strtotime($match->season->start_date))." - ".date('F Y',mktime(0,0,0,5,1,date('Y',strtotime($match->season->start_date))+1))}}</h2>
      <h3>{{date('F d, H:i',strtotime($match->start_date))}}</h3>
      <div class="col-xs-6 no-padding players-container">
        @foreach($match->players->where('team_id',$match->localTeam->id) as $player)
        <div class="col-xs-12">
          {{$player->name}}
        </div>
        @endforeach
      </div>
      <div class="col-xs-6 no-padding players-container">
        @foreach($match->players->where('team_id',$match->visitorTeam->id) as $player)
        <div class="col-xs-12">
          {{$player->name}}
        </div>
        @endforeach
      </div>
    </div>
  </body>
</html>

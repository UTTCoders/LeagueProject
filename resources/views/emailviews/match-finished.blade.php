<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="{{elixir('css/app.css')}}">
    <style media="screen">
      body{
        font-family: Roboto;
      }
      .no-padding{
        padding: 0;
      }
      .players-container{
        background: #111;
        color: white;
        padding: 15px;
      }
      .logo{
        height: 100px;
        width: auto;
        margin: auto;
        display: block;
      }
      .visitor{
        text-align: right;
      }
      .position{
        background: #fff;
        color:#111;
        border-radius: 3px;
        text-align: center;
        width: 60px;
        padding-left: 10px;
        padding-right: 10px;
      }
      .btn{
        border-radius: 3px;
        background: #fff;
        padding: 10px;
        padding-left: 20px;
        padding-right: 20px;
        text-decoration: none;
        color:dodgerblue;
        border: 1px solid dodgerblue;
        display: block;
        margin: auto;
        margin-top: 20px;
      }
      a.btn:link{
        text-decoration: none;
        color:dodgerblue;
      }
      a.btn:visited{
        text-decoration: none;
        color:dodgerblue;
      }
      .col-xs-12{
        width: 100%;
        float: left;
      }
      .col-xs-5{
        float: left;
      }
      .col-xs-6{
        width: 50%;
        float: left;
      }
    </style>
  </head>
  <body>
    <div class="col-xs-12 well">
      <div class="col-xs-5">
        <div class="col-xs-12">
          <img src="{{$message->embed(url('/').'/storage/'.$match->localTeam->logo)}}" alt="" class="logo">
        </div>
      </div>
      <div class="col-xs-2" style="text-align:center;">
        <p style="font-size:20px;float:left;margin-left:25px;margin-right:25px;">VS</p>
      </div>
      <div class="col-xs-5">
        <div class="col-xs-12">
          <img src="{{$message->embed(url('/').'/storage/'.$match->visitorTeam->logo)}}" alt="" class="logo">
        </div>
      </div>
    </div>
    <div class="col-xs-12">
      <div class="col-xs-6">
        <div class="col-xs-12" style="text-align:center;">
          <h3 style="color:red;">{{$match->localTeam->goalsCount." - ".$match->visitorTeam->goalsCount}}</h3>
        </div>
      </div>
    </div>
    <div class="col-xs-12">
      <div class="col-xs-5">
        <div class="col-xs-12" style="text-align:center;">
          Ball possession: {{(double)$match->localTeam->pivot->ball_possesion}}% - {{(double)$match->visitorTeam->pivot->ball_possesion}}%
        </div>
      </div>
    </div>
    <div class="col-xs-12">
      <h2>Season: {{date('F Y',strtotime($match->season->start_date))." - ".date('F Y',mktime(0,0,0,5,1,date('Y',strtotime($match->season->start_date))+1))}}</h2>
      <h3>{{date('F d, H:i',strtotime($match->start_date))}}</h3>
      <h3>{{$match->referee->name." ".$match->referee->last_name}}</h3>
      <h3>{{$match->localTeam->stadium->name}}</h3>

      <h3 style="color: red;">{{$match->events()->latest()->first()->content}}</h3>

      <h3>Goals</h3>

      <div class="col-xs-12 no-padding">
        <div class="col-xs-5">
          <div class="col-xs-12" style="text-align:center;">
          @foreach($match->goals as $goal)
          @if($goal->player->team->id == $match->localTeam->id)
          <p>{{$goal->player->name}} ({{$goal->minute}}')</p>
          @endif
          @endforeach
          </div>
        </div>
        <div class="col-xs-2" style="text-align:center;">
          <p style="font-size:20px;float:left;margin-left:25px;margin-right:25px;">VS</p>
        </div>
        <div class="col-xs-5">
          <div class="col-xs-12" style="text-align:center;">
            @foreach($match->goals as $goal)
            @if($goal->player->team->id == $match->visitorTeam->id)
            <p>{{$goal->player->name}} ({{$goal->minute}}')</p>
            @endif
            @endforeach
          </div>
        </div>
      </div>

      <h4 style="margin-top:40px;">Lineups</h4>
      <div class="col-xs-6 no-padding players-container">
        @foreach($match->players->where('team_id',$match->localTeam->id) as $player)
        <div class="col-xs-12 no-padding" style="margin-bottom:5px;">
          <div class="" style="display:inline-block;">
            {{$player->name." ".$player->last_name}}
          </div>
          <div class="position" style="float:right;">
            {{$player->positions()->wherePivot('main',1)->first()->abbreviation}}
          </div>
        </div>
        @endforeach
      </div>
      <div class="col-xs-6 no-padding players-container visitor">
        @foreach($match->players->where('team_id',$match->visitorTeam->id) as $player)
        <div class="col-xs-12 no-padding" style="margin-bottom:5px;">
          <div class="" style="display:inline-block;">
            {{$player->name." ".$player->last_name}}
          </div>
          <div class="position" style="float:left;">
            {{$player->positions()->wherePivot('main',1)->first()->abbreviation}}
          </div>
        </div>
        @endforeach
      </div>
      <p style="col-xs-12">league-project.com</p>
    </div>
  </body>
</html>

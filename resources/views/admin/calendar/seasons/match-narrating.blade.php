@extends('layouts.master')

@section('title')
{{$match->localTeam->name." vs ".$match->visitorTeam->name}}
@endsection

@section('css')
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://code.getmdl.io/1.2.1/material.indigo-pink.min.css">
<script defer src="https://code.getmdl.io/1.2.1/material.min.js"></script>
<style media="screen">
body{
  background:  #222525;
  color: #ddd;
}
.coverContainer{
    height: 400px;
    background-size: cover;
    background-image: url("{{asset('img/stadium77.jpg')}}");
    box-shadow: inset 0px -2px 8px 0px #222;
}
.mainTitle{
    text-align: center;
    font-size: 30px;
    margin: 0;
    top: 180px;
    color: #fff;
    text-shadow: 0px 0px 2px #000,0px 0px 10px #000;
    position: relative;
}
.no-padding{
  padding: 0;
}
.black-transparent-back{
  display: none;
  position: fixed;
  z-index: 5;
  background-color: rgba(0, 0, 0, 0.7);
  height: 100%;
  width: 100%;
  left: 0;
  top: 0;
}
.black-transparent-back > .messageBox{
  opacity: 0;
  background-color: white;
  border-radius: 2px;
  box-shadow: 0px 0px 10px 0px #000;
  margin-top: 10%;
  overflow: hidden;
  padding: 0;
  margin-bottom: 0;
  padding-bottom: 0;
  -webkit-transition: margin-top .4s, opacity .5s;
}
.black-transparent-back > .messageBox > .header > h3{
  margin-top: 10px;
  color: dodgerblue;
  padding: 15px;
}
.black-transparent-back > .messageBox > .body{
  padding-left: 15px;
  color: #444;
  padding-right: 15px;
  padding-bottom: 15px;
}
.black-transparent-back > .messageBox > .btnBack{
  background-color: #eee;
  width: 106%;
  margin-left: -3%;
  display: inline-block;
  padding-top: 15px;
  padding-left: 3%;
  padding-right: 3%;
  padding-bottom: 10px;
  box-shadow: inset 0px 2px 3px 0px #aaa;
}
.btnBlue2{
  background: linear-gradient(to bottom, dodgerblue,#0c70dd);
  border-radius: 2px;
  font-weight: 400;
  border: 0px;
  border-top: 1px solid skyblue;
  border-bottom: 1px solid dodgerblue;
  padding: 3px 10px 3px 10px;
  -webkit-transition: background .4s;
}
.btnBlue2:hover{
  background: linear-gradient(to bottom, #2fa1ff,#1b81ee);
}
.matchCard{
  display: inline-block;
  background: linear-gradient(to bottom,#111,#000);
  border: 1px solid #222;
  box-shadow: 0 0 10px 0 #000;
  margin-top: 5px;
  margin-bottom: 5px;
}
.team-container >div{
  padding-top: 15px;
  text-align: center;
  position: relative;
}
.team-container >div>img{
  position: relative;;
  height: 100px;
  width: auto;
  display: block;
  margin: auto;
}
.tasks{
  background-color: white;
  color:#666;
  font-family: Roboto;
  border-radius: 3px;
  box-shadow: 0 1px 5px 0 #000;
}
.tasks>h4{
  color: dodgerblue;
}
.subTitle{
  text-align:center;
  color: #fff;
  text-shadow: 0px 0px 2px #000,0px 0px 10px #000;
}
.img-container{
  margin-bottom: 15px;
  padding-top: 20px;
}
.img-container>img{
  height: 100%;
  margin: auto;
  display: block;
}
.teams-stats{
  font-family:Roboto;
  opacity: 0;
  margin-left: -300px;
  -webkit-transition: margin-left .9s,opacity .5s;
}
.teams-stats>div{
  box-shadow: inset 0 0 10px 0 #000;
  border-radius: 3px;
  padding-top: 15px;
  padding-bottom: 15px;
  margin-bottom: 15px;
}
.photo-container{
  padding: 0;
  border-radius: 100%;
  overflow: hidden;
  width: 30px;
  height: 30px;
  float: left;
}
.photo-container>img{
  padding: 0;
}
.photo-container>i{
  position: absolute;
  display: none;
  color: white;
  left: 13px;
  top: 13px;
  cursor: pointer;
  z-index: 1;
}
.photo-container:hover i{
  display: block;
}
.events-container{
  background:#111;
  border: 1px solid rgba(0,0,0,.1);
  color:#ddd;
  border-radius: 2px;
  box-shadow: 0 0 10px #000;
  padding: 15px;
}
.events-list>div{
  border-radius: 3px;
  margin-bottom:5px;
  background: transparent;
  border: 1px solid transparent;
  cursor: pointer;
  -webkit-transition: background .4s;
}
.events-list>div:hover{
  background: transparent;
  color: white;
  border: 1px solid transparent;
}
.module{
  display: none;
}
.lineup{
  color:#888;
}
.clickeable{
  cursor: pointer;
}
.selected{
  border: 2px solid dodgerblue;
}
.team-selector{
  padding: 0;
}
.match-state-btn{
  background-color: transparent;
  border: 1px solid #fff;
  border-radius: 2px;
  float: right;
  margin-top: 40px;
  padding: 10px;
  padding-left: 20px;
  padding-right: 20px;
  box-shadow: 0 1px 3px 0 #333;
  font-size: 18px;
  -webkit-transition: background-color .3s;
}
.match-state-btn:hover{
  background-color: rgba(255,255,255,.1);
}
</style>
@endsection

@section('body')
<div class="coverContainer">
  <h3 class="mainTitle">{{$match->localTeam->name." vs ".$match->visitorTeam->name}}</h3>
  <h4 style="margin-top: 190px;" class="subTitle">{{date('Y-m-d H:i',strtotime($match->start_date))}}</h4>
  <h4 style="margin-top: 10px;" class="subTitle">{{$states[$match->state]}}</h4>
  <h5 style="margin-top: 10px;" class="subTitle">{{$match->referee->name." ".$match->referee->last_name}}</h5>
  <h5 style="margin-top: 10px;" class="subTitle">{{$match->localTeam->stadium->name}}</h5>
</div>
<div class="black-transparent-back">
  <div class="messageBox col-md-4 col-md-offset-4 col-xs-10 col-xs-offset-1">
    <div class="header">
      <h3>Ups...</h3>
    </div>
    <div class="body">
      You must give permissions to the app for continue
    </div>
    <div class="btnBack">
      <div class="btnContainer col-md-12 col-sm-12 col-xs-12">
        <button type="button" name="button" class="btnBlue2">Ok</button>
      </div>
    </div>
  </div>
</div>
<div class="col-md-12 col-xs-12 col-sm-12" style="margin-top:40px;margin-bottom:40px;">
<div class="col-xs-12 col-md-4 teams-stats">
  <h4>Stats</h4>
  <div class="col-xs-12" style="padding-bottom:15px;">
    <div class="col-xs-12 no-padding">
      <div class="col-xs-5 no-padding">
      <div class="col-xs-12 img-container">
        <img src="/storage/{{$match->localTeam->logo}}" alt="">
      </div>
      <h5 style="text-align:center;font-weight:600;">{{$match->localTeam->name}}</h5>
    </div>
    <div class="col-xs-2 no-padding vs" style="margin:0;">
      <h4 style="text-align:center;margin-top:110%;border-radius:3px;padding-top:10px;padding-bottom:10px;">VS</h4>
    </div>
    <div class="col-xs-5 no-padding">
      <div class="col-xs-12 img-container">
        <img src="/storage/{{$match->visitorTeam->logo}}" alt="">
      </div>
      <h5 style="text-align:center;font-weight:600;">{{$match->visitorTeam->name}}</h5>
    </div>
    </div>
    <div class="col-xs-12 no-padding">
      <div class="col-xs-5 no-padding" style="text-align:center;">
      <h3 style="color:red;">{{$match->localTeam->goalsCount}}</h3>
      </div>
      <div class="col-xs-2 no-padding" style="margin:0;">
        <h3 style="text-align:center;">-</h3>
      </div>
      <div class="col-xs-5 no-padding" style="text-align:center;">
        <h3 style="color:red;">{{$match->visitorTeam->goalsCount}}</h3>
      </div>
    </div>

    <div class="col-xs-12 no-padding">
      <div class="col-xs-5 no-padding" style="text-align:center;">
      <h6 style="color:white;font-size:16px;">{{(double)$match->localTeam->pivot->ball_possesion}}%</h6>
      </div>
      <div class="col-xs-2 no-padding" style="margin:0;">
        <h6 style="text-align:center;">ball posession</h6>
      </div>
      <div class="col-xs-5 no-padding" style="text-align:center;">
        <h6 style="color:white;font-size:16px;">{{(double)$match->visitorTeam->pivot->ball_possesion}}%</h6>
      </div>
    </div>
    <!--more states -->
  </div>
  <h4 style="float:left;">Lineups</h4><i class="material-icons" style="padding:0px;margin-top:10px;margin-left:10px;float:left;color:red;">keyboard_arrow_down</i>
  <div class="col-xs-12">
    <div class="col-xs-6 no-padding" id="local-lineup">
      <p style="text-align:center;color:#fff;margin-top:10px;">Local</p>
      @foreach($match->players->where('team_id',$match->localTeam->id) as $player)
      <div class="col-xs-12" style="padding:10px;">
        <div class="photo-container">
          @if($match->state==0)
          <i class="material-icons removePlayer local" id="{{$player->id}}">remove</i>
          @endif
          <img src="{{asset('storage/'.$player->photo)}}" alt="" class="pull-left col-xs-12">
        </div>
        <p style="float:left;margin:0;margin-left:10px;margin-top:3px;">{{$player->name." (".$player->positions()->wherePivot('main',1)->first()->abbreviation.")"}}</p>
      </div>
      @endforeach
    </div>
    <div class="col-xs-6 no-padding" id="visitor-lineup">
      <p style="text-align:center;color:#fff;margin-top:10px;">Visitor</p>
      @foreach($match->players->where('team_id',$match->visitorTeam->id) as $player)
      <div class="col-xs-12" style="padding:10px;">
        <div class="photo-container" style="float:right;">
          <img src="{{asset('storage/'.$player->photo)}}" alt="" class="pull-right col-xs-12">
          @if($match->state==0)
          <i class="material-icons removePlayer visitor" style="left:auto;right:13px;" id="{{$player->id}}">remove</i>
          @endif
        </div>
        <p style="float:right; margin:0;margin-right:10px;margin-top:3px;">{{"(".$player->positions()->wherePivot('main',1)->first()->abbreviation.") ".$player->name}}</p>
      </div>
      @endforeach
    </div>
  </div>
  @if($match->state == 0)
  <h4 style="float:left;">Line up the player</h4><i class="material-icons" style="padding:0px;margin-top:10px;margin-left:10px;float:left;color:green;">keyboard_arrow_up</i>
  <div class="col-xs-12 no-padding">
    <div class="col-xs-6 no-padding" id="local-players">
      @foreach($match->localTeam->players as $player)
      <div class="col-xs-12" style="padding:10px;">
        <div class="photo-container">
          <i class="material-icons addPlayer local" id="{{$player->id}}">add</i>
          <img src="{{asset('storage/'.$player->photo)}}" alt="" class="pull-left col-xs-12">
        </div>
        <p style="float:left;margin:0;margin-left:10px;margin-top:3px;">{{$player->name." (".$player->positions()->wherePivot('main',1)->first()->abbreviation.")"}}</p>
      </div>
      @endforeach
    </div>
    <div class="col-xs-6 no-padding" id="visitor-players">
      @foreach($match->visitorTeam->players as $player)
      <div class="col-xs-12" style="padding:10px;">
        <div class="photo-container" style="float:right;">
          <img src="{{asset('storage/'.$player->photo)}}" alt="" class="pull-right col-xs-12">
          <i class="material-icons addPlayer visitor" id="{{$player->id}}" style="left:auto;right:13px;">add</i>
        </div>
        <p style="float:right; margin:0;margin-right:10px;margin-top:3px;">{{"(".$player->positions()->wherePivot('main',1)->first()->abbreviation.") ".$player->name}}</p>
      </div>
      @endforeach
    </div>
  </div>
  @endif
</div>
  <div class="col-xs-12 col-md-8">
    <h4>Events</h4>
    <div class="events-container col-xs-12 no-padding">
    @if($match->state==0)
    <strong class="col-xs-12" style="color:#999;text-align:center;">Programmed time: {{date('H:i',strtotime($match->start_date))}}</strong>
    <div class="col-xs-12" style="text-align:center;padding:15px;">
      <form class="col-xs-12 no-padding" id="startMatch" action="/startMatch" method="post">
        {{csrf_field()}}
        <input type="hidden" name="id" value="{{$match->id}}">
        <button type="submit" name="startMatchBtn" class="btnBlue2">start now!</button>
      </form>
    </div>
    @else
    <div class="events-list col-xs-12 col-md-3 no-padding">
    @if($match->state != 2 and $match->state != 4)
      @foreach(App\League\EventType::get() as $i => $eventType)
      @if($i < 6 and $i != 1)
      <div class="col-xs-12 eventType" id="{{$eventType->id}}">
        <img src="{{asset($eventType->icon)}}" width="16" alt="" style="margin-right:15px;">{{$eventType->description}}
      </div>
      @endif
      @endforeach
    @endif
    </div>

    <div class="col-xs-12 col-md-9">

      <div class="col-xs-12 module" id="1" style="">
        <h3 style="margin-top:0;float:left;">Goal</h3>
        <button type="button" name="sendGoal" class="btnBlue2" style="position:absolute;right:10px;z-index:1;">Add!</button>
        <div class="col-xs-12 no-padding lineup">
          <h4>Select the player that scored. ..</h4>
          <h5>and the assitor </h5>
          <div class="col-xs-12 no-padding">
            <div class="col-xs-6 no-padding" id="local-lineup">
              <p style="text-align:center;color:#fff;margin-top:10px;">Local</p>
              @foreach($match->players->where('team_id',$match->localTeam->id) as $player)
              @if($player->pivot->playing == 1)
              <div class="col-xs-12 goal" style="padding:10px;">
                <div class="photo-container clickeable" id="{{$player->id}}">
                  @if($match->state==0)
                  <i class="material-icons removePlayer local" id="{{$player->id}}">remove</i>
                  @endif
                  <img src="{{asset('storage/'.$player->photo)}}" alt="" class="pull-left col-xs-12">
                </div>
                <p style="float:left;margin:0;margin-left:10px;margin-top:3px;">{{$player->name." (".$player->positions()->wherePivot('main',1)->first()->abbreviation.")"}}</p>
              </div>
              @endif
              @endforeach
            </div>
            <div class="col-xs-6 no-padding" id="visitor-lineup">
              <p style="text-align:center;color:#fff;margin-top:10px;">Visitor</p>
              @foreach($match->players->where('team_id',$match->visitorTeam->id) as $player)
              @if($player->pivot->playing == 1)
              <div class="col-xs-12 goal" style="padding:10px;">
                <div class="photo-container clickeable" style="float:right;" id="{{$player->id}}">
                  <img src="{{asset('storage/'.$player->photo)}}" alt="" class="pull-right col-xs-12">
                  @if($match->state==0)
                  <i class="material-icons removePlayer visitor" style="left:auto;right:13px;" id="{{$player->id}}">remove</i>
                  @endif
                </div>
                <p style="float:right; margin:0;margin-right:10px;margin-top:3px;">{{"(".$player->positions()->wherePivot('main',1)->first()->abbreviation.") ".$player->name}}</p>
              </div>
              @endif
              @endforeach
            </div>
            <div class="col-xs-12">
              <form class="col-xs-12" action="/addGoal" method="post" id="goalEvent">
                {{csrf_field()}}
                <input type="hidden" name="matchId" value="{{$match->id}}">
                <input type="hidden" name="scorerId" value="">
                <input type="hidden" name="assistorId" value="">
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xs-12 module" id="3" style="">
        <h3 style="margin-top:0;">Corner</h3>
        <div class="col-xs-12 no-padding">
          <div class="col-xs-6 img-container team-selector">
            <img src="{{asset('storage/'.$match->localTeam->logo)}}" alt="" style="height:100%;position:relative; width:auto; margin:auto;display:block;">
          </div>
          <div class="col-xs-6 img-container team-selector">
            <img src="{{asset('storage/'.$match->visitorTeam->logo)}}" alt="" style="height:100%; width:auto; margin:auto;display:block;">
          </div>
          <div class="col-xs-6" style="text-align:center;">
            <input type="radio" name="team-corner" value="{{$match->localTeam->id}}">
          </div>
          <div class="col-xs-6" style="text-align:center;">
            <input type="radio" name="team-corner" value="{{$match->visitorTeam->id}}">
          </div>
          <form class="col-xs-12" action="/addCorner" method="post" id="addCorners">
            {{csrf_field()}}
            <input type="hidden" name="teamId" value="">
            <input type="hidden" name="matchId" value="{{$match->id}}">
          </form>
          <div class="col-xs-12 no-padding" style="text-align:center;">
            <button type="button" name="addCorner" class="btnBlue" style="margin-top:40px;">Continue</button>
          </div>
        </div>
      </div>

      <div class="col-xs-12 module" id="4" style="">
        <h3 style="margin-top:0;float:left;">Yellow card</h3>
        <button type="button" name="addYellowCardBtn" class="btnBlue2" style="float:right;">Continue</button>
        <div class="col-xs-12 no-padding">
          <div class="col-xs-12 no-padding lineup">
            <h4>Select the player that received the yellow card...</h4>
            <div class="col-xs-12 no-padding">
              <div class="col-xs-6 no-padding" id="local-lineup">
                <p style="text-align:center;color:#fff;margin-top:10px;">Local</p>
                @foreach($match->players->where('team_id',$match->localTeam->id) as $player)
                @if($player->pivot->playing == 1)
                <div class="col-xs-12 player-yellow-card" style="padding:10px;">
                  <div class="photo-container clickeable" id="{{$player->id}}">
                    @if($match->state==0)
                    <i class="material-icons removePlayer local" id="{{$player->id}}">remove</i>
                    @endif
                    <img src="{{asset('storage/'.$player->photo)}}" alt="" class="pull-left col-xs-12">
                  </div>
                  <p style="float:left;margin:0;margin-left:10px;margin-top:3px;">{{$player->name." (".$player->positions()->wherePivot('main',1)->first()->abbreviation.")"}}</p>
                </div>
                @endif
                @endforeach
              </div>
              <div class="col-xs-6 no-padding" id="visitor-lineup">
                <p style="text-align:center;color:#fff;margin-top:10px;">Visitor</p>
                @foreach($match->players->where('team_id',$match->visitorTeam->id) as $player)
                @if($player->pivot->playing == 1)
                <div class="col-xs-12 player-yellow-card" style="padding:10px;">
                  <div class="photo-container clickeable" style="float:right;" id="{{$player->id}}">
                    <img src="{{asset('storage/'.$player->photo)}}" alt="" class="pull-right col-xs-12">
                    @if($match->state==0)
                    <i class="material-icons removePlayer visitor" style="left:auto;right:13px;" id="{{$player->id}}">remove</i>
                    @endif
                  </div>
                  <p style="float:right; margin:0;margin-right:10px;margin-top:3px;">{{"(".$player->positions()->wherePivot('main',1)->first()->abbreviation.") ".$player->name}}</p>
                </div>
                @endif
                @endforeach
              </div>
              <div class="col-xs-12">
                <form class="col-xs-12" action="/addYellowCard" method="post" id="yellowCardEvent">
                  {{csrf_field()}}
                  <input type="hidden" name="matchId" value="{{$match->id}}">
                  <input type="hidden" name="playerId" id="player-yellow-card" value="">
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xs-12 module" id="5" style="">
        <div class="col-xs-12">
          <h3 style="margin-top:0;float:left;">Red card</h3>
          <button type="button" name="addRedCardBtn" class="btnBlue2" style="float:right;">Continue</button>
          <div class="col-xs-12 no-padding">
            <div class="col-xs-12 no-padding lineup">
              <h4>Select the player that received the red card...</h4>
              <div class="col-xs-12 no-padding">
                <div class="col-xs-6 no-padding" id="local-lineup">
                  <p style="text-align:center;color:#fff;margin-top:10px;">Local</p>
                  @foreach($match->players->where('team_id',$match->localTeam->id) as $player)
                  @if($player->pivot->playing == 1)
                  <div class="col-xs-12 player-red-card" style="padding:10px;">
                    <div class="photo-container clickeable" id="{{$player->id}}">
                      @if($match->state==0)
                      <i class="material-icons removePlayer local" id="{{$player->id}}">remove</i>
                      @endif
                      <img src="{{asset('storage/'.$player->photo)}}" alt="" class="pull-left col-xs-12">
                    </div>
                    <p style="float:left;margin:0;margin-left:10px;margin-top:3px;">{{$player->name." (".$player->positions()->wherePivot('main',1)->first()->abbreviation.")"}}</p>
                  </div>
                  @endif
                  @endforeach
                </div>
                <div class="col-xs-6 no-padding" id="visitor-lineup">
                  <p style="text-align:center;color:#fff;margin-top:10px;">Visitor</p>
                  @foreach($match->players->where('team_id',$match->visitorTeam->id) as $player)
                  @if($player->pivot->playing == 1)
                  <div class="col-xs-12 player-red-card" style="padding:10px;">
                    <div class="photo-container clickeable" style="float:right;" id="{{$player->id}}">
                      <img src="{{asset('storage/'.$player->photo)}}" alt="" class="pull-right col-xs-12">
                      @if($match->state==0)
                      <i class="material-icons removePlayer visitor" style="left:auto;right:13px;" id="{{$player->id}}">remove</i>
                      @endif
                    </div>
                    <p style="float:right; margin:0;margin-right:10px;margin-top:3px;">{{"(".$player->positions()->wherePivot('main',1)->first()->abbreviation.") ".$player->name}}</p>
                  </div>
                  @endif
                  @endforeach
                </div>
                <div class="col-xs-12">
                  <form class="col-xs-12" action="/addRedCard" method="post" id="redCardEvent">
                    {{csrf_field()}}
                    <input type="hidden" name="matchId" value="{{$match->id}}">
                    <input type="hidden" name="playerId" id="player-red-card" value="">
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xs-12 module" id="6" style="">
        <div class="col-xs-12">
          <h3 style="margin-top:0;float:left;">Shoot</h3>
          <button type="button" name="addShootBtn" class="btnBlue2" style="float:right;">Continue</button>
          <div class="col-xs-12 no-padding">
            <div class="col-xs-12 no-padding lineup">
              <h4>Select the player that has shot...</h4>
              <div class="col-xs-12 no-padding">
                <div class="col-xs-6 no-padding" id="local-lineup">
                  <p style="text-align:center;color:#fff;margin-top:10px;">Local</p>
                  @foreach($match->players->where('team_id',$match->localTeam->id) as $player)
                  @if($player->pivot->playing == 1)
                  <div class="col-xs-12 shoter-player" style="padding:10px;">
                    <div class="photo-container clickeable" id="{{$player->id}}">
                      @if($match->state==0)
                      <i class="material-icons removePlayer local" id="{{$player->id}}">remove</i>
                      @endif
                      <img src="{{asset('storage/'.$player->photo)}}" alt="" class="pull-left col-xs-12">
                    </div>
                    <p style="float:left;margin:0;margin-left:10px;margin-top:3px;">{{$player->name." (".$player->positions()->wherePivot('main',1)->first()->abbreviation.")"}}</p>
                  </div>
                  @endif
                  @endforeach
                </div>
                <div class="col-xs-6 no-padding" id="visitor-lineup">
                  <p style="text-align:center;color:#fff;margin-top:10px;">Visitor</p>
                  @foreach($match->players->where('team_id',$match->visitorTeam->id) as $player)
                  @if($player->pivot->playing == 1)
                  <div class="col-xs-12 shoter-player" style="padding:10px;">
                    <div class="photo-container clickeable" style="float:right;" id="{{$player->id}}">
                      <img src="{{asset('storage/'.$player->photo)}}" alt="" class="pull-right col-xs-12">
                      @if($match->state==0)
                      <i class="material-icons removePlayer visitor" style="left:auto;right:13px;" id="{{$player->id}}">remove</i>
                      @endif
                    </div>
                    <p style="float:right; margin:0;margin-right:10px;margin-top:3px;">{{"(".$player->positions()->wherePivot('main',1)->first()->abbreviation.") ".$player->name}}</p>
                  </div>
                  @endif
                  @endforeach
                </div>
                <div class="col-xs-12">
                  <form class="col-xs-12" action="/addShoot" method="post" id="shootEvent">
                    {{csrf_field()}}
                    <input type="hidden" name="matchId" value="{{$match->id}}">
                    <input type="hidden" name="playerId" id="shooterPlayer" value="">
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xs-12" style="text-align:center;padding:15px;">
        @if($match->state == 1)
        <a href="/admin/end-first-half/{{$match->id}}" name="endFirstHalfBtn" class="match-state-btn">end first half</a>
        @elseif($match->state == 2)
        <a href="/admin/start-second-half/{{$match->id}}" name="startSecondHalfBtn" class="match-state-btn">start second half</a>
        @elseif($match->state == 3)
        <a href="/admin/end-match/{{$match->id}}" name="endMatchBtn" class="match-state-btn">end match</a>
        @endif
      </div>
    </div>
    @endif
    </div>

    <div class="col-xs-12 col-md-4 no-padding events-container" style="margin-top:20px;">
      <h4 style="margin-top:0px;">Ball possesion</h4>
      <div class="col-xs-12 no-padding">
        <div class="" style="float:left;text-align:center;">
          <strong>{{$match->localTeam->name}}</strong>
        </div>
        <div class="pull-right" style=";text-align:center;">
          <strong>{{$match->visitorTeam->name}}</strong>
        </div>
      </div>
      <div class="col-xs-12 no-padding">
        <form class="col-xs-12 no-padding" action="/changeBallPossesion" method="post">
          {{csrf_field()}}
          <input type="hidden" name="matchId" value="{{$match->id}}">
          <input type="hidden" name="localTeamId" value="{{$match->localTeam->id}}">
          <input type="hidden" name="visitorTeamId" value="{{$match->visitorTeam->id}}">
          @if((double)$match->localTeam->pivot->ball_possesion < 0)
          <input type="range" id="posession" name="localTeamPosession" value="50" class="mdl-slider mdl-js-slider" min="0" max="100">
          @else
          <input type="range" id="posession" name="localTeamPosession" value="{{(double)$match->localTeam->pivot->ball_possesion}}" class="mdl-slider mdl-js-slider" min="0" max="100">
          @endif
          <div class="" style="float:left; width:70px; background:#222;border-radius:2px; text-align:center;" id="localPosession">
            {{(double)$match->localTeam->pivot->ball_possesion}}
          </div>
          <div class="pull-right" style=" width:70px; background:#222;border-radius:2px; text-align:center;" id="visitorPosession">
            {{(double)$match->visitorTeam->pivot->ball_possesion}}
          </div>
          <div class="col-xs-12 no-padding" style="padding-top:15px;">
            <button type="submit" name="button" class="btnBlue2 col-xs-12">Set</button>
          </div>
        </form>
      </div>
    </div>

    <div class="col-xs-12 col-md-7 col-md-offset-1 events-container" style="margin-top:20px;">
      <h4 class="col-xs-12">Preview</h4>
      <div class="col-xs-12">
        @foreach($match->events()->orderBy('minute','desc')->get() as $event)
        <div class="col-xs-12 no-padding">
          <img src="{{asset($event->eventType->icon)}}" alt="" width="16">
          @if($event->eventType->id == 7 or $event->eventType->id == 8 or $event->eventType->id == 9)
          <strong style="float:right;color:dodgerblue;">{{$event->minute."'"}}</strong>
          @else
          <strong style="float:right;">{{$event->minute."'"}}</strong>
          @endif
          <p>{{$event->content}}</p>
        </div>
        @endforeach
      </div>
    </div>

  </div>
</div>
@endsection

@section('js')

@if(session('msg'))
<script>
$(function ($) {
  $('.black-transparent-back').fadeIn('slow',function () {
    $('.messageBox').css('margin-top','20%').css('opacity',1);
    $('.messageBox').children('.header').children('h3').text('{{session("msg")["title"]}}');
    $('.messageBox').children('.body').text('{{session("msg")["content"]}}');
  });
});
</script>
@endif

<script type="text/javascript">

  $(function ($) {

    $('input#posession').change(function () {
      $('div#localPosession').text($(this).val()+"%");
      $('div#visitorPosession').text((100-$(this).val())+"%");
    });

    $('button[name=addYellowCardBtn]').click(function () {
      $('form#yellowCardEvent').submit();
    });

    $('button[name=addShootBtn]').click(function () {
      $('form#shootEvent').submit();
    });

    $('button[name=addRedCardBtn]').click(function () {
      $('form#redCardEvent').submit();
    });

    $('input[name=team-corner]').change(function () {
      $('form#addCorners').children('input[name=teamId]').val($(this).val());
    });

    $('button[name=addCorner]').click(function () {
      $('form#addCorners').submit();
    });

    $('button[name=sendGoal]').click(function () {
      $('form#goalEvent').submit();
    });

    $('.shoter-player').children('.clickeable').click(function () {
      $('.shoter-player').children('.clickeable').css('border','0px none rgb(51, 51, 51)');
      $('input#shooterPlayer').val($(this).attr('id'));
      $(this).css({
        border:'2px solid dodgerblue'
      });
    });

    $('.player-yellow-card').children('.clickeable').click(function () {
      $('.player-yellow-card').children('.clickeable').css('border','0px none rgb(51, 51, 51)');
      $('input#player-yellow-card').val($(this).attr('id'));
      $(this).css({
        border:'2px solid dodgerblue'
      });
    });

    $('.player-red-card').children('.clickeable').click(function () {
      $('.player-red-card').children('.clickeable').css('border','0px none rgb(51, 51, 51)');
      $('input#player-red-card').val($(this).attr('id'));
      $(this).css({
        border:'2px solid dodgerblue'
      });
    });

    $('.goal').children('.clickeable').contextmenu(function (evt) {
      evt.preventDefault();
      if($(this).css('border') == '2px solid rgb(255, 0, 0)'){
        $(this).css('border','0px none rgb(51, 51, 51)');
        $('input[name=assistorId]').val('');
      }
      else{
        $.each($('.goal').children('.clickeable'),function (i,e) {
          if($(e).css('border') == '2px solid rgb(255, 0, 0)'){
            $(e).css('border','0px none rgb(51, 51, 51)');
          }
        });
        $('input[name=assistorId]').val($(this).attr('id'));
        $(this).css({
          border:'2px solid red'
        });
      }
    });

    $('.goal').children('.clickeable').click(function () {
      $.each($('.goal').children('.clickeable'),function (i,e) {
        if($(e).css('border') == '2px solid rgb(30, 144, 255)'){
          $(e).css('border','0px none rgb(51, 51, 51)');
        }
      });
      $('input[name=scorerId]').val($(this).attr('id'));
      $(this).css({
        border:'2px solid dodgerblue'
      });
    });

    var localPlayersCount=0,visitorPlayersCount=0;
    $('.addPlayer').click(function () {
      if($(this).text() == 'add'){
        if(($(this).hasClass('local') && localPlayersCount > 18) || (!$(this).hasClass('local') && visitorPlayersCount > 18)){
          showMessages('Alert!','The max number of players per team are 18.');
        }
        else{
          $(this).text('remove');
          var $input=$('<input type="hidden" class="" name="players[]" id="playersToPlay">');
          $input.attr('value',$(this).attr('id'));
          $('form#startMatch').append($input);
          if($(this).hasClass('local')) {
            $('#local-lineup').append($(this).parent().parent());
            localPlayersCount++;
            if(localPlayersCount == 11)
              $('#local-lineup').append($('<hr>'));
          }
          else {
            $('#visitor-lineup').append($(this).parent().parent());
            visitorPlayersCount++;
            if(visitorPlayersCount == 11)
              $('#visitor-lineup').append($('<hr>'));
          }
        }
      }
      else{
        $(this).text('add');
        $('form#startMatch').children('input[type=hidden][value='+$(this).attr('id')+']').remove();
        if($(this).hasClass('local')) {
          $('#local-players').append($(this).parent().parent());
          localPlayersCount--;
          if(localPlayersCount == 10)
            $('#local-lineup').children('<hr>').remove();
        }
        else {
          $('#visitor-players').append($(this).parent().parent());
          visitorPlayersCount--;
          if(visitorPlayersCount == 10)
            $('#visitor-lineup').children('<hr>').remove();
        }
      }
    });

    $('.eventType').click(function () {
      $('.module').fadeOut(0);
      $('div.module[id='+$(this).attr('id')+']').fadeIn(200);
    });

    $('.teams-stats').css('margin-left',0);
    $('.teams-stats').css('opacity',1);

    $('.img-container').height($('.img-container').width());
    $('.vs').height($('.img-container').width());
    $(window).resize(function () {
      $('.img-container').height($('.img-container').width());
      $('.vs').height($('.img-container').width());
    });

    function showMessages(title,msg,type) {
      $('.black-transparent-back').fadeIn('slow',function () {
        $('.messageBox').css('margin-top','20%').css('opacity',1);
        $('.messageBox').children('.hearder').children('h4').text(title);
        $('.messageBox').children('.body').text(msg);
      });
    }

    $('.black-transparent-back').click(function () {
      $('.messageBox').css('margin-top','10%').css('opacity',0);
      $(this).fadeOut(1000);
    });

  });
</script>
@endsection

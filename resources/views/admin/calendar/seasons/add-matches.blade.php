@extends('layouts.master')

@section('title')
Add seasons
@endsection

@section('css')
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<style media="screen">
body{
  background:  #222525;
  color: #ddd;
}
.coverContainer{
    height: 400px;
    background-size: cover;
    background-image: url("{{asset('img/management.jpg')}}");
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
#manageMenu{
    position: relative;
    border: 1px solid rgba(0,0,0,.4);
    border-radius: 3px;
    padding: 0;
    overflow: hidden;
    box-shadow: 0px 1px 1px 0px rgba(0,0,0,.2);
}
.manageMenuHeader{
    background-color: dodgerblue;
    border-top: 1px solid skyblue;
    position: relative;
    text-align: center;
    margin: 0px;
    padding: 3px;
}
.manageMenuItem{
    background-color: rgba(0,0,0,.1);
    position: relative;
    border: 1px solid transparent;
    text-align: center;
    margin: 0px;
    padding: 3px;
    -webkit-transition: background-color .1s;
    font-weight: 400;
}
.manageMenuItem:hover{
    border: 1px solid #333;
    background-color: rgba(255,255,255,.01);
}
.item-active{
    border-left: none;
    border-right: none;
    box-shadow: inset 0px 0px 8px 0px #111;
}
.no-padding{
  padding: 0;
}
.file-big-container{
  position: relative;
  border: 1px dashed #555;
  box-shadow: inset 0 0 10px 0 #000;
  border-radius: 6px;
  margin-bottom: 15px;
  overflow: hidden;
  padding: 0;
  height: 200px;
}
.file-big-container > input{
    top: 0;
    right: 0;
    opacity: 0;
    position: absolute;
    font-size: 100px;
    width: 100%;
    height: 100%;
}
.teams-selection-container{
  background-color: #000;
  margin-bottom: 15px;
  border-radius: 3px;
  padding-top: 10px;
  padding-bottom: 10px;
  max-height: 200px;
  box-shadow: 0 1px 3px #000;
  overflow: auto;
}

.teams-selection-container::-webkit-scrollbar {
    width: 5px;
}

.teams-selection-container::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.1);
    padding-left: 2px;
    padding-right: 2px;
}

.teams-selection-container::-webkit-scrollbar-thumb {
  background-color: #222;
  border-radius: 5px;
  outline: 1px solid slategrey;
}
.whiteInput{
    background-color: #ddd;
    box-shadow: 0px 1px 4px 0px #111;
    border:0;
    font-weight: 400;
    border-radius: 3px;
    padding: 5px 10px 5px 10px;
    color: #555;
    -webkit-transition: color .3s;
}
.whiteInput:hover{
    color: black;
}
.btnBlue2{
  background: linear-gradient(to bottom, dodgerblue,#0c70dd);
  border-radius: 2px;
  border: 0px;
  border-top: 1px solid skyblue;
  border-bottom: 1px solid dodgerblue;
  padding: 3px 10px 3px 10px;
  -webkit-transition: background .4s;
}
.btnBlue2:hover{
  background: linear-gradient(to bottom, #2fa1ff,#1b81ee);
}
.blackWell{
  background-color: #111;
  border-radius: 3px;
  box-shadow: 0 1px 2px 0 #000;
  overflow: hidden;
}
.blackWell > .header{
  margin: 0;
  background-color: dodgerblue;
  padding: 10px 10px 10px 10px;
  margin-bottom: 15px;
}
.blackWell > .header > h4{
  padding: 0;
  margin: 0;
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
.autocomplete-container{
  position: relative;
  display: inline-block;
  width: 100%;
  margin-top: 1px;
  border-bottom-left-radius: 3px;
  border-bottom-right-radius: 3px;
  z-index: 0;
  overflow: hidden;
  box-shadow: 0 0 3px 0 #000;
  margin: 0;
  display: none;
}
.autocomplete-item{
  background: rgba(255,255,255,.1);
  position: relative;
  z-index: 10;
  color:#ddd;
  cursor: pointer;
  text-align: center;
  padding-top: 5px;
}
.autocomplete-item:hover{
  background: rgba(255,255,255,.15);
  color: #fff;
}
.pos-container{
  background-color: white;
  float: left;
  color: #111;
  font-weight: 600;
  margin: auto;
  display: block;
  margin-top: 10px;
  margin-bottom: 10px;
  border-radius: 3px;
  width: 100%;
  text-align: center;
}
#positionSelector{
  padding: 0;
  overflow: hidden;
  max-height: none;
}
.Item > i.material-icons{
  margin-top: 9px;
  cursor: pointer;
}
.players-container{
  background-color: #222;
  border-radius: 2px;
  box-shadow: inset 0 0 8px 0 #000;
  border: 1px solid rgba(0,0,0,.1);
  overflow: auto;
  max-height: 600px;
}
input[name=playerSearchBox]{
  border-radius: 3px;
  background: linear-gradient(to bottom,#222,#000);
  box-shadow: 0 0 10px 0 #000;
  border: 1px solid #999;
  color: #ddd;
}
input[name=playerSearchBox]:hover{
  color: #fff;
}
.matchday-item{font-family: Roboto;
  border: 1px solid #000;
  border-radius: 2px;
  color: #fff;
  cursor: pointer;
  float: left;
  width: 90%;
  margin-left: 0%;
  margin-right: 10%;
  background: #000;
  text-align: center;
  margin-bottom: 2px;
  -webkit-transition: width .4s, margin-left .4s;
}
.matchday-item:active{
  color:#ddd;
}
.matchday-item:hover{
  width: 100%;
  margin-left: 0%;
  margin-right: 0%;
}
#addMatchBtn:hover{
  color:white;
}
.teams-selection-container{
  display: inline-block;
}
.Item{
  position: relative;
  display: inline;
  padding: 10px;
}
.teams-selection-container > .Item:hover{
  color: #fff;
  cursor: pointer;
}
.Item>div.img-container{
  border-radius: 100%;
  padding: 0;
  overflow: hidden;
  float: left;
  width: 50px;
  height: 50px;
}
.Item> div >img{
  width: 100%;
  height: auto;
}
.teamItemParent{
  display: none;
}
.teamItem{
  background: #000;
  overflow: hidden;
  border-radius: 3px;
  box-shadow: inset 0 0 9px 0 rgba(0,0,0,1);
  border: 1px solid #222;
  cursor: pointer;
}
.teamItem >.img-container{
  width: 100%;
  height: 100%;
  margin: auto;
  overflow: hidden;
  display: block;
}
.teamItem >.img-container>img{
  height: 90%;
  margin: auto;
  margin-top: 5%;
  margin-bottom: 5%;
  display: block;
}
#matchesContainer{
  background: #222;

}
th{
  font-family: Roboto;
  text-align: center;
}
td{
  font-family: Roboto;
  text-align:center;
  background:red;
  font-size:12px;
}
</style>
@endsection

@section('body')
<div class="coverContainer">
  <h3 class="mainTitle">Seasons management</h3>
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
<div class="col-md-12 col-xs-12 col-sm-12" style="margin-top:90px;margin-bottom:40px;">
  <div class="col-md-2 col-md-offset-1 col-sm-2 col-sm-offset-0 col-xs-12" id="manageMenu">
      <a class="manageMenuHeader col-md-12 col-sm-12 col-xs-12">Matches...</a>
      <a href="/admin/seasons/add" class="manageMenuItem item-active col-md-12 col-sm-12 col-xs-12">Add</a>
      <!--<a href="/admin/seasons/edit" class="manageMenuItem col-md-12 col-sm-12 col-xs-12">Edit</a>-->
  </div>
  <div class="col-md-7 col-md-offset-1 no-padding col-xs-12 blackWell">
    <div class="header">
      @if(isset($firstSeason))
      <h4>Programme season ({{$firstSeason['start_date']['month'].' '.$firstSeason['start_date']['year'].' - '.$firstSeason['end_date']['month'].' '.$firstSeason['end_date']['year']}})</h4>
      @elseif(isset($season))
      <h4>{{date('F Y',strtotime($season->start_date)).' - May '.(date('Y',strtotime($season->start_date))+1)}}</h4>
      @elseif(isset($nextSeason))
      <h4>{{date('F Y',$nextSeason['start_date']).' - May '.(date('Y',$nextSeason['start_date'])+1)}}</h4>
      @elseif(isset($uncomingSeason))
      <h4>Waiting for next season</h4>
      @endif
    </div>
    <div class="col-xs-12 col-md-4" style="margin-bottom:15px;">
      @for($i = 1; $i <= 38; $i++)
      <div class="matchday-item" id="{{$i}}">
        Matchday {{$i}}
      </div>
      @endfor
    </div>
    <div class="col-xs-12 col-md-8" style="margin-bottom:15px;">
      @if(isset($uncomingSeason))
      <h4>There is a season ready and going on... You will be able to set up the next season until the current one had finished.</h4>
      @else
      <h4 class="col-xs-12">New match...</h4>
      <p class="col-xs-12">Approximately there are 10 matches at a matchday... Approximately there is a match day each week. <b>Please consider that it is irregular.</b></p>
      <div class="col-xs-12" id="match-data">
        <form class="" action="/addMatch" method="post">
          {{csrf_field()}}
          @if(isset($season))
          <input type="hidden" name="seasonId" value="{{$season->id}}">
          @endif
          <input type="hidden" name="refereeId" value="">
          <input type="hidden" name="localId" value="">
          <input type="hidden" name="visitorId" value="">
          <input type="hidden" name="matchday" value="">
          <div class="form-group no-padding col-xs-12">
            <label for="">Date</label>
            <input type="date" name="date" value="{{old('date')}}" class="myInputWhite col-xs-12">
          </div>
          <div class="form-group no-padding col-xs-12">
            <label for="">Time</label>
            <input type="time" name="time" value="{{old('time')}}" class="myInputWhite col-xs-12">
          </div>
          <label>Referee</label>
          <div class="col-xs-12 no-padding teams-selection-container" id="coachSelector" style="padding:0;">
            @if(App\League\Referee::count() < 1)
            <h4 style="text-align:center;">No referees</h4>
            @else
            @foreach(App\League\Referee::get() as $i => $referee)
            <div class="col-xs-12 no-padding Item" id="{{$referee->id}}">
              <div class="img-container">
                <img src="{{asset('storage/'.$referee->photo)}}" alt="" class="">
              </div>
              <div class="" style="float:left;height:100%;">
                <h5 style="margin:0;padding-top:17px;margin-left:20px;height:50px;">{{$referee->name.' '.$referee->last_name}}</h5>
              </div>
            </div>
            @endforeach
            @endif
          </div>
          <label for="" class="col-xs-12 no-padding">Teams</label>
          <div class="col-xs-12 no-padding teams-selection-container" id="teamSelector" style="padding:0;">
            @if(App\League\Team::count() < 1)
            <h4 style="text-align:center;">No teams</h4>
            @else
            @foreach(App\League\Team::get() as $i => $team)
            <div class="col-xs-6 col-md-3 teamItemParent" style="padding:15px;">
              <div class="col-xs-12 no-padding teamItem" id="{{$team->id}}">
                <div class="img-container">
                  <img src="{{asset('storage/'.$team->logo)}}" alt="" class="">
                </div>
              </div>
              <div class="col-xs-12 no-padding" style="">
                <h6 style="margin:0;padding-top:15px;padding-bottom:15px;text-align:center;">{{$team->name}}</h6>
              </div>
            </div>
            @endforeach
            @endif
          </div>
          <div class="col-xs-12">
            <div id="addMatchBtn" class="" style="margin:auto;width:100px;background:transparent;text-align:center;border-radius:5px;border:1px dashed #888;cursor:pointer;">
              <i class="material-icons" style="font-size:16px;position:relative; top:3px; left:0px;margin-left:0;">add</i> Continue
            </div>
          </div>
        </form>
      </div>
      @endif
      <h4 id="matchTitle" class="col-xs-12 no-padding" style="display:none;">Matches list</h4>
      <table class="col-xs-12 no-padding" id="matchesContainer" style="display:none;">
        <thead>
          <th>Local</th>
          <th></th>
          <th>Visitor</th>
          <th>Referee</th>
          <th>Date</th>
          <th>Time</th>
        </thead>
        <tbody>

        </tbody>
      </table>
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

@if(session('matchday'))
<script>
$(function ($) {
  $('.matchday-item[id={{session("matchday")}}]').css('border-left','2px solid dodgerblue');
  $('#matchesContainer').fadeIn(300);
  $('#matchTitle').fadeIn(300);
  $('input[type=hidden][name=matchday]').val('{{session("matchday")}}');
  var days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
  $.ajax({
    url:'/getMatchesPerMatchDay',
    type:'post',
    dataType:'json',
    data:{
      _token: '{{csrf_token()}}',
      matchday: '{{session("matchday")}}'
    }
  }).done(function (response) {
    $.each(response,function (i,match) {
      var $item = $('<tr>');
      $item.css({
        padding:'5px',
        width:'100%',
        position:'relative'
      });
      var $team1=$('<img>').attr('src',"/storage/"+match.teams[0].logo).css({
        height:'20px'
      });
      var $team2=$('<img>').attr('src',"/storage/"+match.teams[1].logo).css({
        height:'20px'
      });
      $td1=$('<td>')
      $td2=$('<td>').text('vs');
      $td3=$('<td>');
      $td4=$('<td>').text(match.referee.name+" "+match.referee.last_name);
      var date=new Date(match.start_date);
      $td5=$('<td>').text(days[date.getDay()]+", "+date.getDate()+"/"+(date.getMonth()+1)+"/"+date.getFullYear());
      var hrs = date.getHours();
      var min = date.getMinutes();
      if(String(hrs).length < 2){
        hrs = "0"+String(hrs);
      }
      if(String(min).length < 2){
        min = String(min)+"0";
      }
      $td6=$('<td>').text(hrs+":"+min);
      if(match.teams[0].pivot.local == 1){
        $td1.append($team1);
        $td3.append($team2);
      }
      else{
        $td1.append($team2);
        $td3.append($team1);
      }
      $item.append($td1);
      $item.append($td2);
      $item.append($td3);
      $item.append($td4);
      $item.append($td5);
      $item.append($td6);
      $('#matchesContainer').children('tbody').append($item);
    });
  });
});
</script>
@endif

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC9fuikPcHicK9HnQSzmHM-iZikumk6710&libraries=places&language=en"></script>
<script type="text/javascript">
  var topPos=0;

  $(function ($) {

    $('.teamItem').height($('.teamItem').width());
    $(window).resize(function () {
      $('.teamItem').height($('.teamItem').width());
    });

    $('.teamItemParent').fadeIn('1000');

    function showMessages(title,msg,type) {
      $('.black-transparent-back').fadeIn('slow',function () {
        $('.messageBox').css('margin-top','20%').css('opacity',1);
        $('.messageBox').children('.hearder').children('h4').text(title);
        $('.messageBox').children('.body').text(msg);
      });
    }

    $('div#addMatchBtn').click(function () {
      $('form').submit();
    });

    var days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];

    $('.matchday-item').click(function () {
      $('.matchday-item').css('border-left','2px solid transparent');
      $(this).css('border-left','2px solid dodgerblue');
      $('#matchesContainer').fadeIn(300);
      $('#matchTitle').fadeIn(300);
      $('#matchesContainer').children('tbody').children().remove();
      $('input[type=hidden][name=matchday]').val($(this).attr('id'));
      $.ajax({
        url:'/getMatchesPerMatchDay',
        type:'post',
        dataType:'json',
        data:{
          _token: '{{csrf_token()}}',
          matchday: $(this).attr('id')
        }
      }).done(function (response) {
        $.each(response,function (i,match) {
          var $item = $('<tr>');
          $item.css({
            padding:'5px',
            width:'100%',
            position:'relative'
          });
          var $team1=$('<img>').attr('src',"/storage/"+match.teams[0].logo).css({
            height:'20px'
          });
          var $team2=$('<img>').attr('src',"/storage/"+match.teams[1].logo).css({
            height:'20px'
          });
          $td1=$('<td>')
          $td2=$('<td>').text('vs');
          $td3=$('<td>');
          $td4=$('<td>').text(match.referee.name+" "+match.referee.last_name);
          var date=new Date(match.start_date);
          $td5=$('<td>').text(days[date.getDay()]+", "+date.getDate()+"/"+(date.getMonth()+1)+"/"+date.getFullYear());
          var hrs = date.getHours();
          var min = date.getMinutes();
          if(String(hrs).length < 2){
            hrs = "0"+String(hrs);
          }
          if(String(min).length < 2){
            min = String(min)+"0";
          }
          $td6=$('<td>').text(hrs+":"+min);
          if(match.teams[0].pivot.local == 1){
            $td1.append($team1);
            $td3.append($team2);
          }
          else{
            $td1.append($team2);
            $td3.append($team1);
          }
          $item.append($td1);
          $item.append($td2);
          $item.append($td3);
          $item.append($td4);
          $item.append($td5);
          $item.append($td6);
          $('#matchesContainer').children('tbody').append($item);
        });
      });
    });

    $('.teams-selection-container').children('.Item').click(function () {
      $('.teams-selection-container').children('.Item').css({
        background:'#000',
        'border-right':'2px solid #000',
        color:'#ddd'
      });
      $(this).css({
        background:'#000',
        'border-right':'2px solid dodgerblue',
        color:'white'
      });
      $('input[name=refereeId][type=hidden]').val($(this).attr('id'));
    });

    $('.teamItem').click(function () {
      $.each($('.teamItem'),function (i,e) {
        if($(e).css('border-color') == 'rgb(30, 144, 255)'){
          $(e).css({
            'background-color':'#000',
            'box-shadow':'none',
            border: '1px solid #222'
          });
        }
      });
      $(this).css({
        'background-color': 'transparent',
        overflow: 'hidden',
        'border-radius': '3px',
        'box-shadow': 'inset 0 0 10px 0 rgba(50,40,255,1)',
        border: '1px solid dodgerblue',
        cursor: 'pointer'
      });
      if($('input[type=hidden][name=visitorId]').val() == $(this).attr('id')){
        $('input[type=hidden][name=visitorId]').val('');
      }
      $('input[type=hidden][name=localId]').val($(this).attr('id'));
    });

    $('.teamItem').contextmenu(function (e) {
      e.preventDefault();
      $.each($('.teamItem'),function (i,e) {
        if($(e).css('border-color') == 'rgb(255, 119, 102)'){
          $(e).css({
            'background-color':'#000',
            'box-shadow':'none',
            border: '1px solid #222'
          });
        }
      });
      $(this).css({
        'background-color': 'transparent',
        overflow: 'hidden',
        'border-radius': '3px',
        'box-shadow': 'inset 0 0 10px 0 rgba(255,40,30,.8)',
        border: '1px solid #f76',
        cursor: 'pointer'
      });
      if($('input[type=hidden][name=localId]').val() == $(this).attr('id')){
        $('input[type=hidden][name=localId]').val('');
      }
      $('input[type=hidden][name=visitorId]').val($(this).attr('id'));
    });

    $('.black-transparent-back').click(function () {
      $('.messageBox').css('margin-top','10%').css('opacity',0);
      $(this).fadeOut(1000);
    });
  });
</script>
@endsection

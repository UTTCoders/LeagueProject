@extends('layouts.master')

@section('title')
Edit teams
@endsection

@section('css')
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
.teams-selection-container > .Item{
  overflow: hidden;
  height: 45px;
}
.Item > div > h5{
  margin: 15px;
}
.Item > img{
  border-radius: 2px;
}
.teams-selection-container > .Item:hover{
  background-color: #000;
  cursor: pointer;
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
#teamSelector{
  margin: -15px 0 0 0;
  max-height: 500px;
  height: 100%;
}
.team-item{
  width: 100%;
  padding: 15px;
  display: inline-block;
  cursor: pointer;
}
.team-item:hover{
  border-left: 2px solid dodgerblue;
}
.team-item > div > img{
  margin: auto;
  display: block;
}
.team-item > div > p{
  margin: 0;
}
.team-item:hover div p{
  color:white;
}
.team-item > div > p.stadiumAndcoach{
  font-size: 14px;
}
#coachSelector,#stadiumSelector{
  display: none;
}

</style>
@endsection

@section('body')
<div class="coverContainer">
  <h3 class="mainTitle">Teams</h3>
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
  <div class="col-md-2 col-md-offset-1 col-sm-2 col-sm-offset-0 col-xs-10 col-xs-offset-1" id="manageMenu">
      <a class="manageMenuHeader col-md-12 col-sm-12 col-xs-12">Teams...</a>
      <a href="/admin/teams/add" class="manageMenuItem col-md-12 col-sm-12 col-xs-12">Add</a>
      <a href="/admin/teams/edit" class="manageMenuItem item-active col-md-12 col-sm-12 col-xs-12">Edit</a>
      <a href="/admin/teams/delete" class="manageMenuItem col-md-12 col-sm-12 col-xs-12">Delete</a>
  </div>
  <div class="col-md-7 col-md-offset-1 no-padding col-xs-11 col-xs-offset-1 blackWell">
    <div class="header">
      <h4>Team information</h4>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-12 no-padding" style="height:100%;background-color:#000;">
      <div class="col-md-12 no-padding teams-selection-container" id="teamSelector">
        @foreach(App\League\Team::get() as $team)
        <div class="team-item" id="{{$team->id}}">
          <div class="col-md-4">
            <img src="{{asset('storage/'.$team->logo)}}" width="50" alt="">
          </div>
          <div class="col-md-8">
            <p class="name">{{$team->name}}</p>
            @if($team->stadium)
            <p class="stadiumAndcoach">{{$team->stadium->name.' / '}}
            @else
            <p class="stadiumAndcoach">No team /
            @endif
            @if($team->coach)
            {{' '.$team->coach->name.' '.$team->coach->last_name}}</p>
            @else
            No coach </p>
            @endif
          </div>
        </div>
        @endforeach
      </div>
    </div>
    <div class="col-md-6">
      <form action="/editTeam" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <input type="hidden" name="stadiumId" value="">
        <input type="hidden" name="coachId" value="">
        <input type="hidden" name="teamId" value="">
        <div class="form-group col-md-12 col-xs-12 no-padding">
          <input type="text" name="name" value="{{old('name')}}" class="whiteInput col-md-12 col-xs-12" placeholder="new name...">
        </div>
        <div class="form-group col-md-12 col-xs-12 no-padding">
          <div class="file-big-container col-md-12 col-xs-12">
            <h4 style="text-align:center;margin-top:88px;">Drag or click for select a <b>logo</b>...</h4>
            <input type="file" name="logo" value="">
          </div>
        </div>
        <div class="form-group col-md-12 col-xs-12 no-padding">
          <label for="teamFoundationDate">Foundation date</label>
          <input type="date" name="foundationDate" value="{{old('foundationDate')}}" class="whiteInput col-md-12 col-xs-12">
        </div>
        <div class="form-group col-md-12 col-xs-12 no-padding">
          <input type="checkbox" name="" id="changeStadium" value=""><span style="margin-left: 5px; ;position:absolute; top:2px; font-size:12px; padding-top:0px;"> Change stadium</span>
        </div>
        <div class="form-group col-md-12 col-xs-12 no-padding">
          <input type="checkbox" name="" id="changeCoach" value=""><span style="margin-left: 5px; ;position:absolute; top:2px; font-size:12px; padding-top:0px;"> Change coach</span>
        </div>
        <div class="col-md-12 no-padding teams-selection-container" id="stadiumSelector">
          @if(count($freeStadiums) < 1)
          <h4 style="text-align:center;">No stadiums</h4>
          @else
          @foreach($freeStadiums as $i => $stadium)
          <div class="col-md-12 no-padding Item" id="{{$stadium->id}}">
            <img src="{{asset('storage/'.$stadium->photo)}}" alt="" class="col-md-4">
            <div class="col-md-8">
              <h5>{{$stadium->name}}</h5>
            </div>
          </div>
          @endforeach
          @endif
        </div>
        <div class="col-md-12 no-padding teams-selection-container" id="coachSelector">
          @if(count($freeCoaches) < 1)
          <h4 style="text-align:center;">No coaches</h4>
          @else
          @foreach($freeCoaches as $i => $coach)
          <div class="col-md-12 no-padding Item" id="{{$coach->id}}">
            <img src="{{asset('storage/'.$coach->photo)}}" alt="" class="col-md-3">
            <div class="col-md-9">
              <h5>{{$coach->name}}</h5>
            </div>
          </div>
          @endforeach
          @endif
        </div>
        <div class="form-group col-md-12 col-xs-12 col-sm-12 no-padding">
          <button type="submit" name="editBtn" class="btnBlue2 col-xs-12 col-sm-12 col-md-4 col-md-offset-8">Edit</button>
        </div>
      </form>
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
    $('.messageBox').children('.body').text('{{session("msg")["content"]}}');
  });
});
</script>
@endif
<script type="text/javascript">
  $(function ($) {
    function showMessages(title,msg,type) {
      $('.black-transparent-back').fadeIn('slow',function () {
        $('.messageBox').css('margin-top','20%').css('opacity',1);
        $('.messageBox').children('.body').text(msg);
      });
    }
    $('.file-big-container').change(function () {
      var file = $(this).children('input[type=file]')[0].files[0];
      if(file){
        if(file.type.indexOf('image') < 0 || file.type.indexOf('png') < 0){
          showMessages('Ups!','Only png images.','alert-card');
          $(this).children('input[type=file]').val('');
        }
        else $(this).children('h4').text(file.name);
      }
      else $(this).children('h4').text('Drag or click for select a logo...');
    });

    $('#stadiumSelector').children('.Item').click(function () {
      $('#stadiumSelector').children('.Item').css('background-color','#000');
      $(this).css('background-color','rgba(255,255,255,0.08)');
      $('input[name=stadiumId][type=hidden]').val($(this).attr('id'));
    });

    $('#coachSelector').children('.Item').click(function () {
      $('#coachSelector').children('.Item').css('background-color','#000');
      $(this).css('background-color','rgba(255,255,255,0.08)');
      $('input[name=coachId][type=hidden]').val($(this).attr('id'));
    });

    $('.black-transparent-back').click(function () {
      $('.messageBox').css('margin-top','10%').css('opacity',0);
      $(this).fadeOut(1000);
    });

    $('#changeStadium').change(function () {
      if($(this).prop('checked')){
        $('#stadiumSelector').fadeIn('fast');
      }
      else{
        $('#stadiumSelector').fadeOut('fast');
        $('#stadiumSelector').children('.Item').css('background-color','#000');
        $('input[name=stadiumId][type=hidden]').val('');
      }
    });
    $('#changeCoach').change(function () {
      if($(this).prop('checked')){
        $('#coachSelector').fadeIn('fast');
      }
      else{
        $('#coachSelector').fadeOut('fast');
        $('#coachSelector').children('.Item').css('background-color','#000');
        $('input[name=coachId][type=hidden]').val('');
      }
    });

    $('.team-item').click(function () {
      $('.team-item').css('color','#ddd').css('border-left','0px solid dodgerblue');
      $(this).css('color','white').css('border-left','2px solid dodgerblue');
      $('input[type=hidden][name=teamId]').val($(this).attr('id'));
    });

  });
</script>
@endsection

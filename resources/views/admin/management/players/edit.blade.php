@extends('layouts.master')

@section('title')
Edit players
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
.Item > .img-container{
  width: 60px;
  height: 100%;
  float: left;
  padding: 3px;
}
.Item > .img-container > img{
  border-radius: 2px;
  height: 100%;
  margin: auto;
  display: block;
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
  padding-bottom: 15px;
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
#positionSelector,#teamSelector{
  display: none;
}
.players-container::-webkit-scrollbar {
    width: 5px;
}

.players-container::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.1);
    padding-left: 2px;
    padding-right: 2px;
}

.players-container::-webkit-scrollbar-thumb {
  background-color: #fff;
  border-radius: 5px;
  outline: 1px solid slategrey;
}
</style>
@endsection

@section('body')
<div class="coverContainer">
  <h3 class="mainTitle">Players</h3>
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
      <a class="manageMenuHeader col-md-12 col-sm-12 col-xs-12">Players...</a>
      <a href="/admin/players/add" class="manageMenuItem col-md-12 col-sm-12 col-xs-12">Add</a>
      <a href="/admin/players/add/excel" class="manageMenuItem col-md-12 col-sm-12 col-xs-12">Excel and images</a>
      <a href="/admin/players/edit" class="manageMenuItem item-active col-md-12 col-sm-12 col-xs-12">Edit</a>
      <a href="/admin/players/delete" class="manageMenuItem col-md-12 col-sm-12 col-xs-12">Delete</a>
  </div>
  <div class="col-md-7 col-md-offset-1 no-padding col-xs-12 blackWell">
    <div class="header">
      <h4>Select one for edit</h4>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-12 no-padding">
      <div class="form-group col-xs-12">
        <input type="text" name="playerSearchBox" autocomplete="off" value="" class="col-xs-12 whiteInput" placeholder="Search by team or player name...">
      </div>
      <div class="col-xs-12">
        <div class="players-container col-xs-12 no-padding">

        </div>
      </div>
    </div>
    <div class="col-md-6">
      <form class="" id="" action="/editPlayer" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <input type="hidden" name="playerId" value="">
        <input type="hidden" name="teamId" value="">
        <input type="hidden" name="mainPosition" value="">
        <div class="form-group col-md-12 col-xs-12 no-padding">
          <input type="text" name="name" value="{{old('name')}}" placeholder="name..." class="whiteInput col-md-12 col-xs-12 no-padding">
        </div>
        <div class="form-group col-md-12 col-xs-12 no-padding">
          <input type="text" name="last_name" value="{{old('last_name')}}" placeholder="last name..." class="whiteInput col-md-12 col-xs-12 no-padding">
        </div>
        <div class="form-group col-md-12 col-xs-12 no-padding">
          <input type="text" name="nationality" autocomplete="off" value="{{old('nationality')}}" placeholder="nationality..." class="whiteInput col-md-12 col-xs-12 no-padding">
          <div class="autocomplete-container">

          </div>
        </div>
        <div class="form-group col-md-12 col-xs-12 no-padding">
          <input type="number" name="shirt_number" min="0" max="200" value="{{old('shirt_number')}}" placeholder="shirt number..." class="whiteInput col-md-6 col-xs-12 no-padding">
        </div>
        <div class="form-group col-md-12 col-xs-12 no-padding">
          <div class="file-big-container col-md-12">
            <h4 style="text-align:center;margin-top:88px;">Drag or click for select a <b>photo</b>...</h4>
            <input type="file" name="photo" value="{{old('photo')}}">
          </div>
        </div>
        <div class="form-group col-md-12 col-xs-12 no-padding">
          <input type="checkbox" name="" id="changeTeam" value=""><span style="margin-left: 5px; ;position:absolute; top:2px; font-size:12px; padding-top:0px;"> Change team</span>
        </div>
        <div class="col-md-12 no-padding teams-selection-container" id="teamSelector">
          @if(App\League\Team::count() < 1)
          <h4 style="text-align:center;">No coaches</h4>
          @else
          @foreach(App\League\Team::get() as $i => $team)
          <div class="col-md-12 no-padding Item" id="{{$team->id}}">
            <div class="img-container">
              <img src="{{asset('storage/'.$team->logo)}}" alt="">
            </div>
            <div class="col-md-9">
              <h5>{{$team->name}}</h5>
            </div>
          </div>
          @endforeach
          @endif
        </div>
        <div class="form-group col-md-12 col-xs-12 no-padding">
          <input type="checkbox" name="changePositions" id="changePositions" value=""><span style="margin-left: 5px; ;position:absolute; top:2px; font-size:12px; padding-top:0px;"> Change positions</span>
        </div>
        <div class="col-md-12 col-xs-12 teams-selection-container no-padding" id="positionSelector">
          @foreach(App\League\Position::get() as $position)
          <div class="col-md-12 col-xs-12 Item no-padding" style="cursor:inherit;">
            <div class="col-xs-2">
              <div class="pos-container">
                {{$position->abbreviation}}
              </div>
            </div>
            <div class="col-xs-6">
              <h5>{{$position->name}}</h5>
            </div>
            <i class="col-xs-2 material-icons addPositionBtn" style="color:#888;" id="{{$position->id}}">check</i>
            <i class="col-xs-2 material-icons mainPosition" style="color:#888;" id="{{$position->id}}">star_rate</i>
          </div>
          @endforeach
        </div>
        <div class="form-group col-md-12 col-xs-12 no-padding">
          <button type="submit" name="addTeamBtn" class="btnBlue2 col-md-4 col-md-offset-8 col-sm-12 col-xs-12 no-padding">Edit</button>
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
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC9fuikPcHicK9HnQSzmHM-iZikumk6710&libraries=places&language=en"></script>
<script type="text/javascript">
  var service = new google.maps.places.AutocompleteService();
  var topPos=0;

  $('input[name=nationality]').keyup(function () {
    if(this.value != ''){
      if($('.autocomplete-container').children().css('display') != 'block')
      $('.autocomplete-container').fadeIn(10,function () {
        $('.autocomplete-container').children().toggle(400);
      });
      var input = this;
      service.getQueryPredictions({ input: this.value }, function(predictions, status) {
          if (status == google.maps.places.PlacesServiceStatus.OK) {
            predictions.forEach(function(prediction) {
              $.each(prediction.types,function (i,e) {
                if(e == 'country'){
                  if(!$('div.'+prediction.id)[0]){
                    topPos+=31;
                    var $item = $('<div>');
                    $item.addClass(prediction.id);
                    $item.click(function () {
                      $('input[name=nationality]').val($(this).text());
                      $('.autocomplete-item').toggle(400,function () {
                        $('.autocomplete-container').fadeOut(10);
                        $('.autocomplete-item').remove();
                      });
                    });
                    $item.addClass('autocomplete-item').text(prediction.description).css({
                      height:'31px',
                      width:'100%',
                      top:0,
                      left: 0
                    });
                    $('.autocomplete-container').append($item);
                  }
                }
              });
            });
          }
          else $('.autocomplete-container').children().toggle(400,function () {
            $(this).remove();
            $('.autocomplete-container').fadeOut();
          });
      });
    }
    else {
      $('.autocomplete-container').children().toggle(400,function () {
        $(this).remove();
        $('.autocomplete-container').fadeOut();
      });

    }
  });

  $(function ($) {

      var file = $('.file-big-container').children('input[type=file]')[0].files[0];
      if(file){
        if(file.type.indexOf('image') < 0 || (file.type.indexOf('png') < 0 && file.type.indexOf('jpg') < 0 && file.type.indexOf('jpeg') < 0)){
          showMessages('Ups!','Only png images.','alert-card');
          $('.file-big-container').children('input[type=file]').val('');
          $('.file-big-container').children('h4').text('Drag or click for select a logo...');
        }
        else $('.file-big-container').children('h4').text(file.name);
      }
      else $('.file-big-container').children('h4').text('Drag or click for select a logo...');

    $('#changeTeam').change(function () {
      if($(this).prop('checked')){
        $('#teamSelector').fadeIn('fast');
      }
      else{
        $('#teamSelector').fadeOut('fast');
        $('#teamSelector').children('.Item').css('background-color','#000');
        $('input[id=teamId][type=hidden]').val('');
      }
    });

    $('#changePositions').change(function () {
      if($(this).prop('checked')){
        $('#positionSelector').fadeIn('fast');
      }
      else{
        $('#positionSelector').fadeOut('fast');
        $('#positionSelector').children('.Item').css('background-color','#000');
      }
    });

    $('input[name=playerSearchBox]').keyup(function () {
      if($(this).val() != '' && $(this).val().length > 2){
        $.ajax({
          url:'/searchPlayersByNameOrTeam',
          type:'post',
          dataType:'json',
          data:{
            _token:'{{csrf_token()}}',
            toSearch: $(this).val()
          }
        }).done(function (response) {
          $('div.players-container').children().remove();
          $('input[type=hidden][name=playerId]').val('');
          if(response['players']){
            $.each(response['players'], function (i,player) {
              var $item = $('<div class="item">');
              $item.css({
                padding: '5px 6px 5px 6px',
                'font-size':'12px',
                width: '100%',
                position:'relative',
                float:'left'
              });
              var $imgContainer = $('<div class="col-xs-3 no-padding">');
              $imgContainer.css({
              });
              $item.append($imgContainer);
              $selectBtn=$('<i class="material-icons selectBtn" id="'+player.id+'">');
              $selectBtn.text('check');
              $selectBtn.css({
                position:'absolute',
                bottom:'10px',
                right:'10px',
                cursor:'pointer',
                'z-index':'3'
              });
              $selectBtn.click(function () {
                $('div.item').children('.selectBtn').css('color','white');
                $(this).css('color','dodgerblue');
                $('input[type=hidden][name=playerId]').val($(this).attr('id'));
                $.ajax({
                  url:'/getPlayerPositions',
                  type:'post',
                  dataType:'json',
                  data:{
                    _token:'{{csrf_token()}}',
                    id:$(this).attr('id')
                  }
                }).done(function (response) {
                  $('#positionSelector').children('.Item').children('.addPositionBtn').css('color','#888');
                  $('#positionSelector').children('.Item').children('.mainPosition').css('color','#888');
                  $('input[type=hidden][id=positionsInput]').val('');
                  $('input[type=hidden][name=mainPosition]').val('');
                  $.each(response,function (i,pos) {
                    $('#positionSelector').children('.Item').children('.addPositionBtn#'+pos.id).css('color','#fff');
                    $('form').append($('<input type="hidden" name="positions[]" value='+$(this).attr('id')+' id="positionsInput">'));
                    if(pos.pivot.main){
                      $('#positionSelector').children('.Item').children('.mainPosition#'+pos.id).css('color','#fff');
                      $('input[type=hidden][name=mainPosition]').val($(this).attr('id'));
                    }
                  });
                });
              });
              $item.append($selectBtn);
              $infoContainer=$('<p class="col-xs-9">');
              $infoContainer.html(player.name+" "+player.last_name+decodeURI('<br>')+player.team.name+decodeURI('<br>')+player.nationality+decodeURI('<br>#')+player.shirt_number);
              $item.append($infoContainer);
              var $img = $('<img>');
              $img.css({
                width:'100%',
                'margin-bottom':'6px',
                'border-radius':'3px'
              });
              $img.attr('src','/storage/'+player.photo);
              $imgContainer.append($img);
              /////////////////////////////////
              $('div.players-container').append($item);
            });
          }
        });
      }
      else $('div.players-container').children().remove();
    });

    $('.addPositionBtn').click(function () {
      if($(this).css('color') == 'white' || $(this).css('color') == "#fff" || $(this).css('color') == "rgb(255, 255, 255)"){
          if($('i.mainPosition[id='+$(this).attr('id')+']').css('color') != 'rgb(255, 255, 255)'){
            $(this).css('color','#888');
            $('input[id=positionsInput][value='+$(this).attr('id')+']').remove();
          }
      }
      else{
        $(this).css('color','#fff');
        $('form').append($('<input type="hidden" name="positions[]" value='+$(this).attr('id')+' id="positionsInput">'));
      }
    });

    $('.mainPosition').click(function () {
        $('.mainPosition').css('color','#888');
        $(this).css('color','#fff');
        $('input[type=hidden][name=mainPosition]').val($(this).attr('id'));
        if($('i.addPositionBtn[id='+$(this).attr('id')+']').css('color') != 'rgb(255, 255, 255)'){
          $('i.addPositionBtn[id='+$(this).attr('id')+']').css('color','#fff');
          $('form').append($('<input type="hidden" name="positions[]" value='+$(this).attr('id')+' id="positionsInput" >'));
        }
    });

    function showMessages(title,msg,type) {
      $('.black-transparent-back').fadeIn('slow',function () {
        $('.messageBox').css('margin-top','20%').css('opacity',1);
        $('.messageBox').children('.body').text(msg);
      });
    }

    $('.file-big-container').change(function () {
      var file = $(this).children('input[type=file]')[0].files[0];
      if(file){
        if(file.type.indexOf('image') < 0 || (file.type.indexOf('png') < 0 && file.type.indexOf('jpg') < 0 && file.type.indexOf('jpeg') < 0)){
          showMessages('Ups!','Only png images.','alert-card');
          $(this).children('input[type=file]').val('');
          $(this).children('h4').text('Drag or click for select a logo...');
        }
        else $(this).children('h4').text(file.name);
      }
      else $(this).children('h4').text('Drag or click for select a logo...');
    });

    $('#teamSelector').children('.Item').click(function () {
      $('#teamSelector').children('.Item').css('background','#000');
      $(this).css('background','linear-gradient(to bottom,#222,#111)');
      $('input[name=teamId]').val($(this).attr('id'));
    });

    $('.black-transparent-back').click(function () {
      $('.messageBox').css('margin-top','10%').css('opacity',0);
      $(this).fadeOut(1000);
    });
  });
</script>
@endsection

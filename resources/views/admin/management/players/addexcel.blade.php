@extends('layouts.master')

@section('title')
Use excel
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
#playersContainer{
  height: 200px;
  width: 100%;
  background-color: #fff;
  padding:5px 5px;
  margin-bottom: 20px;
  overflow-y: auto;
}
.playerNoImg{
  padding:5px 10px; 
  background-color: #111; 
  color: #eee;
  margin-bottom: 5px;
}
.playerNoImg:hover{
  cursor: pointer;
  background-color: #222;
}
#indicatorImg{
  font-weight: normal;
}
.green{
  color: #4CAF50;
}
.red{
  color: #F44336;
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
      <a href="/admin/players/add/excel" class="manageMenuItem item-active col-md-12 col-sm-12 col-xs-12">Excel and images</a>
      <a href="/admin/players/edit" class="manageMenuItem col-md-12 col-sm-12 col-xs-12">Edit</a>
      <a href="/admin/players/delete" class="manageMenuItem col-md-12 col-sm-12 col-xs-12">Delete</a>
  </div>
  <div class="col-md-7 col-md-offset-1 no-padding col-xs-12 blackWell">
    <div class="header">
      <h4>Add players</h4>
    </div>
      <div class="col-sm-8 col-xs-12">
        <h3>Upload an excel</h3>
        <hr>
        <form action="/admin/players/add/excel" enctype="multipart/form-data" method="post">
          {{csrf_field()}}
          <div class="form-group">
            <label id="thefile" style="font-size: 15px; color:#111; border-radius: 0px;" class="btn btn-default btn-block">
              <span id="m" style="font-weight: normal;">Select a file <span class="glyphicon glyphicon-folder-open"></span></span>
              <input accept=".xls, .xlsx, .ods" type="file" name="excelFile" style="display: none;">
            </label>
          </div>
          <div class="form-group">
            <button style="font-weight: normal; border-radius: 0px; margin-bottom: 30px;" class="btn btn-success btn-block">UPLOAD</button>
          </div>
        </form>
      </div>
      <div class="col-sm-8 col-xs-12">
        <h4>Players without image</h4>
          <div id="playersContainer">
            @if(App\League\Player::where('photo',null)->count() > 0)
              @foreach(App\League\Player::where('photo',null)->get() as $player)
                <label id="{{$player->id}}" align="center" class="thumbnail playerNoImg"><span class="pull-left"><img width="20px" src="/storage/{{$player->team->logo}}"></span>{{$player->name.' '.$player->last_name}}<span class="pull-right red" id="indicatorImg">No image...</span><input accept=".png, .jpeg, .jpg" type="file" style="display: none;"></label>
              @endforeach
            @else
              <h4 style="color: #111; margin-bottom: 20px;" align="center">There are no players left...</h4>
            @endif
          </div>
      </div>
  </div>
</div>
@endsection

@section('js')
@if(session('msg'))
<script>
$(function () {
  $('.black-transparent-back').fadeIn('slow',function () {
    $('.messageBox').css('margin-top','20%').css('opacity',1);
    $('.messageBox').children('.body').text('{{session("msg")["content"]}}');
  });
});
</script>
@endif
<script>
$(function () {
    $('#thefile').change(function () {
      var file = $(this).children('input[type=file]')[0].files[0];
      if(file){
          $(this).children('#m').text("File: "+file.name);
          $(this).attr('class',"btn btn-primary btn-block");
      }
      else{
        $(this).children('#m').html('Select a file <span class="glyphicon glyphicon-folder-open"></span>');
        $(this).attr('class',"btn btn-default btn-block");
      } 
    });

    $('.playerNoImg').change(function () {
      var file = $(this).children('input[type=file]')[0].files[0];
      if(file){
          var name=file.name.substr(0, 8)+"...";
          var res = ("<span class='glyphicon glyphicon-ok'></span> "+name);
          var ss=$(this);
          var formData = new FormData();
          formData.append('newphoto' ,$(this).children('input[type=file]')[0].files[0]);
          formData.append('_token','{{csrf_token()}}');
          formData.append('playerid', $(this).attr('id'));
          $.ajax({
            url:"/imageplayer",method:"post",
            data:formData,
            processData: false,
            contentType: false,
          }).done(function(response){
                if (response.success) {
                  ss.children('#indicatorImg').html(res).addClass("green")
                  .removeClass("red").delay(3000,function(){
                    ss.slideUp(1000);
                  });
                }else{
                  $('.black-transparent-back').fadeIn('slow',function () {
                    $('.messageBox').css('margin-top','20%').css('opacity',1);
                    $('.messageBox').children('.body').text(response.mess);
                  });
                }
          });
      }
      else{
        $(this).children('#indicatorImg').text("No image...").removeClass("green").addClass("red");
      }
    });

    $('.black-transparent-back').click(function () {
      $('.messageBox').css('margin-top','10%').css('opacity',0);
      $(this).fadeOut(1000);
    });
});
</script>
@endsection

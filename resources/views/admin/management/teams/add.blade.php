@extends('layouts.master')

@section('title')
Add teams
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
    margin: 0;
    top: 180px;
    color: white;
    text-shadow: 0px 0px 2px #000;
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
  background-color: #111;
  margin-top: 15px;
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
}
</style>
@endsection

@section('body')
<div class="coverContainer">
<h3 class="mainTitle">Teams</h3>
</div>
<div class="col-md-12 col-xs-12 col-sm-12" style="margin-top:90px;margin-bottom:40px;">
  <div class="col-md-2 col-md-offset-1 col-sm-2 col-sm-offset-0 col-xs-10 col-xs-offset-1" id="manageMenu">
      <a class="manageMenuHeader col-md-12 col-sm-12 col-xs-12">Teams...</a>
      <a href="/admin/teams/add" class="manageMenuItem item-active col-md-12 col-sm-12 col-xs-12">Add</a>
      <a href="/admin/teams/edit" class="manageMenuItem col-md-12 col-sm-12 col-xs-12">Edit</a>
      <a href="/admin/teams/delete" class="manageMenuItem col-md-12 col-sm-12 col-xs-12">Delete</a>
  </div>
  <div class="col-md-6 col-md-offset-1 col-xs-11 col-xs-offset-1 blackWell">
    <h4 class="header">Team information</h4>
    <div class="form-group col-md-12 no-padding">
      <input type="text" name="teamName" value="" placeholder="name..." class="whiteInput col-md-12 no-padding">
    </div>
    <div class="file-big-container col-md-12">
      <h4 style="text-align:center;margin-top:88px;">Drag or click for select a <b>logo</b>...</h4>
      <input type="file" name="teamPhoto" value="">
    </div>
    <div class="form-group col-md-12 no-padding">
      <label for="teamFoundationDate">Foundation name</label>
      <input type="date" name="teamFoundationDate" value="" class="whiteInput col-md-12">
    </div>
    <div class="form-group col-md-12 no-padding">
      <button type="button" name="addTeamBtn" class="btnBlue2 col-md-12 no-padding">Add</button>
    </div>
  </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
  $(function ($) {
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

    var teamStadiumId, teamCoachId;
    $('#stadiumSelector').children('.Item').click(function () {
      $('#stadiumSelector').children('.Item').css('background-color','#111');
      $(this).css('background-color','#000');
      teamStadiumId = $(this).attr('id');
    });

    $('#coachSelector').children('.Item').click(function () {
      $('#coachSelector').children('.Item').css('background-color','#111');
      $(this).css('background-color','#000');
      teamCoachId = $(this).attr('id');
    });

    $('button[name=addTeamBtn]').click(function () {
      var name = $('input[name=teamName]').val();
      var photo = $('input[type=file][name=teamPhoto]')[0].files[0];
      var date = $('input[type=date][name=teamFoundationDate]').val();
      if(name == '') showMessages('Ups!','Name is obligatory.','alert-card');
      else if (!photo) showMessages('Ups!','You must select a photo.','alert-card');
      else if (date == '') showMessages('Ups!','Invalid date.','alert-card');
      else if(!teamStadiumId) showMessages('Ups!','Select a stadium.','alert-card');
      else if(!teamCoachId) showMessages('Ups!','Select a coach.','alert-card');
      else{
        var formData = new FormData();
        formData.append('name',name);
        formData.append('_token','{{csrf_token()}}');
        formData.append('date',date);
        formData.append('photo',photo);
        formData.append('coachId',teamCoachId);
        formData.append('stadiumId',teamStadiumId);
        $.ajax({
          url:'/addTeam',
          type:'post',
          data:formData,
          contentType:false,
          processData: false,
          dataType:'json'
        }).done(function (response) {
          if(response['result']){
            ///
          }
          else showMessages('Ups!','Has been a error!','error-card');
        });
      }
    });
  });
</script>
@endsection

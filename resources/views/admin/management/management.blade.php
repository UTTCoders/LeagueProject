@extends('layouts.master')

@section('title')
League management
@endsection

@section('css')
<style>
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
        margin-top: 50px;
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
    .module{
        display: none;
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
        border-bottom-left-radius: 3px;
        border-bottom-right-radius: 3px;
        background-color: rgba(0,0,0,.1);
        margin-top: 50px;
        box-shadow: 0px 1px 1px 0px rgba(0,0,0,.2);
        border: 1px solid rgba(0,0,0,.4);
        overflow: hidden;
    }
    .module-active{
        display: initial;
    }
    .no-padding{
      padding: 0px;
    }
    .tabsContainer{
        border-top-left-radius: 4px;
        border-top-right-radius: 4px;
        background: linear-gradient(to bottom,#444,#333);
        box-shadow: 0px 0px 3px 0px #111;
        border-top: 1px solid #666;
        border-left: 1px solid #555;
        border-right: 1px solid #555;
        border-bottom: 1px solid #333;
        overflow: hidden;
    }
    a.tab{
        padding-top: 5px;
        padding-bottom: 5px;
        position: relative;
        font-weight: 400;
        text-align: center;
        -webkit-transition: text-shadow .3s, background-color .2s;
    }
    a.tab:link{
        text-decoration: none;
        color: #ddd;
        text-shadow: 0px 1px 0px #222;
    }
    a.tab:active{
        color: #333;
    }
    a.tab:visited{
        color: white;
        text-shadow: 0px 1px 0px #222;
    }
    a.tab:hover{
        color: white;
        text-shadow: 0px 0px 10px #111;
    }
    a.tab-active{
        color: white;
        box-shadow: inset 0px 0px 3px 0px skyblue;
        background-color: dodgerblue;
        text-shadow: 0px 0px 5px #111;
    }
    div.sub-module{
        display: none;
    }
    div.sub-module-active{
        display: initial;
    }
    .blackInput{
        background-color: #ddd;
        box-shadow: 0px 1px 4px 0px #111;
        border:0;
        font-weight: 400;
        border-radius: 3px;
        padding: 5px 10px 5px 10px;
        color: #555;
        -webkit-transition: color .3s;
    }
    .blackInput:hover{
        color: black;
    }
    .blueBtn{
        background-color: dodgerblue;
        border: 1px solid #003;
        color: white;
        border-radius: 3px;
        padding: 5px;
        padding-left: 10px;
        padding-right: 10px;
        box-shadow: inset 0px 0px 0px 1px skyblue;
        -webkit-transition: text-shadow .3s, background-color .4s;
    }
    .blueBtn:hover{
        background-color: #2FA1FF;
        box-shadow: inset 0px 0px 0px 1px skyblue;
    }
    #file-container{
        background-color: #111;
        border-radius: 3px;
        position: relative;
        border: 1px solid rgba(0,0,0,.4);
        overflow: hidden;
        cursor: pointer;
        padding: 0px;
        box-shadow: 0px 1px 1px 0px rgba(0,0,0,.2);
        -webkit-transition: background-color .4s;
    }
    #file-container:hover{
        background-color: #222;
    }
    #file-container > p{
        position: absolute;
        text-align: center;
        width: 100%;
        font-weight: 400;
        color: #bbb;
        cursor: pointer;
    }
    input[type=file].input-file{
        opacity: 0;
        margin-left: -100%;
        width: 200%;
        height: 120%;
        cursor: pointer;
    }
    #file-info{
      padding: 5px;
    }
    #gmaps-container{
        margin-bottom: 10px;
    }
    #gmaps-container2{
    }
    .gmaps-container{
        height: 300px;
        border-radius: 3px;
        box-shadow: 0px 1px 6px 0px #000;
        overflow: hidden;
    }
    .alert-card{
        background-color: #da2;
        border: 1px solid #640;
        border-radius: 3px;
        color: #640;
    }
    .error-card{
        background-color: #d22;
        border: 1px solid #510;
        border-radius: 3px;
        color: #510;
    }
    .success-card{
        background-color: #2b6;
        border: 1px solid #052;
        border-radius: 3px;
        color: #052;
    }
    #msgs-card{
        z-index: 3;
        position: fixed;
        bottom: -200px;
        box-shadow: 0px 0px 10px 0px #111;
        font-weight: 600;
        -webkit-transition: bottom .5s;
    }
    .dark-block{
        display: none;
        z-index: 4;
        top: 0px;
        left: 0px;
        position: fixed;
        height: 100%;
        width: 100%;
        background-color: rgba(0, 0, 0, .6)
    }
    #gmap{
        height: 100%;
        width: 100%;
    }
    #editingStadiumDiv{
        display: none;
        padding-right: 0;
    }
    #photo-holder{
        margin-bottom: 15px;
    }
    .no-padd-right{
        padding-right: 0;
    }
    #deletingModule{
      padding: 15px;
    }
    .coachCard{
      background-color: #111;
      border-radius: 2px;
      width: 100%;
      height: 100%;
      box-shadow: 0px 0px 3px 0px #000;
    }
    .coachCard > img{
      width: 107%;
    }
    .coachCard > div{
      position: absolute;
      font-size: 12px;
      background: rgba(0,0,0,.2);
      display: inline;
      bottom: -1px;
      overflow: hidden;
      left: 0;
      box-shadow: 0px 0px 2px 0px #000;
      text-shadow: 0px 0px 1px #000;
    }
    .coachCard > .material-icons{
      position: absolute;
      cursor: pointer;
      text-shadow: 0px 0px 2px #000;
    }
    .coachCard > .material-icons:hover{
      color:white;
    }
    .photo-btn{
      top: 8px;
      left: -50px;
      overflow: hidden;
      -webkit-transition: left .4s;
    }
    .edit-btn{
      top: 8px;
      right: -50px;
      -webkit-transition: right .4s;
    }
    .cardParent:hover div div .edit-btn{
      right: 8px;
    }
    .cardParent:hover div div .photo-btn{
      left: 8px;
    }
    .dark-tranparent-back{
      display: none;
      z-index: 4;
      top: 0px;
      left: 0px;
      position: fixed;
      height: 100%;
      width: 100%;
      background-color: rgba(0, 0, 0, .8)
    }
    .dialog-card{
      background-color: #222;
      border-radius: 2px;
      opacity: 0;
      box-shadow: 0px 0px 3px #111;
      overflow: hidden;
      margin-top: 10%;
      -webkit-transition: margin-top .4s, opacity .3s;
    }
    .dialog-card > #header{
      background-color: dodgerblue;
      width: 100%;
      padding: 12px 12px 1px 12px;
      margin: 0;
      margin-bottom: 15px;
      overflow: hidden;
    }
    .dialog-card > #header > h3{
      margin-top: 0;
      padding: 0;
    }
    .dialog-card > .btns-back{
      box-shadow: inset 0px 1px 3px 0px rgba(0,0,0,.5);
      background: rgba(0, 0, 0, 0.3);
      margin: 0;
      margin-left: -5%;
      padding: 15px;
      padding-left: 5%;
      padding-right: 5%;
      width: 110%;
      position: relative;
      float: left;
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
    .btnRed2{
      background: linear-gradient(to bottom, #b13,#823);
      border-radius: 2px;
      border: 0px;
      border-top: 1px solid #b45;
      border-bottom: 1px solid #934;
      padding: 3px 10px 3px 10px;
      -webkit-transition: background .4s;
    }
    .btnRed2:hover{
      background: linear-gradient(to bottom, #c24,#934);
    }
    .close-btn{
      border-radius: 100%;
      background-color: white;
      color:dodgerblue;
      font-weight: 600;
      width: 19px;
      height: 19px;
      padding: 0;
      position: absolute;
      top: 15px;
      right: 15px;
      cursor: pointer;
    }
    .close-btn>p{
      padding: 0;
      text-align: center;
      position: absolute;
      top: -2px;
      left: 6px;
      margin: 0;
    }
    #coachHiddenFile{
      position: absolute;
      top: 0;
      left: 0;
      cursor: pointer;
      opacity: 0;
    }
    .coachCard2{
      position: relative;
      overflow: hidden;
      box-shadow: 0px 0px 2px 0px #000;
      padding: 0;
      margin: 0;
    }
    .coachCard2 > img{
      width: 106%;
    }
    .coachCard2 > div{
      position: absolute;
      font-size: 12px;
      background: rgba(0,0,0,.2);
      display: inline;
      bottom: -1px;
      overflow: hidden;
      left: 0;
      box-shadow: 0px 0px 2px 0px #000;
      text-shadow: 0px 0px 1px #000;
    }
    .coachCard2 > .material-icons{
      position: absolute;
      cursor: pointer;
      text-shadow: 0px 0px 2px #000;
    }
    .coachCard2 > .material-icons:hover{
      color:white;
    }
    .delete-btn{
      top: 8px;
      right: -50px;
      -webkit-transition: right .4s;
    }
    .coachCard2:hover .delete-btn{
      right: 8px;
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
</style>
@endsection

@section('body')
<div class="coverContainer">
    <h2 class="mainTitle">Add teams, stadiums, players, coaches and more</h2>
</div>
<div class="dark-block">
    <div class="col-md-8 col-md-offset-2" id="msgs-card">
        <h4>Title</h4>
        <p>Message</p>
    </div>
</div>
<div class="dark-tranparent-back" id="edit-coach-back">
  <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-12 no-padding dialog-card">
    <div id="header">
      <h3>Edit coach name</h3>
      <div class="close-btn"><p>x</p></div>
    </div>
    <div class="body">
      <div class="form-group col-sm-12 col-sm-12 col-xs-12">
        <input type="text" name="newCoachName" value="" class="myInputWhite col-md-12 col-sm-12 col-xs-12" placeholder="new name...">
      </div>
      <div class="form-group col-sm-12 col-sm-12 col-xs-12">
        <input type="text" name="newCoachLastName" value="" class="myInputWhite col-md-12 col-sm-12 col-xs-12" placeholder="new last name...">
      </div>
    </div>
    <div class="form-group col-md-12" id="messageBox">

    </div>
    <div class="btns-back">
      <div class="col-md-12">
        <button type="button" name="updateCoachNamesBtn" id="" class="btnBlue2 col-md-3 col-md-offset-9 col-sm-4 col-sm-offset-8">Accept</button>
      </div>
    </div>
  </div>
</div>

<div class="dark-tranparent-back" id="delete-coach-back">
  <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-12 no-padding dialog-card">
    <div id="header">
      <h3>Are you sure?</h3>
      <div class="close-btn"><p>x</p></div>
    </div>
    <div class="body">
      <div class="form-group col-sm-12 col-sm-12 col-xs-12">
        <p>The coach will be deleted</p>
      </div>
    </div>
    <div class="btns-back">
      <div class="col-md-12">
        <div class="col-md-4 col-md-offset-4 col-sm-4 col-sm-offset-2" style="padding-right:0;">
          <button type="button" name="deleteCoachBtn" id="" class="btnRed2 col-md-12 col-sm-4">Accept</button>
        </div>
        <div id="cancelContainer" class="col-md-4 col-md-offset-0 col-sm-4 col-sm-offset-0" style="padding-right:0;">
          <button type="button" name="closeDialog" id="" class="btnBlue2 col-md-12 col-sm-4">Cancel</button>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="col-md-12 col-sm-12 no-padding">
    <div class="col-md-7 col-md-offset-1 col-sm-10 col-sm-offset-0">
        <div class="col-md-12  col-sm-12 col-xs-12 no-padding module module-active" id="stadiumsModule">
            <!-- tabs -->
            <div class="tabsContainer no-padding col-md-12 col-xs-12 col-sm-12">
                <a href="#" class="tab tab-active col-md-4 col-sm-4 col-xs-4" id="addingLauncher">Add</a>
                <a href="#" class="tab col-md-4 col-sm-4 col-xs-4" id="editingLauncher">Edit</a>
                <a href="#" class="tab col-md-4 col-sm-4 col-xs-4" id="deletingLauncher">Remove</a>
            </div>
            <!---->
            <!-- adding -->
            <div class="col-md-12 no-padding sub-module sub-module-active" id="addingModule" style="padding: 20px;">
                <h3>New stadium</h3>
                <div class="form-group col-md-7 col-sm-7 no-padding">
                    <input type="text" name="stadium-name" value="" class="blackInput col-md-12 col-sm-12" placeholder="Pick a name...">
                </div>
                <div class="form-group col-md-12 no-padding">
                    <div class="col-md-7 no-padding" id="file-container">
                        <p>Select a photo</p>
                        <input type="file" name="stadium-photo" class="input-file">
                    </div>
                    <div class="col-md-12"></div>
                    <p class="col-md-7" id="file-info">No file selected...</p>
                </div>
                <label for="" class="col-md-7 no-padding">Select the location...</label>
                <div class="col-md-7 no-padding gmaps-container" id="gmaps-container">
                    <div id="gmap">

                    </div>
                </div>
                <div class="form-group col-md-5">
                  <div class="alert-card col-md-11 col-md-offset-1">
                    <h4>Instructions:</h4>
                    <p>1. Make zoom to select accurately the stadium's location.</p>
                    <p>2. Move the marker to the wished point.</p>
                    <p>3. Once you get ready, and you have filled all the information, click add!</p>
                  </div>
                </div>
                <div class="form-group col-md-5 col-sm-5">
                    <button type="button" id="addStadiumBtn" class="btnBlue2 col-md-11 col-sm-8 col-sm-offset-3 col-md-offset-1">Add!</button>
                </div>
            </div>
            <!---->
            <!-- editing -->
            <div class="col-md-12 no-padding sub-module" id="editingModule" style="padding:15px;">
                <div class="col-md-7 no-padding gmaps-container" id="gmaps-container2">

                </div>
                <h3 style="text-align:center;" class="emptyAdvice">Empty</h3>
                <div class="col-md-5" id="editingStadiumDiv">
                    <div class="form-group col-md-12 col-md-offset-0 no-padding">
                        <img id="photo-holder" class="col-md-12 no-padding" src="">
                    </div>
                    <div class="form-group col-md-12 no-padding col-md-offset-0">
                        <input type="text" name="newStadiumName" value="" id="name" placeholder="Name..." class="myInputWhite col-md-12">
                    </div>
                    <div class="form-group col-md-12 no-padding col-md-offset-0">
                        <div class="col-md-12" id="file-container">
                            <p>Select a photo</p>
                            <input type="file" name="newStadiumPhoto" id="newStadiumPhoto" class="input-file">
                        </div>
                        <p class="col-md-12" style="text-align:center;font-size:12px;" id="file-info">No file selected...</p>
                    </div>
                    <div class="form-group col-md-12 no-padding col-md-offset-0">
                        <input type="checkbox" name="changeLocation" id="changeStadiumLocation" value=""><span style="margin-left: 5px; ;position:absolute; top:2px; font-size:12px; padding-top:0px;"> Change location</span>
                    </div>
                    <div class="form-group col-md-12 no-padding col-md-offset-0">
                        <button type="button" class="btnBlue2 col-md-12" id="editStadiumBtn" name="editStadiumBtn">Accept</button>
                    </div>
                </div>

            </div>
            <!---->
            <!-- deleting -->
            <div class="col-md-12 no-padding sub-module" id="deletingModule">
                <div class="col-md-7 no-padding gmaps-container" id="gmaps-container3">

                </div>
                <h3 class="emptyAdvice" style="text-align:center;">Empty</h3>
                <div class="col-md-5 no-padd-right" id="deletingStadiumDiv" style="display:none;">
                    <div class="form-group col-md-12 no-padding">
                      <img src="" class="col-md-12 no-padding" alt="" />
                    </div>
                    <h4 class="" id="stadium-name"></h4>
                    <div class="form-group col-md-12 no-padding">
                        <button type="button" name="button" class="col-md-12 no-padding btnRed2" id="deleteStadiumBtn">Delete</button>
                    </div>
                </div>
            </div>
            <!---->
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12 no-padding module" id="coachesModule">
            <div class="tabsContainer no-padding col-md-12 col-sm-12 col-xs-12">
                <a href="#" class="tab tab-active col-md-4 col-sm-4 col-xs-4" id="addingLauncher">Add</a>
                <a href="#" class="tab col-md-4 col-sm-4 col-xs-4" id="editingLauncher">Edit</a>
                <a href="#" class="tab col-md-4 col-sm-4 col-xs-4" id="deletingLauncher">Remove</a>
            </div>
            <div class="col-md-12 col-xs-12 col-sm-12 no-padding sub-module sub-module-active" id="addingModule">
                <div class="col-md-12" style="padding-top:15px;padding-bottom:15px;">
                    <h4 class="col-md-12">Coach information</h4>
                    <div class="form-group col-md-12">
                        <input type="text" name="coachName" id="coachName" value="" placeholder="Name..." class="myInputWhite col-md-6">
                    </div>
                    <div class="form-group col-md-12">
                        <input type="text" name="coachLastName" id="coachLastName" value="" placeholder="Last name..." class="myInputWhite col-md-6">
                    </div>
                    <div class="form-group col-md-6 no-padd-right col-md-offset-0">
                        <div class="col-md-12" id="file-container">
                            <p>Select a photo</p>
                            <input type="file" name="coachPhoto" id="coachPhoto" class="input-file">
                        </div>
                        <p class="col-md-12" style="text-align:center;font-size:12px;" id="file-info">No file selected...</p>
                    </div>
                    <div class="form-group col-md-12">
                        <button type="button" name="addCoachBtn" class="btnBlue2 col-md-6" id="addCoachBtn">Accept</button>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-xs-12 col-sm-12 no-padding sub-module" id="editingModule">
                @if(App\League\Coach::get()->count() < 1)
                  <h3 style="text-align: center;">Empty</h3>
                @else
                  @foreach(App\League\Coach::get() as $i => $coach)
                    <div class="col-md-3 col-xs-12 col-sm-4 cardParent" name="{{$coach->id}}" style="padding:15px; ;overflow: hidden;">
                      <div class="col-md-12 col-sm-12 col-xs-12 no-padding" style="height:100%;overflow: hidden;box-shadow: 0px 0px 3px 0px #000;">
                        <div class="coachCard col-md-12 col-sm-12 col-xs-12 no-padding" id="{{$coach->id}}">
                            <img src="{{asset('storage/'.$coach->photo)}}" alt="" width="120%" class=""/ name="{{$coach->id}}">
                            <i class="material-icons photo-btn" id="{{$coach->id}}">photo_camera<input class="file" id="coachHiddenFile" type="file"></input></i>
                            <i class="material-icons edit-btn" id="{{$coach->id}}">mode_edit</i>
                            <div class="col-md-12 col-xs-12 col-sm-12">
                              <h5>{{$coach->name." ".$coach->last_name}}</h5>
                              @if($coach->team)
                              <p id="team">{{$coach->team->name}}</p>
                              @else
                              <p id="team">No team</p>
                              @endif
                            </div>
                        </div>
                      </div>
                    </div>
                  @endforeach
                @endif
            </div>
            <div class="col-md-12 col-xs-12 no-padding sub-module" id="deletingModule">
              @if(App\League\Coach::get()->count() < 1)
                <h3 style="text-align: center;">Empty</h3>
              @else
                @foreach(App\League\Coach::get() as $i => $coach)
                    <div class="coachCard2 col-md-3 col-sm-4 col-xs-6" name="{{$coach->id}}" id="">
                        <img src="{{asset('storage/'.$coach->photo)}}" alt="" class="col-md-12 no-padding" name="{{$coach->id}}"/>
                        <i class="material-icons delete-btn" id="{{$coach->id}}">delete</i>
                        <div class="col-md-12 col-xs-12 col-sm-12">
                          <h5>{{$coach->name." ".$coach->last_name}}</h5>
                          @if($coach->team)
                          <p id="team">{{$coach->team->name}}</p>
                          @else
                          <p id="team">No team</p>
                          @endif
                        </div>
                    </div>
                @endforeach
              @endif
            </div>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12 no-padding module" id="teamsModule">
            <div class="tabsContainer no-padding col-md-12 col-sm-12 col-xs-12">
                <a href="#" class="tab tab-active col-md-4 col-sm-4 col-xs-4" id="addingLauncher">Add</a>
                <a href="#" class="tab col-md-4 col-sm-4 col-xs-4" id="editingLauncher">Edit</a>
                <a href="#" class="tab col-md-4 col-sm-4 col-xs-4" id="deletingLauncher">Remove</a>
            </div>
            <div class="sub-module sub-module-active" id="addingModule">
              <div class="col-md-6">
                <h4>Team information</h4>
                <div class="form-group col-md-12 no-padding">
                  <input type="text" name="teamName" value="" placeholder="name..." class="blackInput col-md-12 no-padding">
                </div>
                <div class="file-big-container col-md-12">
                  <h4 style="text-align:center;margin-top:88px;">Drag or click for select a <b>logo</b>...</h4>
                  <input type="file" name="teamPhoto" value="">
                </div>
                <div class="form-group col-md-12 no-padding">
                  <label for="teamFoundationDate">Foundation name</label>
                  <input type="date" name="teamFoundationDate" value="" class="blackInput col-md-12">
                </div>
                <div class="form-group col-md-12 no-padding">
                  <button type="button" name="addTeamBtn" class="btnBlue2 col-md-12 no-padding">Add</button>
                </div>
              </div>
              <div class="col-md-6">
                <div class="col-md-12 no-padding teams-selection-container" id="stadiumSelector">
                  @foreach(App\League\Stadium::get() as $i => $stadium)
                  @if(!$stadium->team)
                  <div class="col-md-12 no-padding Item" id="{{$stadium->id}}">
                    <img src="{{asset('storage/'.$stadium->photo)}}" alt="" class="col-md-4">
                    <div class="col-md-8">
                      <h5>{{$stadium->name}}</h5>
                    </div>
                  </div>
                  @endif
                  @endforeach
                </div>
                <div class="col-md-12 no-padding teams-selection-container" id="coachSelector">
                  @foreach(App\League\Coach::get() as $i => $coach)
                  @if(!$coach->team)
                  <div class="col-md-12 no-padding Item" id="{{$coach->id}}">
                    <img src="{{asset('storage/'.$coach->photo)}}" alt="" class="col-md-3">
                    <div class="col-md-9">
                      <h5>{{$coach->name}}</h5>
                    </div>
                  </div>
                  @endif
                  @endforeach
                </div>
              </div>
            </div>
            <div class="sub-module" id="editingModule">
              <div class="col-md-6" id="teamsToEditContainer">

              </div>
              <div class="col-md-6">

              </div>
            </div>
            <div class="sub-module" id="deletingModule">

            </div>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12 no-padding module" id="playersModule">
            <div class="tabsContainer no-padding col-md-12 col-sm-12 col-xs-12">
                <a href="#" class="tab tab-active col-md-4 col-sm-4 col-xs-4" id="addingLauncher">Add</a>
                <a href="#" class="tab col-md-4 col-sm-4 col-xs-4" id="editingLauncher">Edit</a>
                <a href="#" class="tab col-md-4 col-sm-4 col-xs-4" id="deletingLauncher">Remove</a>
            </div>
            <p>
              Players
            </p>
        </div>
    </div>
    <div class="col-md-2 col-md-offset-1 col-sm-2 col-sm-offset-0 col-xs-10 col-xs-offset-1" id="manageMenu">
        <a class="manageMenuHeader col-md-12 col-sm-12 col-xs-12">Manage...</a>
        <a href="#" id="stadiumsLauncher" class="manageMenuItem item-active col-md-12 col-sm-12 col-xs-12">Stadiums</a>
        <a href="#" id="coachesLauncher" class="manageMenuItem col-md-12 col-sm-12 col-xs-12">Coaches</a>
    </div>
</div>
@endsection

@section('js')
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC9fuikPcHicK9HnQSzmHM-iZikumk6710&callback=initMap"></script>
<script type="text/javascript">
    var marker, map, myLatLng, stadiumsMarkers = [];
    var mapDiv = $('.gmaps-container > #gmap')[0];
    function initMap() {
        myLatLng = {lat: 40.416786, lng: -3.703788};
        map = new google.maps.Map(mapDiv, {
            zoom: 5,
            center: myLatLng,
            mapTypeControl: false,
            scaleControl:false,
            streetViewControl: false
        });

        marker = new google.maps.Marker({
            position: myLatLng,
            animation: google.maps.Animation.DROP,
            map: map,
            title: 'Move me to a point!',
            draggable: true
        });

        map.addListener('click', function (e) {
            marker.setPosition(e.latLng);
        });
    }

    $(function($){
        $('.coachCard2').height(($('.module').width()-30)*($('.coachCard2').width()/100));
        $.each($('.cardParent'),function (i,e) {
          $(e).height(($('.module').width())*($(e).width()/100)-30);
        });
        $(window).resize(function () {
            $('.cardParent').height($('.cardParent').width());
            $('.coachCard2').height($('.coachCard2').width());
        });
        $.ajax({
            url: '/getStadiums',
            type:'post',
            dataType:'json',
            data: {
                _token: '{{csrf_token()}}'
            }
        }).done(function(response){
            $.each(response ,function (i, e) {
                if($('.emptyAdvice').css('display') != 'none'){
                  $('.emptyAdvice').fadeOut();
                }
                var stadiumLocation = JSON.parse(e['location']);
                stadiumLocation.lat = parseFloat(stadiumLocation.lat);
                stadiumLocation.lng = parseFloat(stadiumLocation.lng);
                var mker = new google.maps.Marker({
                    position: stadiumLocation,
                    map: map,
                    icon: {
                        url: "img/icons/ic_place_black_24dp_1x.png"
                    },
                    title: e['name']
                });
                stadiumsMarkers.push(mker);
            });
        });
        $('.dark-block').click(function () {
            var parent = $(this);
            var children = parent.children('#msgs-card');
            children.removeClass(alertClass);
            children.css('bottom','-200px');
            children.fadeOut(200,function () {
                parent.fadeOut('fast',function () {
                    parent.css('display','none');
                });
            });
        });

        var alertClass = "";
        $('#addStadiumBtn').click(function () {
            $.ajax({
                url:'https://maps.googleapis.com/maps/api/geocode/json?latlng='+marker.getPosition().lat()+','+marker.getPosition().lng()+'&key=AIzaSyC9fuikPcHicK9HnQSzmHM-iZikumk6710',
                type:'post',
                dataType:'json'
            }).done(function (response) {
                if(response.status == 'OK'){
                    var arr = $.grep(response.results, function (obj) {
                        return ($.inArray('country',obj.types) != -1);
                    });
                    if(arr[0].formatted_address == 'España' || arr[0].formatted_address == 'Spain'){
                        if(map.zoom < 15){
                            showMessages('Stop just there!','You need to aument the zoom for select accurately!','alert-card');
                        }
                        else if(!$('input[type=file][class=input-file]')[0].files[0]){
                            showMessages('Stop just there!','You must to select a photo!','alert-card');
                        }
                        else if($('input[name=stadium-name]').val() == "") showMessages('Stop just there!','The stadium must have a name!','alert-card');
                        else {
                            var formData = new FormData();
                            formData.append('photo' ,$('input[type=file][class=input-file]')[0].files[0]);
                            formData.append('lat', String(marker.getPosition().lat()));
                            formData.append('lng', String(marker.getPosition().lng()));
                            formData.append('_token','{{csrf_token()}}');
                            formData.append('name', $('input[name=stadium-name]').val());
                            $.ajax({
                                url:'/addStadium',
                                type: 'post',
                                dataType:'json',
                                data: formData,
                                processData: false,  // tell jQuery not to process the data
                                contentType: false,  // tell jQuery not to set contentType

                            }).done(function (response) {
                                if(response['stadium']){
                                    var stadiumLocation=JSON.parse(response['stadium']['location']);
                                    stadiumLocation.lat = parseFloat(stadiumLocation.lat);
                                    stadiumLocation.lng = parseFloat(stadiumLocation.lng);
                                    console.log(stadiumLocation);
                                    marker.setPosition({lat: 40.416786, lng: -3.703788});
                                    map.setZoom(6);
                                    var mker = new google.maps.Marker({
                                        title: response['stadium']['name'],
                                        position: stadiumLocation,
                                        icon: "img/icons/ic_place_black_24dp_1x.png",
                                        map: map,
                                        animation: google.maps.Animation.DROP
                                    });
                                    stadiumsMarkers.push(mker);
                                    if($('.emptyAdvice').css('display') != 'none'){
                                      $('.emptyAdvice').fadeOut('fast');
                                    }
                                }
                                showMessages(response['msgs']['title'], response['msgs']['content'][0], response['msgs']['type']);
                            });
                        }
                    }
                    else showMessages('Ups!',['The stadiums must be only from Spain.'],'error-card');
                }
                else{
                    showMessages('Ups!',['Has been an error! Select a valid point.'],'error-card');
                }
            });

        });

        function showMessages(title, msg, type){
            var parent = $('.dark-block');
            var children = parent.children('#msgs-card');
            alertClass = type;
            children.addClass(type);
            children.children('h4').text(title);
            children.children('p').text(msg);
            children.css('bottom','0px');
            children.fadeIn(200,function () {
                parent.fadeIn('fast',function () {
                    parent.css('display','initial');
                });
            });
        }

        $('input[type=file][class=input-file]').change(function () {
            var file = this.files[0];
            if(file){
                $(this).parent().parent().children('#file-info').text("1 selected ("+file.name+").");
            }
            else{
                $(this).parent().parent().children('#file-info').text("No file selected.");
            }
        });

        $.each($('.manageMenuItem'), function (index, element) {
            $(element).click(function () {
                if(!$(this).hasClass('item-active')){
                    $('.coachCard2').height(($('.module').width()-30)*($('.coachCard2').width()/100));
                    $.each($('.cardParent'),function (i,e) {
                      $(e).height(($('.module').width())*($(e).width()/100)-30);
                    });
                    $.each($('.manageMenuItem'),function (i,elem) {
                        $(elem).removeClass('item-active');
                    });
                    $.each($('.module'),function (i,elem) {
                        $(elem).fadeOut(0, function () {
                            $(elem).removeClass('module-active');
                        });
                    });
                    $(this).addClass('item-active');
                    var module = $('#'+$(this).attr('id').replace('Launcher','Module'));
                    module.fadeIn("slow",function(){
                        module.addClass('module-active');
                    });
                }
            });
        });

        var stadiumToEdit, stadiumToDelete, clickedMarker;
        $.each($('.tab'), function (index, element) {
            $(element).click(function () {
                if(!$(element).hasClass('tab-active')){
                    $('.coachCard2').height(($('.module').width()-30)*($('.coachCard2').width()/100));
                    $.each($('.cardParent'),function (i,e) {
                      $(e).height(($('.module').width())*($(e).width()/100)-30);
                    });
                    $.each($(element).parent().children('.tab'),function (i,elem) {
                        $(elem).removeClass('tab-active');
                    });
                    $.each($(element).parent().parent().children('.sub-module'),function (i,elem) {
                        $(elem).fadeOut(0, function () {
                            $(elem).removeClass('sub-module-active');
                        });
                    });
                    $(this).addClass('tab-active');
                    var subMod = $(element).parent().parent().children('#'+$(this).attr('id').replace('Launcher','Module'));
                    subMod.children('.gmaps-container').append(mapDiv);
                    if(subMod.parent().attr('id') == 'stadiumsModule'){
                        if(subMod.attr('id').toLowerCase().indexOf('editing') > -1){
                            marker.setVisible(true);
                            $.each(stadiumsMarkers, function (i, elem) {
                                google.maps.event.clearListeners(elem, 'click');
                            });
                            if($('#editingStadiumDiv').css('display') == 'none'){
                                marker.setVisible(false);
                            }
                            $.each(stadiumsMarkers, function (i, elem) {
                                elem.addListener('click', function () {
                                    if($('#editingStadiumDiv').css('display') == 'none'){
                                        $('#editingStadiumDiv').fadeIn('fast');
                                    }
                                    $.ajax({
                                        url:'/getStadium',
                                        dataType:'json',
                                        type:'post',
                                        data:{
                                            _token: '{{csrf_token()}}',
                                            location: elem.position.toJSON()
                                        }
                                    }).done(function (response) {
                                        if(response['stadium']){
                                            stadiumToEdit = response['stadium'];
                                            stadiumToEdit.location = JSON.parse(stadiumToEdit.location);
                                            stadiumToEdit.location.lat = parseFloat(stadiumToEdit.location.lat);
                                            stadiumToEdit.location.lng = parseFloat(stadiumToEdit.location.lng);
                                            $('#editingStadiumDiv').attr('name',response['stadium'].id);
                                            $('#editingStadiumDiv').children('div').children('img').attr('src','storage/'+response['stadium'].photo);
                                            $('#editingStadiumDiv').children('div').children('input[type=text][id=name]').first().val(response['stadium'].name);
                                            marker.setVisible(true);
                                        }
                                        else showMessages('Ups!',['Have been an error! Try again.'],'error-card');
                                    });
                                });
                            });
                        }
                        else if(subMod.attr('id').toLowerCase().indexOf('deleting') > -1){
                            marker.setVisible(false);
                            $.each(stadiumsMarkers, function (i, elem) {
                                google.maps.event.clearListeners(elem, 'click');
                                elem.addListener('click', function () {
                                    $.ajax({
                                        url:'/getStadium',
                                        type:'post',
                                        dataType:'json',
                                        data: {
                                            _token: '{{csrf_token()}}',
                                            location: elem.position.toJSON()
                                        }
                                    }).done(function (response) {
                                        if(response['stadium']){
                                            $('#deletingStadiumDiv').fadeIn('fast');
                                            clickedMarker = elem;
                                            stadiumToDelete = response['stadium'];
                                            stadiumToDelete.location = JSON.parse(stadiumToDelete.location);
                                            stadiumToDelete.location.lat = parseFloat(stadiumToDelete.location.lat);
                                            stadiumToDelete.location.lng = parseFloat(stadiumToDelete.location.lng);
                                            //$('#editingStadiumDiv').attr('name',response['stadium'].id);
                                            $('#deletingStadiumDiv').children('div').children('img').attr('src','storage/'+response['stadium'].photo);
                                            $('#deletingStadiumDiv').children('h4').first().text(response['stadium'].name);
                                        }
                                        else showMessages('Ups!',['Have been an error! Try again.'],'error-card');
                                    });
                                });
                            });
                        }
                        else{
                            marker.setVisible(true);
                            $.each(stadiumsMarkers, function (i, elem) {
                                google.maps.event.clearListeners(elem, 'click');
                            });
                        }
                    }
                    subMod.fadeIn("slow", function () {
                        subMod.addClass('sub-module-active');
                    });
                }
            });
        });

        $('button#editStadiumBtn').click(function () {
          $.ajax({
              url:'https://maps.googleapis.com/maps/api/geocode/json?latlng='+marker.getPosition().lat()+','+marker.getPosition().lng()+'&key=AIzaSyC9fuikPcHicK9HnQSzmHM-iZikumk6710',
              type:'post',
              dataType:'json'
          }).done(function (response) {
              if(response.status == 'OK'){
                  var arr = $.grep(response.results, function (obj) {
                      return ($.inArray('country',obj.types) != -1);
                  });
                  if(arr[0].formatted_address == 'España' || arr[0].formatted_address == 'Spain'){
                      if($('#changeStadiumLocation').prop('checked') && map.zoom < 15){
                          showMessages('Stop just there!','You need to aument the zoom for select accurately!','alert-card');
                      }
                      else {
                          var id = $('#editingStadiumDiv').attr('name');
                          var stadiumPos = marker.getPosition().toJSON();
                          stadiumPos.lat = String(stadiumPos.lat);
                          stadiumPos.lng = String(stadiumPos.lng);
                          var formData = new FormData();
                          formData.append('photo' ,$('input[type=file][class=input-file][id=newStadiumPhoto]')[0].files[0]);
                          formData.append('location', JSON.stringify(stadiumPos));
                          formData.append('changeLocation',$('#changeStadiumLocation').prop('checked'));
                          formData.append('_token','{{csrf_token()}}');
                          formData.append('id', id);
                          formData.append('name', $('input[name=newStadiumName]').val());

                          $.ajax({
                              url:'/updateStadium',
                              type: 'post',
                              dataType:'json',
                              data: formData,
                              processData: false,  // tell jQuery not to process the data
                              contentType: false,  // tell jQuery not to set contentType

                          }).done(function (response) {
                              //fix. add stadium to map and show messages
                              console.log(response['lastStadiumName']);
                              if(response['stadium']){
                                  if($('#changeStadiumLocation').prop('checked') && stadiumToEdit){
                                      var newStadiumLocation = JSON.parse(response['stadium'].location);
                                      newStadiumLocation.lat = parseFloat(newStadiumLocation.lat);
                                      newStadiumLocation.lng = parseFloat(newStadiumLocation.lng);
                                      $.each(stadiumsMarkers, function (i, mrk) {
                                          if(mrk.getPosition().toJSON().lat ==  stadiumToEdit.location.lat){
                                              mrk.setPosition(newStadiumLocation);
                                              mrk.title = response['stadium'].name;
                                          }
                                      });
                                  }
                                  marker.setPosition({lat: 40.416786, lng: -3.703788});
                                  map.setZoom(6);
                                  $('#editingStadiumDiv').children('div').children('img').attr('src','storage/'+response['stadium'].photo);
                                  $('#editingStadiumDiv').children('div').children('input[type=text][id=name]').first().val(response['stadium'].name);
                                  $('#changeStadiumLocation').prop('checked',false);
                              }
                              else{
                                if(response['lastStadiumName']){
                                  $('input[name=newStadiumName]').val(response['lastStadiumName']);
                                }
                              }
                              showMessages(response['msgs']['title'], response['msgs']['content'][0], response['msgs']['type']);
                          });
                      }
                  }
                  else showMessages('Ups!',['The stadiums must be only from Spain.'],'error-card');
              }
              else showMessages('Ups!',['There has been an error! Select a valid point.'],'error-card');
          });
        });

        $('#deleteStadiumBtn').click(function () {
            if(stadiumToDelete && clickedMarker){
                $.ajax({
                  url:'/deleteStadium',
                  type:'post',
                  data:{
                    _token:'{{csrf_token()}}',
                    id: stadiumToDelete.id
                  }
                }).done(function (response) {
                  $('#deletingStadiumDiv').fadeOut('fast');
                  clickedMarker.setMap(null);
                  stadiumsMarkers = $.grep(stadiumsMarkers, function (mrk) {
                      return (mrk != clickedMarker);
                  });
                  clickedMarker = null;
                  showMessages('OK!',['Stadium successfully delete.'],'success-card');
                  console.log(stadiumsMarkers.length);
                  if(stadiumsMarkers.length < 1){
                    $('.emptyAdvice').fadeIn('fast');
                  }
                  $('#editingStadiumDiv').fadeOut();
                });
            }
            else showMessages('Ups!',['Have been an error! Try again.'],'error-card');
        });

        $('#addCoachBtn').click(function () {
            var nameInput = $('#coachName').first();
            var lastNameInput = $('#coachLastName').first();
            var photoInput = $('#coachPhoto')[0];
            if(nameInput.val() == '') showMessages('Stop just there!','You must to write a name!','alert-card');
            else if (lastNameInput.val() == '') showMessages('Stop just there!','You must to write a last name!','alert-card');
            else if(!photoInput.files[0]) showMessages('Stop just there!','You must to select a photo!','alert-card');
            else{
              var formData = new FormData();
              formData.append('name',nameInput.val());
              formData.append('lastName',lastNameInput.val());
              formData.append('_token','{{csrf_token()}}');
              formData.append('photo',photoInput.files[0]);
              $.ajax({
                url:'/addCoach',
                dataType:'json',
                type:'post',
                data:formData,
                processData: false,
                contentType: false

              }).done(function (response) {
                  if(response['coach']){
                    var team = "";
                    if(response['coachTeam']){
                      team = response['coachTeam'].name;
                    }
                    $('#coachesModule').children('#editingModule').append('<div class="col-md-3 col-xs-12 col-sm-4 cardParent" name="'+response['coach'].id+'" style="padding:15px; ;overflow: hidden;"><div class="col-md-12 col-sm-12 col-xs-12 no-padding" style="height:100%;overflow: hidden;box-shadow: 0px 0px 3px 0px #000;"><div class="coachCard col-md-12 col-sm-12 col-xs-12 no-padding" id="'+response['coach'].id+'"><img src="storage/'+response['coach'].photo+'" alt="" width="120%" class=""/><i class="material-icons photo-btn" id="'+response['coach'].id+'">photo_camera<input class="file" id="coachHiddenFile" type="file"></input></i><i class="material-icons edit-btn" id="'+response['coach'].id+'">mode_edit</i><div class="col-md-12 col-xs-12 col-sm-12"><h5>'+response['coach'].name+" "+response["coach"].last_name+'</h5><p id="team">'+team+'</p></div></div></div></div>');
                    $('#coachesModule').children('#deletingModule').append('<div class="coachCard2 col-md-3 col-sm-4 col-xs-6" name="" id=""><img src="storage/'+response['coach'].photo+'" alt="" class="col-md-12 no-padding"/><i class="material-icons delete-btn" id="'+response['coach'].id+'">delete</i><div class="col-md-12 col-xs-12 col-sm-12"><h5>'+response['coach'].name+' '+response['coach'].last_name+'</h5><p id="team">'+team+'</p></div></div>');
                    $('.edit-btn').unbind('click');
                    $.each($('.edit-btn'),function (index,element) {
                      $(element).click(function () {
                        $('.dark-tranparent-back').fadeIn('fast',function () {
                          $('.dialog-card').css('opacity',1).css('margin-top','20%');
                        });
                        $('button[name=updateCoachNamesBtn]').attr('id',$(this).attr('id'));
                      });
                    });
                    $('.photo-btn').unbind('click');
                    setPhotoEvent();
                  }
                  showMessages(response['msgs']['title'], response['msgs']['content'], response['msgs']['type']);
              });
            }
        });

        function setPhotoEvent() {
          $.each($('.photo-btn'),function (i, e) {
            $(e).click(function () {
              $(this).children('input[type=file]').change(function () {
                if(this.files[0]){
                  var id = $(e).attr('id');
                  var formData = new FormData();
                  formData.append('photo', this.files[0]);
                  formData.append('_token','{{csrf_token()}}');
                  formData.append('id',id);
                  $.ajax({
                    url:'/updateCoachPhoto',
                    type:'post',
                    dataType: 'json',
                    data:formData,
                    processData:false,
                    contentType:false
                  }).done(function (response) {
                    if(response['photo']){
                      $('img[name='+id+']').attr('src','storage/'+response['photo']);
                    }
                  });
                }
              });
            });
          });
        }

        setPhotoEvent();

        $.each($('.edit-btn'),function (i, e) {
          $(e).click(function () {
            $('#edit-coach-back').fadeIn('fast',function () {
              $('#edit-coach-back').children('.dialog-card').css('opacity',1).css('margin-top','20%');
            });
            $('button[name=updateCoachNamesBtn]').attr('id',$(this).attr('id'));
          });
        });

        $.each($('.delete-btn'),function (i, e) {
          $(e).click(function () {
            $('#delete-coach-back').fadeIn('fast',function () {
              $('#delete-coach-back').children('.dialog-card').css('opacity',1).css('margin-top','20%');
            });
            $('button[name=deleteCoachBtn]').attr('id',$(this).attr('id'));
          });
        });

        $('.dialog-card').children('#header').children('.close-btn').click(function () {
          $('.dialog-card').css('opacity',0).css('margin-top','10%');
          $('.dark-tranparent-back').fadeOut('fast');
          $('input[name=newCoachName]').val('');
          $('input[name=newCoachLastName]').val('');
          $.each($('.dialog-card').children('#messageBox').children(), function (i,e) {
            $(e).remove();
          });
        });

        $('.dialog-card').children('div.btns-back').children('div').children('div#cancelContainer').children('button').click(function () {
          $('.dialog-card').css('opacity',0).css('margin-top','10%');
          $('.dark-tranparent-back').fadeOut('fast');
        });

        $('.dark-tranparent-back').click(function (e) {
          if(e.target === this){
            $('.dialog-card').css('opacity',0).css('margin-top','10%');
            $(this).fadeOut('fast');
            $.each($('.dialog-card').children('#messageBox').children(), function (i,e) {
              $(e).remove();
            });
          }
        });

        $('button[name=updateCoachNamesBtn]').click(function () {
          if($('input[name=newCoachName]').val() == ''){
            $.each($('.dialog-card').children('#messageBox').children(), function (i,e) {
              $(e).remove();
            });
            $('.dialog-card').children('#messageBox').append('<p>Please write a name.</p>');
          }
          else if($('input[name=newCoachLastName]').val() == ''){
            $.each($('.dialog-card').children('#messageBox').children(), function (i,e) {
              $(e).remove();
            });
            $('.dialog-card').children('#messageBox').append('<p>Please write a last name...</p>');
          }
          else if($('button[name=updateCoachNamesBtn]').attr('id') == ''){
            $.each($('.dialog-card').children('#messageBox').children(), function (i,e) {
              $(e).remove();
            });
            $('.dialog-card').children('#messageBox').append('<p>Has been a error.</p>');
          }
          else{
            $.ajax({
              url:'/updateCoachNames',
              type:'post',
              dataType:'json',
              data:{
                _token:'{{csrf_token()}}',
                id:$(this).attr('id'),
                name:$('input[name=newCoachName]').val(),
                last_name:$('input[name=newCoachLastName]').val()
              }
            }).done(function (response) {
              $.each($('.dialog-card').children('#messageBox').children(), function (i,e) {
                $(e).remove();
              });
              $('.dialog-card').children('#messageBox').append('<p>'+response['msg']+'</p>');
              if(response['coach']){
                $('div[id='+response['coach'].id+']').children('div').children('h5').text(response['coach'].name +" "+ response['coach'].last_name);
              }
            });
          }
        });

        $('button[name=deleteCoachBtn]').click(function () {
          var id = $(this).attr('id');
          $.ajax({
            url:'/deleteCoach',
            dataType:'json',
            type:'post',
            data:{
              _token: '{{csrf_token()}}',
              id: id
            }
          }).done(function (response) {
              $('.dialog-card').css('opacity',0).css('margin-top','10%');
              $('.dark-tranparent-back').fadeOut('fast');
              showMessages(response['title'],response['content'],response['type']);
              $('div[name='+id+']').fadeOut('fast',function () {
                $(this).remove();
              });
          });
        });


    });
</script>
@endsection

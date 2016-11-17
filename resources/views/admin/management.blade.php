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
        background-color: #222;
        box-shadow: 0px 1px 1px 0px rgba(0,0,0,.2);
        border: 1px solid rgba(0,0,0,.4);
        border-radius: 3px;
        padding: 5px 10px 5px 10px;
        color: #ddd;
        -webkit-transition: color .3s;
    }
    .blackInput:hover{
        color: white;
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
        background-color: red;
        margin-left: -100%;
        width: 200%;
        height: 120%;
        cursor: pointer;
    }
    #file-info{
      padding: 5px;
    }
</style>
@endsection

@section('body')
<div class="coverContainer">
    <h2 class="mainTitle">Add teams, stadiums, players, coaches and more</h2>
</div>
<div class="col-md-12 no-padding">
    <div class="col-md-7 col-md-offset-1">
        <div class="col-md-12 no-padding module module-active" id="stadiumsModule">
            <div class="tabsContainer no-padding col-md-12">
                <a href="#" class="tab tab-active col-md-4" id="addingLauncher">Add</a>
                <a href="#" class="tab col-md-4" id="editingLauncher">Edit</a>
                <a href="#" class="tab col-md-4" id="deletingLauncher">Remove</a>
            </div>
            <div class="col-md-12 no-padding sub-module sub-module-active" id="addingModule" style="padding: 20px;">
                <h3>New stadium</h3>
                <div class="form-group col-md-12 no-padding">
                    <input type="text" name="name" value="" class="blackInput col-md-6" placeholder="Pick a name...">
                </div>
                <div class="form-group col-md-12 no-padding">
                    <input type="location" name="name" value="" class="blackInput col-md-6" placeholder="Write the location...">
                </div>
                <div class="form-group col-md-12 no-padding">
                    <div class="col-md-3 no-padding" id="file-container">
                        <p>Select a photo</p>
                        <input type="file" name="name" class="input-file">
                    </div>
                    <div class="col-md-12"></div>
                    <p class="col-md-6" id="file-info">No file selected...</p>
                </div>
                <div class="form-group">
                    <button type="button" name="button" class="blueBtn col-md-4 col-md-offset-8">Add!</button>
                </div>
            </div>
            <div class="col-md-12 no-padding sub-module" id="editingModule">
                <p>
                  editing
                </p>
            </div>
            <div class="col-md-12 no-padding sub-module" id="deletingModule">
                <p>
                  deleting
                </p>
            </div>
        </div>
        <div class="col-md-12 no-padding module" id="coachesModule">
            <div class="tabsContainer no-padding col-md-12">
                <a href="#" class="tab tab-active col-md-4" id="addingLauncher">Add</a>
                <a href="#" class="tab col-md-4" id="editingLauncher">Edit</a>
                <a href="#" class="tab col-md-4" id="deletingLauncher">Remove</a>
            </div>
            <p>
              coaches
            </p>
        </div>
        <div class="col-md-12 no-padding module" id="teamsModule">
            <div class="tabsContainer no-padding col-md-12">
                <a href="#" class="tab tab-active col-md-4" id="addingLauncher">Add</a>
                <a href="#" class="tab col-md-4" id="editingLauncher">Edit</a>
                <a href="#" class="tab col-md-4" id="deletingLauncher">Remove</a>
            </div>
            <p>
              Teams
            </p>
        </div>
        <div class="col-md-12 no-padding module" id="playersModule">
            <div class="tabsContainer no-padding col-md-12">
                <a href="#" class="tab tab-active col-md-4" id="addingLauncher">Add</a>
                <a href="#" class="tab col-md-4" id="editingLauncher">Edit</a>
                <a href="#" class="tab col-md-4" id="deletingLauncher">Remove</a>
            </div>
            <p>
              Players
            </p>
        </div>
    </div>
    <div class="col-md-2 col-md-offset-1" id="manageMenu">
        <a class="manageMenuHeader col-md-12">Manage...</a>
        <a href="#" id="stadiumsLauncher" class="manageMenuItem item-active col-md-12">Stadiums</a>
        <a href="#" id="coachesLauncher" class="manageMenuItem col-md-12">Coaches</a>
        <a href="#" id="teamsLauncher" class="manageMenuItem col-md-12">Teams</a>
        <a href="#" id="playersLauncher" class="manageMenuItem col-md-12">Players</a>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    $(function($){
        $(window).scroll(function () {
            if($(this).scrollTop() > $('.coverContainer').height()){
                $('nav[class=navBar]').css('background-color', 'black');
            }
            else{
                $('nav[class=navBar]').css('background-color', 'transparent');
            }
        });
        $('input[type=file][class=input-file]').change(function () {
            var file = this.files[0];
            console.log(file);
            if(file){
                $('#file-info').text("1 selected ("+file.name+").");
            }
            else{
                $('#file-info').text("No file selected.");
            }
        });
        $.each($('.manageMenuItem'), function (index, element) {
            $(element).click(function () {
                if(!$(this).hasClass('item-active')){
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
        $.each($('.tab'), function (index, element) {
            $(element).click(function () {
                if(!$(element).hasClass('tab-active')){
                    $.each($('.tab'),function (i,elem) {
                        $(elem).removeClass('tab-active');
                    });
                    $.each($('.sub-module'),function (i,elem) {
                        $(elem).fadeOut(0, function () {
                            $(elem).removeClass('sub-module-active');
                        });
                    });
                    $(this).addClass('tab-active');
                    var subMod = $(element).parent().parent().children('#'+$(this).attr('id').replace('Launcher','Module'));
                    subMod.fadeIn("slow", function () {
                        subMod.addClass('sub-module-active');
                    });
                }
            });
        });
    });
</script>
@endsection

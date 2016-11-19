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
    #gmaps-container{
      height: 300px;
      border-radius: 3px;
      box-shadow: 0px 1px 6px 0px #000;
      margin-bottom: 10px;
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
<div class="col-md-12 col-sm-12 no-padding">
    <div class="col-md-7 col-md-offset-1 col-sm-10 col-sm-offset-0">
        <div class="col-md-12 col-sm-12 no-padding module module-active" id="stadiumsModule">
            <div class="tabsContainer no-padding col-md-12">
                <a href="#" class="tab tab-active col-md-4 col-sm-4" id="addingLauncher">Add</a>
                <a href="#" class="tab col-md-4 col-sm-4" id="editingLauncher">Edit</a>
                <a href="#" class="tab col-md-4 col-sm-4" id="deletingLauncher">Remove</a>
            </div>
            <div class="col-md-12 no-padding sub-module sub-module-active" id="addingModule" style="padding: 20px;">
                <h3>New stadium</h3>
                <div class="form-group col-md-7 col-sm-7 no-padding">
                    <input type="text" name="stadium-name" value="" class="blackInput col-md-12 col-sm-12" placeholder="Pick a name...">
                </div>
                <div class="form-group col-md-5 col-sm-5">
                    <button type="button" id="addBtn" class="blueBtn col-md-11 col-sm-8 col-sm-offset-3 col-md-offset-1">Add!</button>
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
                <div class="col-md-7 no-padding" id="gmaps-container">

                </div>
                <div class="form-group col-md-5">
                  <div class="alert-card col-md-11 col-md-offset-1">
                    <h4>Instructions:</h4>
                    <p>1. Make zoom to select accurately the stadium's location.</p>
                    <p>2. Move the marker to the wished point.</p>
                    <p>3. Once you get ready, and you have filled all the information, click add!</p>
                  </div>
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
    <div class="col-md-2 col-md-offset-1 col-sm-2 col-sm-offset-0" id="manageMenu">
        <a class="manageMenuHeader col-md-12 col-sm-12">Manage...</a>
        <a href="#" id="stadiumsLauncher" class="manageMenuItem item-active col-md-12 col-sm-12">Stadiums</a>
        <a href="#" id="coachesLauncher" class="manageMenuItem col-md-12 col-sm-12">Coaches</a>
        <a href="#" id="teamsLauncher" class="manageMenuItem col-md-12 col-sm-12">Teams</a>
        <a href="#" id="playersLauncher" class="manageMenuItem col-md-12 col-sm-12">Players</a>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    var marker, map;
    function initMap() {
        var myLatLng = {lat: 40.416786, lng: -3.703788};
        map = new google.maps.Map($('#gmaps-container')[0], {
            zoom: 6,
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

    $.ajax({
        url: '/getStadiums',
        type:'post',
        dataType:'json',
        data: {
            _token: '{{csrf_token()}}'
        }
    }).done(function(response){
        $.each(response ,function (i, e) {
            var mker = new google.maps.Marker({
                position: JSON.parse(e['location']),
                map: map,
                icon: {
                    url: "img/icons/ic_place_black_24dp_1x.png"
                },
                title: e['name']
            });
        });
    });

    $(function($){
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
        $('#addBtn').click(function () {
            if(map.zoom < 15){
                showMessages('Stop just there!','You need to aument the zoom for select accurately!','alert-card');
            }
            else if(!$('input[type=file][class=input-file]')[0].files[0]){
                showMessages('Stop just there!','You must to select a photo!','alert-card');
            }
            else if($('input[name=name]').val() == "") showMessages('Stop just there!','The stadium must have a name!','alert-card');
            else {
                var formData = new FormData();
                formData.append('photo' ,$('input[type=file][class=input-file]')[0].files[0]);
                formData.append('location', JSON.stringify(marker.position));
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
                    //fix. add stadium to map and show messages
                    if(response['stadium']){
                        marker.setPosition({lat: 40.416786, lng: -3.703788});
                        map.setZoom(6);
                        var mker = new google.maps.Marker({
                            title: response['stadium']['name'],
                            position: JSON.parse(response['stadium']['location']),
                            icon: "img/icons/ic_place_black_24dp_1x.png",
                            map: map,
                            animation: google.maps.Animation.DROP
                        });
                    }
                    showMessages(response['msgs']['title'], response['msgs']['content'][0], response['msgs']['type']);
                });
            }
        });

        function showMessages(title, msg){
            var parent = $('.dark-block');
            var children = parent.children('#msgs-card');
            children.children('h4').text(title);
            children.children('p').text(msg);
            children.css('bottom','0px');
            children.fadeIn(200,function () {
                parent.fadeIn('fast',function () {
                    parent.css('display','initial');
                });
            });
        }

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

        $(window).scroll(function () {
            if($(this).scrollTop() > $('.coverContainer').height() - 50){
                $('nav[class=navBar]').css('background-color', 'black');
            }
            else{
                $('nav[class=navBar]').css('background-color', 'transparent');
            }
        });
        $('input[type=file][class=input-file]').change(function () {
            var file = this.files[0];
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
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC9fuikPcHicK9HnQSzmHM-iZikumk6710&signed_in=false&callback=initMap"></script>
@endsection

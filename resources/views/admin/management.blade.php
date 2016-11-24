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
    #editingModule{
        padding: 15px;
    }
    .no-padd-right{
        padding-right: 0;
    }
    #deletingModule{
      padding: 15px;
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
            <!-- tabs -->
            <div class="tabsContainer no-padding col-md-12">
                <a href="#" class="tab tab-active col-md-4 col-sm-4" id="addingLauncher">Add</a>
                <a href="#" class="tab col-md-4 col-sm-4" id="editingLauncher">Edit</a>
                <a href="#" class="tab col-md-4 col-sm-4" id="deletingLauncher">Remove</a>
            </div>
            <!---->
            <!-- adding -->
            <div class="col-md-12 no-padding sub-module sub-module-active" id="addingModule" style="padding: 20px;">
                <h3>New stadium</h3>
                <div class="form-group col-md-7 col-sm-7 no-padding">
                    <input type="text" name="stadium-name" value="" class="blackInput col-md-12 col-sm-12" placeholder="Pick a name...">
                </div>
                <div class="form-group col-md-5 col-sm-5">
                    <button type="button" id="addStadiumBtn" class="blueBtn col-md-11 col-sm-8 col-sm-offset-3 col-md-offset-1">Add!</button>
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
            </div>
            <!---->
            <!-- editing -->
            <div class="col-md-12 no-padding sub-module" id="editingModule">
                <h3 class="">Select one...</h3>
                <div class="col-md-7 no-padding gmaps-container" id="gmaps-container2">

                </div>
                <div class="col-md-5" id="editingStadiumDiv">
                    <p class="col-md-12 no-padding col-md-offset-0">Modify the information</p>
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
                        <button type="button" class="btnBlue col-md-12" id="editStadiumBtn" name="editStadiumBtn">Accept</button>
                    </div>
                </div>

            </div>
            <!---->
            <!-- deleting -->
            <div class="col-md-12 no-padding sub-module" id="deletingModule">
                <div class="col-md-7 no-padding gmaps-container" id="gmaps-container3">

                </div>
                <div class="col-md-5 no-padd-right" id="deletingStadiumDiv" style="display:none;">
                    <div class="form-group col-md-12 no-padding">
                      <img src="" class="col-md-12 no-padding" alt="" />
                    </div>
                    <h4 class="" id="stadium-name"></h4>
                    <div class="form-group col-md-12 no-padding">
                        <button type="button" name="button" class="col-md-12 no-padding btnBlue" id="deleteStadiumBtn">Delete</button>
                    </div>
                </div>
            </div>
            <!---->
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
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC9fuikPcHicK9HnQSzmHM-iZikumk6710&callback=initMap"></script>
<script type="text/javascript">
    var marker, map, myLatLng, stadiumsMarkers = [];
    var mapDiv = $('.gmaps-container > #gmap')[0];
    function initMap() {
        myLatLng = {lat: 40.416786, lng: -3.703788};
        map = new google.maps.Map(mapDiv, {
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
                                    console.log(mker);
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
                $(this).parent().parent().children('#file-info').text("1 selected ("+file.name+").");
            }
            else{
                $(this).parent().parent().children('#file-info').text("No file selected.");
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

        var stadiumToEdit, stadiumToDelete, clickedMarker;
        $.each($('.tab'), function (index, element) {
            $(element).click(function () {
                if(!$(element).hasClass('tab-active')){
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
                      else if($('input[name=newStadiumName]').val() == "") showMessages('Stop just there!','The stadium must have a name!','alert-card');
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
                });
            }
            else showMessages('Ups!',['Have been an error! Try again.'],'error-card');
        });

    });
</script>

@endsection

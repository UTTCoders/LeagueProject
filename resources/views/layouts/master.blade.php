<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="toktok" content="{{csrf_token()}}">
        <title>@yield('title')</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{elixir('css/app.css')}}">
        <link rel="icon" href="/img/cucu3.gif">
        <!-- Styles -->
        <style>
            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .navBar{
                width: 100%;
                top: 0px;
                left: 0px;
                position: fixed;
                z-index: 1;
                background-color: transparent;
                display: inline-block;
                padding: 10px;
                -webkit-transition: background-color .4s;
            }
            .navItem{
                background-color: transparent;
                text-decoration: none;
                font-weight: 600;
                padding: 10px;
                cursor: pointer;
                color: white;
                text-shadow: 0px 0px 2px #000;
                -webkit-transition: border-bottom .1s;
            }
            .navItem:hover div.bottomBar{
                width: 100%;
            }
            .toRight{
                position: relative;
                float: right;
            }
            .toLeft{
                position: relative;
                float: left;
            }
            .btn{
                border: 1px solid #fff;
                text-decoration: none;
                font-size: 14px;
                font-weight: 600;
                text-align: center;
                border-radius: 2px;
                padding-left: 20px;
                padding-right: 20px;
                padding-top: 10px;
                cursor: pointer;
                padding-bottom: 10px;
                -webkit-transition: background-color .5s, width .2s;
            }
            .btnTrans{
                background-color: transparent;
                color: #eee;
            }
            .btnTrans:hover{
                background-color: rgba(255, 255, 255, .1);
                color: #fff;
            }

            .bottomBar{
                background-color: white;
                position: absolute;
                margin-top: 2px;
                margin-left: -10px;
                width: 0%;
                height: 3px;
                -webkit-transition: width .3s;
            }

            .footer{
                position: relative;
                background: transparent;
                padding: 0;
            }
            .footer > div > p{
                color: #ddd;
                font-weight: 600;
            }
            a.footerLink{
                color: #ddd;
                text-decoration: none;
                font-size: 14px;
                font-weight: 600;
                -webkit-transition: color .3s;
            }
            a.footerLink:hover{
                color: #fff;
            }
            a{
                color: #ddd;
                font-weight: 600;
                text-decoration: none;
                -webkit-transition: color .2s;
            }
            a:active, a:link, a:visited{
                color:white;
                text-decoration: none;
            }
            a:hover{
                color: white;
                text-decoration: none;
            }
            .myInputWhite{
                background-color: white;
                border: 0px solid #fff;
                border-radius: 2px;
                box-shadow: 0px 1px 1px 0px #000;
                padding-bottom: 3px;
                padding-top: 3px;
                padding-left: 10px;
                padding-right: 10px;
                font-weight: 500;
                color: #888;
            }
            .myInput-large{
                width: 100%;
            }
            .myInput-md{
                width: 50%;
            }
            .btnBlue{
                border: 1px solid deepskyblue;
                background: dodgerblue;
                color: white;
                border-radius: 3px;
                box-shadow: 0px 1px 1px 0px #000;
            }
            .btnBlue:hover{
                background: #1d80dd;
                color: white;
            }
            .btnBlue:active, .btnBlue:focus{
                color: white;
            }
            .menuPanel{
                position: fixed;
                float: right;
                background-color: #111;
                height: 100%;
                width: 210px;
                right: -210px;
                -webkit-transition: right .6s;
                padding-top: 15px;
                z-index: 10;
                box-shadow: -1px 0px 2px #000;
            }
            .panelItem{
                position: relative;
                background-color: #111;
                text-align: center;
                padding-top: 7px;
                padding-bottom: 7px;
                float: left;
                width: 100%;
                font-size: 16px;
                color: #eee;
                cursor: pointer;
            }
            .panelItem:link,.panelItem:active,.panelItem:visited{
                text-decoration: none;
                color: white;
            }
            .panelItem:hover{
                -webkit-transition: background-color 1s, width .6s, border-left .1s;
                color: white;
                background-color: #000;
                box-shadow: inset 0px 0px 5px 0px #000;
                text-decoration: none;
                border-left: 4px solid dodgerblue;
            }
            .panelSubItem{
                background-color: #000;
                position: relative;
                text-align: center;
                padding-top: 5px;
                padding-bottom: 5px;
                float: left;
                width: 100%;
                font-size: 12px;
                color: #eee;
            }
            .panelSubItem:link,.panelItem:active,.panelItem:visited{
                text-decoration: none;
                color: #fff;
            }
            .panelSubItem:hover{
                -webkit-transition: background-color .4s, width .6s;
                border: 1px solid #222;
                background-color: #111;
                box-shadow: inset 0px 0px 5px 0px #111;
                text-decoration: none;
            }
            .menu{
                top: 8px;
                width: 30px;
                height: 27px;
                padding-top: 5px;
                padding-left: 10px;
                padding-right: 10px;
                margin-left: 40px;
                margin-right: 10px;
                -webkit-transition: padding .4s;
            }
            .menu:hover{
                background-color: transparent;
                padding-left: 3px;
                padding-right: 3px;
            }
            .menuBar{
                background-color: white;
                box-shadow: 0px 0px 2px 0px #222;
                height: 3px;
                margin-bottom: 4px;
                -webkit-transition: background-color .9s;
            }
            .menuBar{
                -webkit-transition: background-color .9s;
            }
            .blackCard{
                background-color: #111;
                border-radius: 3px;
                box-shadow: 0px 1px 1px 0px #000;
                color: white;
            }
            .whiteCard{
                background-color: #fff;
                border-radius: 3px;
                box-shadow: 0px 1px 1px 0px #777;
                color: #555;
            }
            #footerBrand{
                padding:5px;
                border-radius: 3px;
                box-shadow: 0px 1px 5px 0px #000;
                width: 30px;
                margin: auto;
                display: block;
                background-color:white;
            }
            #hideBtn{
              margin-bottom: 15px;
            }
            #hideBtn:hover{
              color: white;
            }
            .no-padding{
                padding: 0;
            }
        </style>
        @yield('css')
    </head>
    <body>
        <nav class="navBar">
            @if(Auth::check())
            <a href="/" class="navItem toLeft">Home<div class="bottomBar"></div></a>
            <div class="menu toRight">
                <div class="menuBar"></div>
                <div class="menuBar"></div>
                <div class="menuBar"></div>
            </div>
                @if(Auth::user()->type)
                <a class="navItem toRight">{{Auth::user()->name}}<div class="bottomBar"></div></a>
                @else
                <a class="navItem toRight">{{Auth::user()->name}}<div class="bottomBar"></div></a>
                @endif
            @else
             <a href="/home" class="navItem toLeft">Home<div class="bottomBar"></div></a>
            <a class="navItem toRight" id="loginLauncher">Log in<div class="bottomBar"></div></a>
            @endif

        </nav>
        @if(Auth::check())
            @if(Auth::user()->type)
            <!-- Here goes the admin options :O -->
            <div class="menuPanel">
                <i class="material-icons pull-right" id="hideBtn" style="margin-right:15px;font-size:28px;cursor:pointer;">arrow_forward</i>
                <div class="itemsContainer">
                    <a id="1"  class="panelItem event">Management</a>
                    <a href="/" id="1" class="panelSubItem" style="display:none">Stadiums and Coaches</a>
                    <a href="/admin/teams/add" id="1" class="panelSubItem" style="display:none">Teams</a>
                    <a href="/admin/players/add" id="1" class="panelSubItem" style="display:none">Players</a>
                    <a href="/admin/referees/add" id="1" class="panelSubItem" style="display:none">Referees</a>
                    <a id="2"  class="panelItem event">Calendar</a>
                    <a href="/admin/seasons/add-matches" id="2" class="panelSubItem" style="display:none">Programme matches</a>
                    <a href="/admin/seasons/control-matches" id="2" class="panelSubItem" style="display:none">Control matches</a>
                </div>
                <div class="bottomContainer col-md-12 col-xs-12 col-sm-12 no-padding" style="position:absolute;bottom:0px;background-color:red;">
                  <a href="/favorites" class="panelItem" style="">Favorites</a>
                  <a id="logOutBtn" href="/logout" class="panelItem">Log out</a>
                </div>
            </div>

            @else
            <!-- And here the user options :D -->
                <div class="menuPanel">
                    <i class="material-icons pull-right" id="hideBtn" style="margin-right:15px;font-size:28px;cursor:pointer;">arrow_forward</i>
                    <div class="itemsContainer">
                        <a href="/teams" class="panelItem"><span class="glyphicon glyphicon glyphicon-flag"></span> All the teams</a>
                        <a href="/favorites" class="panelItem"><span class="glyphicon glyphicon-star-empty"></span> My favorite teams</a>
                        <a href="/matches" class="panelItem"><span class="glyphicon glyphicon-th"></span> See all matches</a>
                    </div>
                    <div class="bottomContainer col-xs-12 no-padding" style="position:absolute;bottom:0px;">
                      <a id="logOutBtn" href="/logout" class="panelItem">Log out</a>
                    </div>
                </div>
            @endif
        @endif
        @yield('body')
        <div class="footer col-md-12 col-xs-12 col-sm-12 col-lg-12">
            <div style="padding-left: 40px; padding-top: 30px; padding-right: 40px; padding-bottom: 30px;">
                <p class="toLeft hidden-xs" style="position: absolute; left: 25%; top: 40px;">league-project.com</p>
                <img src="{{elixir('img/icons/la-liga.png')}}" alt="" id="footerBrand" >
                <a class="footerLink hidden-xs" style="position: absolute; right: 25%; top: 40px;" href="">privacity</a>
            </div>
        </div>
        <script type="text/javascript">
          window.fbAsyncInit = function() {
              FB.init({
                appId      : '1767846576800416',
                xfbml      : true,
                cookie     : true,
                version    : 'v2.8'
              });
              FB.AppEvents.logPageView();

              $('#fbBtn1').click(function () {
                  FB.login(function (response) {
                      if(response.authResponse){
                          FB.api('/me',{fields:'email,id,name'}, function(user) {
                           $.ajax({
                             url:'/fblogin',
                             type:'post',
                             data:{
                               _token: '{{csrf_token()}}',
                               user: user
                             },
                             dataType:'json'
                           }).done(function (returnedData) {
                               if(returnedData['result']){
                                window.location.replace('/');
                               }
                               else showMessages('Ups!',returnedData['msg']);

                           });
                          });
                      }
                      else showMessages('Ups!','Connection unsuccessful');
                  },{scope:'email'});
              });

              $('#logOutBtn').click(function () {
                  FB.getLoginStatus(function (response) {
                    if(response.status === 'connected'){
                      FB.logout();
                    }
                    window.location.replace('/logout');
                  },true);
              });
          };

          (function(d, s, id){
             var js, fjs = d.getElementsByTagName(s)[0];
             if (d.getElementById(id)) {return;}
             js = d.createElement(s); js.id = id;
             js.src = "//connect.facebook.net/en_US/sdk.js";
             fjs.parentNode.insertBefore(js, fjs);
          }(document, 'script', 'facebook-jssdk'));

        </script>

        <script src="{{elixir('js/jquery-3.1.0.min.js')}}"></script>
        @yield('js')
        <script>
            $(function($){
                if($('.coverContainer').length > 0){
                  if($(this).scrollTop() > $('.coverContainer').height() - 50){
                      $('nav[class=navBar]').css('background-color', '#111');
                  }
                  else{
                      $('nav[class=navBar]').css('background-color', 'transparent');
                  }
                  $(window).scroll(function () {
                      if($(this).scrollTop() > $('.coverContainer').height() - 50){
                          $('nav[class=navBar]').css('background-color', '#111');
                      }
                      else{
                          $('nav[class=navBar]').css('background-color', 'transparent');
                      }
                  });
                }
                //menu
                $('.menu').hover(function(){
                    $('.menu').css('cursor','pointer');
                    $(this).children('.menuBar').css('cursor','pointer');
                });
                $('.menu').mouseleave(function(){
                });
                var active=false;
                $('.menu').click(function(){
                    if(active){
                        active=false;
                        $('.menuPanel').css('right','-211px');
                    }
                    else{
                        active=true;
                        $('.menuPanel').css('right','0px');
                    }
                });
                $.each($('.panelItem'),function(index,element){
                    $(element).click(function(){
                        $.each($('.panelSubItem[id="'+$(element).prop('id')+'"]'),function(index,subElement){
                            $(subElement).slideToggle('fast');
                        });
                    });
                });
                $('#hideBtn').click(function () {
                  active=false;
                  $(this).parent().css('right','-211px');
                });
            });
        </script>
    </body>
</html>

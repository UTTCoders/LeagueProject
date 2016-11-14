<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

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
                position: fixed;
                z-index: 1;
                background-color: rgba(255, 255, 255, .0);
                display: inline-block;
                padding: 10px;
            }
            .navItem{
                background-color: transparent;
                text-decoration: none;
                font-weight: 600;
                padding: 10px;
                cursor: pointer;
                color: white;
                text-shadow: 1px 1px 4px #111;
                -webkit-transition: border-bottom .1s;
            }
            .navItem:hover div.bottomBar{
                width: 100%;
            }
            .toRight{
                position: relative;
                float: right;
                margin-right: 20px;
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
                width: 100px;
                -webkit-transition: background-color .5s, width .2s;
            }
            .btn:hover{
                width: 120px;
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
                margin-top: 5px; 
                margin-left: -10px;
                width: 0%;
                height: 3px;
                -webkit-transition: width .3s;
            }
            
            .footer{
                position: relative;
                background: #111;
                box-shadow: inset 0px 0px 7px 0px #000;
                bottom: 0px;
                width: 100%;
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
                text-decoration: none;
                -webkit-transition: color .2s;
            }
            a:hover{
                color: white;
                text-decoration: none;
            }
        </style>
        @yield('css')
    </head>
    <body>
        <nav class="navBar">
            <a href="" class="navItem toLeft">Home<div class="bottomBar"></div></a>
            <a class="navItem toRight" id="loginLauncher">Log in<div class="bottomBar"></div></a>
        </nav>
        @yield('body')
        <div class="footer">
            <div style="padding-left: 40px; padding-top: 20px; padding-right: 40px; padding-bottom: 30px;">
                <p>league-project.com</p>
                <a class="footerLink" href="">privacity</a>
            </div>
        </div>
        <script src="{{elixir('js/jquery-3.1.0.min.js')}}"></script>
        @yield('js')
    </body>
</html>
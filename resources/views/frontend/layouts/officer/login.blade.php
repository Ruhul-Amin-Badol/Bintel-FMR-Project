<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fmr Officer Login</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('resources/assets/img/logo-sm.png') }}">
    <link rel="stylesheet" href="{{ asset('resources/assets/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('resources/assets/css/style.css') }}">



    <style>
        .logo span {
            font-weight: 600;
            color: #635858;
            font-size: 17px;
            font-family: sans-serif;
            margin-left: 14px;
            margin-top: 8px;
            display: block;
        }

        .animate_charcter {
            text-transform: uppercase;
            background-image: linear-gradient(-225deg, #231557 0%, #077abd 29%, #f8142d 67%, #ffee00 100%);
            background-size: auto auto;
            background-clip: border-box;
            background-size: 200% auto;
            color: #fff;
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: textclip 2s linear infinite;
            display: inline-block;
            font-size: 190px;
        }

        .animate_date {
            background-image: linear-gradient(-225deg, #231557 0%, #077abd 29%, #f8142d 67%, #ffee00 100%);
            background-size: 200% auto;
            color: #fff;
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: textclip 2s linear infinite;
            display: inline-block;
        }

        @keyframes textclip {
            to {
                background-position: 200% center;
            }
        }

        .logo h5 {
            text-shadow: 0 2px 3px #353535;
            font-size: 30px;
            color: #e40808;
            margin-bottom: 0;
            margin-left: 8px;
        }

        @media (min-width: 1801px) {
            .logo span {
                font-size: 15px;
            }

        }

        @media (min-width: 1801px) {
            .logo h5 {
                font-size: 27px;
            }

        }

        @media only screen and (max-width: 1400px) and (min-width: 993px) {

            .logo span {
                font-size: 12px;
            }

            .logo h5 {
                font-size: 18px;
            }

            .logo {
                height: 70px;
            }


        }

        @media only screen and (max-width: 992px) and (min-width: 468px) {

            .logo span {
                font-size: 9px;
            }

            .logo h5 {
                font-size: 16px;
            }

            .logo {
                height: 50px;
            }


        }

        @media only screen and (max-width: 467px) and (min-width: 320px) {
            .logo span {
                font-size: 8px;
            }


            .logo h5 {
                font-size: 14px;
                text-shadow: 0 2px 3px #969696;
            }

            .logo {
                height: 40px;
            }


        }



        .wrapper {
            background: #50a3a2;
            background: linear-gradient(top left, #50a3a2 0%, #53e3a6 100%);
            background: linear-gradient(to bottom right, #50a3a2 0%, #53e3a6 100%);
            position: absolute;
            /* top: 50%; */
            left: 0;
            width: 100%;
            height: 100%;
            /* margin-top: -200px; */
            overflow: hidden;
        }

        .wrapper.form-success .container-new h1 {
            transform: translateY(85px);
        }

        .container-new {
            max-width: 600px;
            margin: 0 auto;
            padding: 80px 0;
            height: 100%;
            text-align: center;
        }

        .container-new h1 {
            font-size: 40px;
            transition-duration: 1s;
            transition-timing-function: ease-in- put;
            font-weight: 200;
        }

        .logform {
            padding: 20px 0;
            position: relative;
            z-index: 2;
        }

        .logform input {
            appearance: none;
            outline: 0;
            border: 1px solid rgba(255, 255, 255, 0.4);
            background-color: rgba(255, 255, 255, 0.2);
            width: 250px;
            border-radius: 3px;
            padding: 10px 15px;
            margin: 0 auto 10px auto;
            display: block;
            text-align: center;
            font-size: 18px;
            color: white;
            -webkit-transition-duration: 0.25s;
            transition-duration: 0.25s;
            font-weight: 300;
        }

        .logform input:hover {
            background-color: rgba(255, 255, 255, 0.4);
        }

        .logform input:focus {
            background-color: white;
            width: 300px;
            color: #53e3a6;
        }

        .logform button {
            appearance: none;
            outline: 0;
            background-color: white;
            border: 0;
            padding: 10px 15px;
            color: #53e3a6;
            border-radius: 3px;
            width: 250px;
            cursor: pointer;
            font-size: 18px;
            transition-duration: 0.25s;

        }

        .logform button:hover {
            background-color: #f5f7f9;
        }

        .bg-bubbles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
        }

        .bg-bubbles li {
            position: absolute;
            list-style: none;
            display: block;
            width: 40px;
            height: 40px;
            background-color: rgba(255, 255, 255, 0.15);
            bottom: -160px;
            animation: square 25s infinite;
            transition-timing-function: linear;
        }

        .bg-bubbles li:nth-child(1) {
            left: 10%;
        }

        .bg-bubbles li:nth-child(2) {
            left: 20%;
            width: 80px;
            height: 80px;
            animation-delay: 2s;
            animation-duration: 17s;
        }

        .bg-bubbles li:nth-child(3) {
            left: 25%;
            animation-delay: 4s;

        }

        .bg-bubbles li:nth-child(4) {
            left: 40%;
            width: 60px;
            height: 60px;
            animation-duration: 22s;
            background-color: rgba(255, 255, 255, 0.25);
        }

        .bg-bubbles li:nth-child(5) {
            left: 70%;
        }

        .bg-bubbles li:nth-child(6) {
            left: 80%;
            width: 120px;
            height: 120px;
            animation-delay: 3s;
            background-color: rgba(255, 255, 255, 0.2);
        }

        .bg-bubbles li:nth-child(7) {
            left: 32%;
            width: 160px;
            height: 160px;
            animation-delay: 7s;
        }

        .bg-bubbles li:nth-child(8) {
            left: 55%;
            width: 20px;
            height: 20px;
            animation-delay: 15s;
            animation-duration: 40s;
        }

        .bg-bubbles li:nth-child(9) {
            left: 25%;
            width: 10px;
            height: 10px;
            animation-delay: 2s;
            animation-duration: 40s;
            background-color: rgba(255, 255, 255, 0.3);
        }

        .bg-bubbles li:nth-child(10) {
            left: 90%;
            width: 160px;
            height: 160px;
            animation-delay: 11s;
        }

        @keyframes square {
            0% {
                transform: translateY(0);
            }

            100% {
                transform: translateY(-700px) rotate(600deg);
            }
        }

        @keyframes square {
            0% {
                transform: translateY(0);
            }

            100% {
                transform: translateY(-700px) rotate(600deg);
            }
        }
    </style>
</head>

<body>



    <header class="p-3  border-bottom bg-white">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center  justify-content-center">
                <a href="https://the-royal-scientific-publications.com" class="logo d-flex"><img class="mr-1"
                        src="https://the-royal-scientific-publications.com/uploads/logos/2023/08/20/logo_1692527996.webp"
                        alt="The Royal Scientific Publications">
                    <div class="d-block mobile_hide">
                        <h5>The Royal Scientific Publications</h5>
                        <span class="animate_charcter">World Class Publications in Bangladesh</span>
                    </div>
                </a>
            </div>
        </div>
    </header>

    <div class="container">
        <div class="row ">
            <div class="wrapper">
                <div class="container-new">
                    <div class="border">
                        <h1 class="text-white">Welcome To TRSP!</h1>
                    <form class="logform"  action="{{ route('officer.login.submit') }}" method="POST">
                        @csrf
                        <input type="text" name="employee_id" placeholder="Username">
                        <input type="password" name="password" placeholder="Password">
                        <button type="submit" id="login-button">Login</button>
                    </form>
                    </div>
                </div>

                <ul class="bg-bubbles">
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>
            </div>
            {{-- <div class="col-md-4 mx-auto mt-5">
                <div class="card border shadow p-3">
                    <div class="title">
                        <h3 class="text-center text-danger">Field Marketing</h3>
                        <h6 class="text-center mb-3 text-success">Officers Login</h6>
                    </div>

                    @if (Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @endif

                    @if (Session::has('error'))
                        <div class="alert alert-danger">
                            {{ Session::get('error') }}
                        </div>
                    @endif

                    <form action="{{ route('officer.login.submit') }}" method="POST">
                        @csrf
                        <div class="form-outline mb-4">
                            <input type="text" id="form2Example1" name="employee_id" class="form-control" />
                            <label class="form-label" for="form2Example1">User ID</label>
                        </div>

                        <div class="form-outline mb-4">
                            <input type="password" id="form2Example2" name="password" class="form-control" />
                            <label class="form-label" for="form2Example2">Password</label>
                        </div>

                        <button type="submit" class="btn btn-success btn-block mb-4 fw-bold w-100">Log In</button>
                    </form>

                </div>
            </div> --}}
        </div>
    </div>


    </style>
    <script src="{{ asset('resources/assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('resources/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        // Initialization for ES Users
        import {
            Dropdown,
            Collapse,
            initMDB
        } from "mdb-ui-kit";

        initMDB({
            Dropdown,
            Collapse
        });


        $("#login-button").click(function(event){
     event.preventDefault();

   $('form').fadeOut(500);
   $('.wrapper').addClass('form-success');
});
    </script>
</body>

</html>

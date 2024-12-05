<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Success Message</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('resources/assets/img/logo-sm.png') }}">

    <link rel="stylesheet" href="{{ asset('resources/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/assets/css/style.css') }}">
    <style>

        .success-box {
            margin-top: 100px;
            background: #fff;
            color: #108800;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .success-icon {
            font-size: 48px;
            margin-bottom: 20px;
        }

        .message {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .back-to-home {
            color: #fff;
            text-decoration: none;
            background-color: #333;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .back-to-home:hover {
            background-color: #555;
        }



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
            text-shadow: 0 2px 3px #000;
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
                display: none
            }

            .logo h5 {
                display: none
            }


            .logo {
                height: 40px;
            }


        }
    </style>
</head>

<body>


    <header class="p-3 mb-3 border-bottom bg-white">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center  justify-content-between">
                <a href="https://the-royal-scientific-publications.com" class="logo d-flex"><img class="mr-1"
                        src="https://the-royal-scientific-publications.com/uploads/logos/2023/08/20/logo_1692527996.webp"
                        alt="The Royal Scientific Publications">
                    <div class="d-block mobile_hide">
                        <h5>The Royal Scientific Publications</h5>
                        <span class="animate_charcter">World Class Publications in Bangladesh</span>
                    </div>
                </a>

                <ul class="nav col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">


                </ul>

                @if (session()->has('officer'))
                    <div class="dropdown text-end">

                        <a href="#" class="d-block d-flex align-items-center link-dark text-decoration-none dropdown-toggle text-center"
                            id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false"
                            style="display: flex; align-items: center; justify-content: center;">
                            <img src="{{ asset('resources/assets/img/profile.png') }}" alt="mdo" width="40"
                                height="40" class="rounded-circle" style="margin-right: 10px;">
                            <span class="fw-bold">{{ session('officer')->name }}</span>
                        </a>
                        <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
                            <li><a class="dropdown-item" href="{{ route('officer.logout') }}" style="background-color: #e40808 !important;">Log Out</a></li>
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </header>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="success-box">
                    <img src="{{ asset('resources/assets/img/thankyou.jpg') }}" alt="">
                    <div class="message">Successfully! Your action was completed.</div>
                    <a href="{{route('library.visit.front')}}" class="back-to-home">Back to Home</a>
                </div>
            </div>
        </div>

    </div>



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
    </script>
</body>

</html>

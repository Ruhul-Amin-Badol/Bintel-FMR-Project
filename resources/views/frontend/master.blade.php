<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Field Marketing Records</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('resources/js/daterangepicker.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('resources/assets/css/bootstrap-datetimepicker.min.css') }}" />
    <style>
        main {
            width: 40rem;
            height: 43rem;
            background-color: #ffffff;
            -webkit-box-shadow: 0px 5px 15px 8px #e4e7fb;
            box-shadow: 0px 5px 15px 8px #e4e7fb;
            display: flex;
            flex-direction: column;
            align-items: center;
            border-radius: 0.5rem;
        }

        #header {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 2.5rem 2rem;
        }

        .share {
            width: 4.5rem;
            height: 3rem;
            background-color: #f55e77;
            border: 0;
            border-bottom: 0.2rem solid #c0506a;
            border-radius: 2rem;
            cursor: pointer;
        }

        .share:active {
            border-bottom: 0;
        }

        .share i {
            color: #fff;
            font-size: 2rem;
        }

        h1 {
            font-family: "Rubik", sans-serif;
            font-size: 1.7rem;
            color: #141a39;
            text-transform: uppercase;
            cursor: default;
            font-weight: 600;
        }

        #leaderboard {
            width: 100%;
            position: relative;
        }

        .main table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            color: #141a39;
            cursor: default;
        }

        .main tr {
            transition: all 0.2s ease-in-out;
            border-radius: 0.2rem;
        }

        .main tr:not(:first-child):hover {
            background-color: #fff;
            transform: scale(1.1);
            -webkit-box-shadow: 0px 5px 15px 8px #e4e7fb;
            box-shadow: 0px 5px 15px 8px #e4e7fb;
        }

        .main tr:nth-child(odd) {
            background-color: #f9f9f9;
        }

        .main tr:nth-child(1) {
            color: #fff;
        }

        .main td {
            height: 5rem;
            font-family: "Rubik", sans-serif;
            font-size: 1.2rem;
            padding: 1rem 2rem;
            position: relative;
        }

        .number {
            width: 1rem;
            font-size: 2.2rem;
            font-weight: bold;
            text-align: left;
        }

        .name {
            text-align: left;
            font-size: 1.2rem;
        }

        .points {
            font-weight: bold;
            font-size: 1.3rem;
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }

        .points:first-child {
            width: 10rem;
        }

        .gold-medal {
            height: 3rem;
            margin-left: 1.5rem;
        }



        .ribbon {
            width: 42rem;
            height: 5.5rem;
            top: -0.5rem;
            background-color: #5c5be5;
            position: absolute;
            left: -1rem;
            -webkit-box-shadow: 0px 15px 11px -6px #7a7a7d;
            box-shadow: 0px 15px 11px -6px #7a7a7d;
        }

        .ribbon::before {
            content: "";
            height: 1.5rem;
            width: 1.5rem;
            bottom: -0.8rem;
            left: 0.35rem;
            transform: rotate(45deg);
            background-color: #5c5be5;
            position: absolute;
            z-index: -1;
        }

        .ribbon::after {
            content: "";
            height: 1.5rem;
            width: 1.5rem;
            bottom: -0.8rem;
            right: 0.35rem;
            transform: rotate(45deg);
            background-color: #5c5be5;
            position: absolute;
            z-index: -1;
        }

        #buttons {
            width: 100%;
            margin-top: 3rem;
            display: flex;
            justify-content: center;
            gap: 2rem;
        }

        .exit {
            width: 11rem;
            height: 3rem;
            font-family: "Rubik", sans-serif;
            font-size: 1.3rem;
            text-transform: uppercase;
            color: #7e7f86;
            border: 0;
            background-color: #fff;
            border-radius: 2rem;
            cursor: pointer;
        }

        .exit:hover {
            border: 0.1rem solid #5c5be5;
        }

        .continue {
            width: 11rem;
            height: 3rem;
            font-family: "Rubik", sans-serif;
            font-size: 1.3rem;
            color: #fff;
            text-transform: uppercase;
            background-color: #5c5be5;
            border: 0;
            border-bottom: 0.2rem solid #3838b8;
            border-radius: 2rem;
            cursor: pointer;
        }

        .continue:active {
            border-bottom: 0;
        }

        @media (max-width: 740px) {
            * {
                font-size: 70%;
            }
        }

        @media (max-width: 500px) {
            * {
                font-size: 55%;
            }
        }

        @media (max-width: 390px) {
            * {
                font-size: 45%;
            }
        }

        .live-icon {
            display: inline-block;
            position: relative;
            top: calc(50% - 5px);
            background-color: red;
            width: 10px;
            height: 10px;
            margin-left: 20px;
            border: 1px solid rgba(black, 0.1);
            border-radius: 50%;
            z-index: 1;
        }

        .live-icon:before {
            content: "";
            display: block;
            position: absolute;
            background-color: rgba(255, 0, 0, 0.212);
            width: 100%;
            height: 100%;
            border-radius: 50%;
            animation: live 2s ease-in-out infinite;
            z-index: -1;
        }


        @keyframes live {
            0% {
                transform: scale(1, 1);
            }

            100% {
                transform: scale(3.5, 3.5);
                background-color: rgba(red, 0);
            }
        }
    </style>


</head>

<body>
    <div class="container  p-5">



        <div class="heading-area text-center">
            <h1>Field Marketing Records</h1>
            <img src="{{ asset('resources/assets/img/heading-line.png') }}" alt="">
        </div>
        <h1 class="text-center pt-5">Leaderboard Live<span class="live-icon"></span></h1>
        <div class="row d-flex justify-content-center mt-5" id="filter_inputs">
            <div class="col-md-8 ">
                <form method="POST" action="{{ route('rank') }}" class="filter-form">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-6 mt-3">
                            <label class="fw-bold" for="dateInput">Select a daterange</label>
                            <input type="text" class="form-control form-control-lg" name="range" id="daterange"
                                @isset($oldDate) value="{{ $oldDate }}" @endisset>
                        </div>

                        <div class="col-md-6 mt-3">

                            <label class="fw-bold" for="employee_name">Category:</label>
                            <select id="employee_name" name="type" class="form-control form-control-lg">
                                <option value="institute">School/college</option>
                                <option value="teacher">Teacher</option>
                                <option value="library">Library</option>
                                <option value="others_institute">Coaching/Batch</option>
                                <option value="student">Student</option>
                                <option value="quiz">Quiz</option>
                                <option value="CPV">CPV</option>
                                <option value="CPD">CPD</option>
                                <option value="CPBD">CPBD</option>
                            </select>
                        </div>

                    </div>
                  
                    <div class="col-md-12 mt-3 text-center">
                          
                         <input type="password" class="form-control form-control-lg" name="password" placeholder="Password" required>
                    </div>
                  
                    <div class="col-md-12 mt-3 text-center filter">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row mt-5 main">
            @isset($title)
                <h4 class="text-center my-2">{{ $title }}</h4>
                <p class="text-center my-2 fw-bold">{{ $date }}</p>
            @endisset
            <div class="col-md-12 d-flex justify-content-center">
                <main>
                    <div id="header">
                        <h5>Rank</h5>
                        <h5>Name</h5>
                        <h5>Total Visit</h5>

                    </div>
                    <div id="leaderboard">

                        @if (count($top5Leaderboard) != 0)
                            <div class="ribbon"></div>
                        @endif

                        <table>


                            @php
                                $i = 0;
                            @endphp

                            @forelse ($top5Leaderboard as $key => $record)
                                @php
                                    $i++;
                                @endphp
                                <tr @if ($loop->first) style="background-color: #FFFF00;" @endif>
                                    <td class="number">{{ $i }}</td>
                                    <td class="name">{{ $record['employee_name'] }} ({{ $record['employee_id'] }})
                                    </td>
                                    <td class="points">
                                        @if ($loop->first)
                                            <img class="gold-medal mr-3"
                                                src="{{ asset('resources/assets/img/gold-medal.png') }}"
                                                alt="gold medal" />
                                        @endif
                                        {{ $record['total_institute'] }}
                                    </td>
                                </tr>
                            @empty
                                <div class="text-center text-danger">
                                    <h3>No records found!</h3>
                                </div>
                            @endforelse





                        </table>

                    </div>
                </main>
            </div>
        </div>
    </div>







    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="{{ asset('resources/js/daterangepicker.min.js') }}"></script>


    <script>
        $(document).ready(function() {
            $('#daterange').daterangepicker({

                opens: 'right',
                showDropdowns: true,
                showWeekNumbers: true,
                alwaysShowCalendars: true,
                ranges: {
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf('month')],
                    'Current Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year')
                        .endOf('year')
                    ],
                    'Current Year': [moment().startOf('year'), moment().endOf('year')],
                    'Custom': [moment().startOf('month'), moment().endOf('month')]
                }
            }, function(start, end, label) {
                console.log("A new date was selected: " + start.format('YYYY-MM-DD'));
            });

            @isset($oldFilter)

                $("#employee_name").val("{{ $oldFilter }}");
            @endisset
        });
    </script>




</body>



</html>

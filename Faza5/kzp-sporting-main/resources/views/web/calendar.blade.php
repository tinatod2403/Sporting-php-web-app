<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    {{--    <meta name="_token" content="{{ csrf_token() }}">--}}
    <title>Kalendar</title>
    <link rel="stylesheet" href="{{ asset('assets/front/css/calendar-style.css') }}"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap"
          rel="stylesheet"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
        .slideshow li:nth-child(1) span {
            position: absolute;
            background-image: url({{ asset('assets/front/images/slideshow/1.jpg') }});
        }

        .slideshow li:nth-child(2) span {
            position: absolute;
            background-image: url({{ asset('assets/front/images/slideshow/2.jpg') }});
            -webkit-animation-delay: 6s;
            -moz-animation-delay: 6s;
            animation-delay: 6s;
        }

        .slideshow li:nth-child(3) span {
            background-image: url({{ asset('assets/front/images/slideshow/6.jpg') }});
            -webkit-animation-delay: 12s;
            -moz-animation-delay: 12s;
            animation-delay: 12s;
        }

        .slideshow li:nth-child(4) span {
            background-image: url({{ asset('assets/front/images/slideshow/4.jpg') }});
            -webkit-animation-delay: 18s;
            -moz-animation-delay: 18s;
            animation-delay: 18s;
        }

        .slideshow li:nth-child(4) span {
            background-image: url({{ asset('assets/front/images/slideshow/8.jpg') }});
            -webkit-animation-delay: 18s;
            -moz-animation-delay: 18s;
            animation-delay: 18s;
        }

        .disabled-li {
            pointer-events: none;
            opacity: 0.6;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="calendar">
        <div class="month">
            <i class="fas fa-angle-left prev"></i>
            <div class="date">
                <h1></h1>
                <p></p>
            </div>
            <i class="fas fa-angle-right next"></i>
        </div>
        <div class="weekdays">
            <div>Ned</div>
            <div>Pon</div>
            <div>Ut</div>
            <div>Sre</div>
            <div>Cet</div>
            <div>Pet</div>
            <div>Sub</div>
        </div>
        <div class="days"></div>
    </div>
    <ul class='slideshow'>
        <li>
            <h3></h3>
            <span>Summer</span>
        </li>
        <li>
            <span>Fall</span>
        </li>
        <li>
            <span>Winter</span>
        </li>
        <li>
            <span>Spring</span>
        </li>
    </ul>
</div>

<div id="myModal" class="modal">
    <div class="modal-content">
        <div id="myDIV" class="header">
            <p style="font-size:25px;">Zakažite termin:</p>
            <br>
            <button id="btn-potvrdi">
                <b>POTVRDI</b></button>
        </div>
        <ul id="myUL">
        </ul>
    </div>
</div>
<script src="{{ asset('assets/front/js/calendar-script.js') }}"></script>
<script>
    $(document).ready(function () {
        let day = '';
        let month = '';
        let year = '';
        let dayName = '';

        $(".day").click(function () {
            day = $(this).text();
            month = $(".date h1").text();

            switch (month) {
                case 'Januar':
                    month = 1;
                    break;
                case 'Februar':
                    month = 2;
                    break;
                case 'Mart':
                    month = 3;
                    break;
                case 'April':
                    month = 4;
                    break;
                case 'Maj':
                    month = 5;
                    break;
                case 'Jun':
                    month = 6;
                    break;
                case 'Jul':
                    month = 7;
                    break;
                case 'Avgust':
                    month = 8;
                    break;
                case 'Septembar':
                    month = 9;
                    break;
                case 'Oktobar':
                    month = 10;
                    break;
                case 'Novembar':
                    month = 11;
                    break;
                case 'Decembar':
                    month = 12;
                    break;
            }
            year = new Date();
            year = year.getFullYear();

            dayName = new Date(year, month - 1, day);
            dayName = dayName.getDay();
            switch (dayName) {
                case 0:
                    dayName = 'Sunday';
                    break;
                case 1:
                    dayName = 'Monday';
                    break;
                case 2:
                    dayName = 'Tuesday';
                    break;
                case 3:
                    dayName = 'Wednesday';
                    break;
                case 4:
                    dayName = 'Thursday';
                    break;
                case 5:
                    dayName = 'Friday';
                    break;
                case 6:
                    dayName = 'Saturday';
                    break;
            }

            $.ajax({
                url: "{{ route('get-free-appointments') }}",
                type: "GET",
                data: {
                    'date': `${day}.${month}.${year}.`,
                    'day': `${dayName}`,
                    'complex': "{{ $complex->name }}",
                    'category': " {{ $category->type }}",
                },
                dataType: 'json',
                success: function (data) {
                    $("#myUL").html('');
                    for (let i = 0; i < data.appointments.length; ++i) {
                        $("#myUL").append(data.appointments[i]);
                    }
                },
                error: function (data) {
                    console.log("ERROR");
                }
            });
        });

        $(document).on('click', '.date', function () {
            let startTime = $(this).text().split('-')[0];
            $.ajax({
                url: "{{ route('reservation-appointments') }}",
                type: "GET",
                data: {
                    'date': `${day}.${month}.${year}.`,
                    'start_time': `${year}-${month}-${day} ${startTime}:00`,
                    'complex': "{{ $complex->name }}",
                    'category': " {{ $category->type }}",
                    'customer': " {{ auth()->guard('customer')->user()->id }}",
                },
                dataType: 'json',
                success: function (data) {
                    alert(data.message);
                },
                error: function (data) {
                    console.log("ERROR");
                }
            });
        });
    });
</script>
</body>
</html>

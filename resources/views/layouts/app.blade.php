<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- bt select --}}
    <link defer rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js" integrity="sha512-2bMhOkE/ACz21dJT8zBOMgMecNxx0d37NND803ExktKiKdSzdwn+L7i9fdccw/3V06gM/DBWKbYmQvKMdAA9Nw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}


    {{-- datepicker  --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    {{-- <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css"> --}}
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
 
    @push('styles')
        <style>
     

            @import "https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700";

            
            .badge-leave-approve-status {
                color: black;
                background-color: #E0EDC5;
            }
            .badge-leave-reject-status {
                color: black;
                background-color: #F68EA1;
            }
            .badge-leave-wait-status {
                color: black;
                background-color: #CAD2E2;
            }         
            .badge-pill {
                border-radius: 20px;
            }
            
            

            body {
                font-family: 'Poppins', sans-serif;
                background: #fafafa;
            }

            p {
                font-family: 'Poppins', sans-serif;
                font-size: 1.1em;
                font-weight: 300;
                line-height: 1.7em;
                color: #999;
            }

            a,
            a:hover,
            a:focus {
                color: inherit;
                text-decoration: none;
                transition: all 0.3s;
            }

            .navbar {
                padding: 15px 10px;
                background: #fff;
                border: none;
                border-radius: 0;
                margin-bottom: 40px;
                box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
            }

            .navbar-btn {
                box-shadow: none;
                outline: none !important;
                border: none;
            }

            .line {
                width: 100%;
                height: 1px;
                border-bottom: 1px dashed #ddd;
                margin: 40px 0;
            }

            /* ---------------------------------------------------
            SIDEBAR STYLE
        ----------------------------------------------------- */

            .wrapper {
                display: flex;
                width: 100%;
                align-items: stretch;
            }

            #sidebar {
                min-width: 250px;
                max-width: 250px;
                background: #7386D5;
                color: #fff;
                transition: all 0.3s;
            }

            #sidebar.active {
                margin-left: -250px;
            }

            #sidebar .sidebar-header {
                padding: 20px;
                background: #6d7fcc;
            }

            #sidebar ul.components {
                padding: 20px 0;
                border-bottom: 1px solid #47748b;
            }

            #sidebar ul p {
                color: #fff;
                padding: 10px;
            }

            #sidebar ul li a {
                padding: 10px;
                font-size: 1.1em;
                display: block;
            }

            #sidebar ul li a:hover {
                color: #7386D5;
                background: #fff;
            }

            /* #sidebar ul li.active>a,
            a[aria-expanded="true"] {
                color: #fff;
                background: #6d7fcc;
            } */

            a[data-toggle="collapse"] {
                position: relative;
            }

            .dropdown-toggle::after {
                display: block;
                position: absolute;
                top: 50%;
                right: 20px;
                transform: translateY(-50%);
            }

            ul ul a {
                font-size: 0.9em !important;
                padding-left: 30px !important;
                /* background: #6d7fcc; */
            }

            ul.CTAs {
                padding: 20px;
            }

            ul.CTAs a {
                text-align: center;
                font-size: 0.9em !important;
                display: block;
                border-radius: 5px;
                margin-bottom: 5px;
            }

            a.download {
                background: #fff;
                color: #7386D5;
            }

            a.article,
            a.article:hover {
                background: #6d7fcc !important;
                color: #fff !important;
            }

            .active-tab {
                background: #fff !important;
                color: #6d7fcc !important;
            }

            /* ---------------------------------------------------
            CONTENT STYLE
        ----------------------------------------------------- */

            #content {
                width: 100%;
                padding: 20px;
                min-height: 100vh;
                transition: all 0.3s;
            }

            /* ---------------------------------------------------
            MEDIAQUERIES
        ----------------------------------------------------- */

            @media (max-width: 768px) {
                #sidebar {
                    margin-left: -250px;
                }

                #sidebar.active {
                    margin-left: 0;
                }

                #sidebarCollapse span {
                    display: none;
                }
            }
        </style>
    @endpush

    @if (Session::has('success'))
        @push('script')
            <script type="text/javascript">
                Swal.fire(
                    'Success!',
                    "{{ Session::get('success') }}",
                    'success'
                ).then(function() {
                    location.reload();
                });
            </script>
        @endpush
    @endif

    @if ($errors->any())
        <div>
            {{-- @dd($errors->all()) --}}
            @foreach ($errors->all() as $error)
                @push('script')
                    <script type="text/javascript">
                        Swal.fire(
                            'Warnning!',
                            "{{ $error }}",
                            'warning'
                        ).then(function() {
                            // location.reload();
                        });
                    </script>
                @endforeach

            </div>

        @endif



        @push('script')
            <script>
                $(document).ready(function() {
                    $('#sidebarCollapse').on('click', function() {
                        $('#sidebar').toggleClass('active');
                    });
                    $('.highcharts-credits').hide();
                });
            </script>
        @endpush

        {{-- @endpush --}}
        {{-- @yield('scripts') --}}
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
        <!-- Scripts -->

        <style type="text/css">
            .dropdown-menu {
                cursor: pointer;
            }

            .notification-icon:after {
            position: absolute;
            content: attr(data-count);
            margin-left: -6.8775px;
            margin-top: -6.8775px;
            padding: 0 4px;
            min-width: 13.755px;
            height: 13.755px;
            line-height: 13.755px;
            background: red;
            border-radius: 10px;
            color: #fff;
            text-align: center;
            vertical-align: middle;
            font-size: 11.004px;
            font-weight: 600;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif
        }
        </style>
    </head>

    <body>

        <div id="app">
           
            <div class="wrapper">
                <!-- Sidebar  -->
                <nav id="sidebar">
                    <div class="sidebar-header">
                        <a class="" href="{{ route('account.index') }}">
                            <h3>HRM</h3>
                        </a>
                    </div>
                    @php
                        // $menu_1 = [route('dashboard.index'),route('position.index')];
                    @endphp
                    <ul class="list-unstyled components">
      
                        <li class="active">
                            <a href="{{ route('home') }}"
                                @if (Request::routeIs('home')) class="active-tab" @endif><i class="bi bi-house-fill"></i>  หน้าแรก</a>
                               
                        </li>
                        <li class="active">
                            <a href="{{ route('calender') }}"
                                @if (Request::routeIs('calender')) class="active-tab" @endif><i class="bi bi-calendar-day"></i>  ปฏิทิน</a>
                               
                        </li>
                        <li class="active">
                            <a href="{{ route('leave.index') }}"
                                @if (Request::routeIs('leave.*')) class="active-tab" @endif><i class="bi bi-file-text-fill"></i>  จัดการใบลา</a>
                               
                        </li>
                        <li class="active">
                            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false"
                                class="dropdown-toggle"><i class="bi bi-kanban-fill"></i> จัดการ</a>
                            <ul class="collapse list-unstyled @if (Request::routeIs('account.*') || Request::routeIs('position.*') || Request::routeIs('leave-type.*')) show @endif"
                                id="homeSubmenu">
                                <li>
                                    {{-- @dd(Request::url() ,Request::routeIs('dashboard.*')) --}}
                                    <a href="{{ route('account.index') }}"
                                        @if (Request::routeIs('account.*')) class="active-tab" @endif><i class="bi bi-person-fill"></i>  จัดการผู้ใช้งาน</a>
                                </li>
                                <li>
                                    <a href="{{ route('position.index') }}"
                                        @if (Request::url() == route('position.index')) class="active-tab" @endif><i class="bi bi-tags-fill"></i>  จัดการตำแหน่ง</a>
                                </li>
                                <li>
                                    <a href="{{ route('leave-type.index') }}"
                                        @if (Request::routeIs('leave-type.*')) class="active-tab" @endif><i class="bi bi-calendar2-week-fill"></i>  จัดการประเภทการลา</a>
                                </li>
                                <li>
                                    <a href="{{ route('calendar-manage.index') }}"
                                        @if (Request::routeIs('calendar-manage.*')) class="active-tab" @endif><i class="bi bi-calendar-check-fill"></i>  จัดการตารางปฏิทิน</a>
                                </li>
                                {{-- <li>
                                <a href="#">Home 3</a>
                            </li> --}}
                            </ul>
                        </li>
                       
                    </ul>

                   
                </nav>

                <!-- Page Content  -->
                <div id="content">

                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <div class="container-fluid">

                            <button type="button" id="sidebarCollapse" class="btn btn-light">
                                <i class="fas fa-align-left"></i>
                                {{-- <span>Toggle Sidebar</span> --}}
                            </button>
                            <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button"
                                data-toggle="collapse" data-target="#navbarSupportedContent"
                                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <i class="fas fa-align-justify"></i>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav ms-auto">
                                    <!-- Authentication Links -->
                                    @guest
                                        @if (Route::has('login'))
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                            </li>
                                        @endif

                                        @if (Route::has('register'))
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                            </li>
                                        @endif
                                    @else
                                    <li class="dropdown dropdown-notifications mt-1" >
                                        <a href="#notifications-panel" class="" data-toggle="dropdown">
                                            <i data-count="0" class="fas fa-bell notification-icon mt-2 mr-3"></i>
                                        </a>
                    
                                        {{-- <div class="dropdown-container"> --}}

                                            <ul class="dropdown-menu" style="transform: translateX(-95%) !important; width: 290px;">
                                                {{-- <i class="fa fa-bell-o" aria-hidden="true"></i> --}}
                                            </ul>

                                        {{-- </div> --}}
                                    </li>
                                        <li class="nav-item ">
                                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#"
                                                role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false" v-pre>
                                                {{ Auth::user()->name }}
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                                <a class="dropdown-item" href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                                    {{ __('Logout') }}
                                                </a>

                                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                    class="d-none">
                                                    @csrf
                                                </form>
                                            </div>
                                        </li>
                                    @endguest
                                </ul>
                                
                            </div>
                        </div>
                    </nav>
                    

                    @yield('content')
                </div>
            </div>

            {{-- <main class=""> --}}
            {{-- @include('sidebar') --}}

            {{-- </main> --}}
        </div>
        {{-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script> --}}
    <script src="//js.pusher.com/3.1/pusher.min.js"></script>
        {{-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
         </script> --}}
        {{-- <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> --}}
        {{-- @push('script') --}}
        {{-- <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script> --}}
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        {{-- @endpush --}}

    <script type="text/javascript">
        var notificationsWrapper = $('.dropdown-notifications');
        var notificationsToggle = notificationsWrapper.find('a[data-toggle]');
        var notificationsCountElem = notificationsToggle.find('i[data-count]');
        var notificationsCount = parseInt(notificationsCountElem.data('count'));
        var notifications = notificationsWrapper.find('ul.dropdown-menu');

        if (notificationsCount <= 0) {
            // notificationsWrapper.hide();
            notifications.html('<p class="text-center no-noti" style="text-align: center;">ไม่มีการแจ้งเตือน</p>');
        }
        else{
            notifications.html('');
        }

        var pusher = new Pusher('e57746f590b42615e1bf', {
            encrypted: true,
            cluster: 'ap1'
        });

        // Subscribe to the channel we specified in our Laravel Event
        var channel = pusher.subscribe('status-liked');

        // Bind a function to a Event (the full Laravel class)
        channel.bind('App\\Events\\MessageSent', function(data) {
            
            var existingNotifications = notifications.html();

            var newNotificationHtml = `
            <a href="{{ route('leave.index') }}">
          <li class="notification active">
              <div class="media">
                <div class="media-left">
                  <div class="media-object">
                    <img src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%2250%22%20height%3D%2250%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%2050%2050%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_1854e547215%20text%20%7B%20fill%3A%23919191%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A10pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_1854e547215%22%3E%3Crect%20width%3D%2250%22%20height%3D%2250%22%20fill%3D%22%23cccccc%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%226.46875%22%20y%3D%2229.55999994277954%22%3E50x50%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" class="img-circle" alt="50x50" style="width: 50px; height: 50px;">
                  </div>
                </div>
                <div class="media-body ml-2">
                  <strong class="notification-title">` + data.message + `</strong>
                  <!--p class="notification-desc">Extra description can go here</p-->
                  <div class="notification-meta">
                    <small class="timestamp">about a minute ago</small>
                  </div>
                </div>
              </div>
          </li>
          </a>
        `;
        
            notifications.html(newNotificationHtml + existingNotifications);

            notificationsCount += 1;
            notificationsCountElem.attr('data-count', notificationsCount);
            notificationsWrapper.find('.notif-count').text(notificationsCount);
            notificationsWrapper.find('.no-noti').text('');
            notificationsWrapper.show();
        });
    </script>
        @stack('styles')
        @stack('script')
    </body>

    </html>

    

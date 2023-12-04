@extends('layouts.app')

@push('styles')
    <style>
        #calendar {
            /* height: 200px; */
            width: 1050px;
        }

        .fc-today {
            background-color: #c9d2f8 !important;
        }
    </style>
@endpush
@section('content')
    <!DOCTYPE html>
    {{-- <html> --}}

    <head>
        {{-- <title>Laravel Fullcalender Tutorial Tutorial - ItSolutionStuff.com</title> --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" /> --}}
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
        {{-- <script src='fullcalendar/lang-all.js'></script> --}}

        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

        <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/locale/th.js'></script>


    </head>

    {{-- <body> --}}

    {{-- <div class="container"> --}}
    {{-- <h1>Laravel FullCalender Tutorial Example - ItSolutionStuff.com</h1> --}}
    {{-- <div class="card" style="height:590px; width:720px; margin-left:20%;"> --}}
    {{-- <div class="card-body"> --}}
    {{-- <div id='container' class="justify-content-center align-items-center" style="height:100px; width:700px; margin-left:20%;"> --}}

    <div id='calendar' class="ml-5"></div>
    {{-- </div> --}}

    {{-- </div>   --}}
    {{-- </div> --}}

    <script>
        $(document).ready(function() {

            var SITEURL = "{{ url('/') }}";

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),

                }
            });

            var calendar = $('#calendar').fullCalendar({
                editable: false,
                events: SITEURL + "/calender",
                displayEventTime: false,
                eventColor: ['#7386D5'],
                eventTextColor: '#ffffff',
                // plugins: [ 'dayGrid', 'interaction' ],
                // eventDisplay: 'block',
                // showNonCurrentDates: false,
                eventLimit: true,
                locale: 'th',
                aspectRatio: 2,



                // editable: true,
                eventRender: function(event, element, view) {
                    // console.log(event);
                    if (event.allDay === 'true') {
                        event.allDay = true;
                    } else {
                        event.allDay = false;
                    }


                },

                selectable: true,
                selectHelper: true,

                // select: function(start, end, allDay) {
                //     var title = prompt('Event Title:');
                //     if (title) {
                //         var start = $.fullCalendar.formatDate(start, "Y-MM-DD");
                //         var end = $.fullCalendar.formatDate(end, "Y-MM-DD");
                //         $.ajax({
                //             url: SITEURL + "/fullcalenderAjax",
                //             data: {
                //                 title: title,
                //                 start: start,
                //                 end: end,
                //                 type: 'add'
                //             },
                //             type: "POST",
                //             success: function(data) {
                //                 displayMessage("Event Created Successfully");

                //                 calendar.fullCalendar('renderEvent', {
                //                     id: data.id,
                //                     title: title,
                //                     start: start,
                //                     end: end,
                //                     allDay: allDay
                //                 }, true);

                //                 calendar.fullCalendar('unselect');
                //             }
                //         });
                //     }
                // },
                // eventDrop: function(event, delta) {
                //     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
                //     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");

                //     $.ajax({
                //         url: SITEURL + '/fullcalenderAjax',
                //         data: {
                //             title: event.title,
                //             start: start,
                //             end: end,
                //             id: event.id,
                //             type: 'update'
                //         },
                //         type: "POST",
                //         success: function(response) {
                //             displayMessage("Event Updated Successfully");
                //         }
                //     });
                // },
                // eventClick: function(event) {
                //     var deleteMsg = confirm("Do you really want to delete?");
                //     if (deleteMsg) {
                //         $.ajax({
                //             type: "POST",
                //             url: SITEURL + '/fullcalenderAjax',
                //             data: {
                //                 id: event.id,
                //                 type: 'delete'
                //             },
                //             success: function(response) {
                //                 calendar.fullCalendar('removeEvents', event.id);
                //                 displayMessage("Event Deleted Successfully");
                //             }
                //         });
                //     }
                // }

            });

        });



        function displayMessage(message) {
            toastr.success(message, 'Event');
        }
    </script>

    {{-- </body> --}}

    {{-- </html> --}}
@endsection

@push('script')

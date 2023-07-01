<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Full Calendar js</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card card-calendar">

                        <!-- Card header -->
                        <div class="card-header mb-3">
                            <!-- Title -->
                            <div class="row">

                                <div class="col-8">
                                    <h5 class="h3 mb-0">Calendar</h5>
                                </div>
                                <div class="col-4">
                                <div class="clearfix">
                                    <div class="btn-group inline">
                                            <button class="btn btn-small text-white"
                                                style="background-color:#5e72e4">RDV</button>
                                            <button class="btn btn-small text-white"
                                                style="background-color:#172b4d">Relance</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <h6 class="fullcalendar-title h2 mb-0">Fullcalendar</h6> --}}
                            {{-- <button href="#" class="fullcalendar-btn-prev btn btn-sm btn-info">
                                    <i class="fas fa-angle-left"></i>
                                </button>
                                <button href="#" class="fullcalendar-btn-next btn btn-sm btn-info">
                                    <i class="fas fa-angle-right"></i>
                                </button>

                                <button href="#" class="btn btn-sm btn-info" data-calendar-view="month">Month</button>
                                <button href="#" class="btn btn-sm btn-info" data-calendar-view="basicWeek">Week</button>
                                <button href="#" class="btn btn-sm btn-info" data-calendar-view="basicDay">Day</button> --}}







                        </div>









                        <!-- Card body -->
                        <div class="card-body p-0">

                            <div class="calendar" data-toggle="calendar" id="calendar"></div>

                        </div>




                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var booking = @json($events);

            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today', // will normally be on the left. if RTL, will be on the right
                    center: 'title',
                    right: 'month  agendaWeek agendaDay'
                },
                events: booking,
                // selectable: true,
                // selectHelper: true,
                // select: function(start, end, allDays) {
                //     $('#bookingModal').modal('toggle');
                //     $('#saveBtn').click(function() {
                //         var title = $('#title').val();
                //         var color = $('#color').val();
                //         var start_date = moment(start).format('YYYY-MM-DD');
                //         var end_date = moment(end).format('YYYY-MM-DD');

                //         $.ajax({
                //             url: "{{ route('calendar.store') }}",
                //             type: "POST",
                //             dataType: 'json',
                //             data: {
                //                 title,
                //                 start_date,
                //                 end_date,
                //                 color,
                //             },
                //             success: function(response) {
                //                 $('#bookingModal').modal('hide')
                //                 $('#calendar').fullCalendar('renderEvent', {
                //                     'title': response.title,
                //                     'start': response.start,
                //                     'end': response.end,
                //                     'color': response.color
                //                 });
                //                 location.reload(true);
                //             },
                //             error: function(error) {
                //                 if (error.responseJSON.errors) {
                //                     $('#titleError').html(error.responseJSON.errors
                //                         .title);
                //                 }
                //             },
                //         });
                //         console.log(event.id);
                //     });
                // },
                // editable: true,
                // eventDrop: function(event) {
                //     var id = event.id;
                //     var start_date = moment(event.start).format('YYYY-MM-DD');
                //     var end_date = moment(event.end).format('YYYY-MM-DD');

                //     $.ajax({
                //         url: "{{ route('calendar.update', '') }}" + '/' + id,
                //         type: "PATCH",
                //         dataType: 'json',
                //         data: {
                //             id,
                //             start_date,
                //             end_date,
                //         },
                //         success: function(response) {
                //             new swal("Good job!", "Event Updated!", "success");
                //         },
                //         error: function(error) {
                //             console.log(error);
                //         },
                //     });
                // },
                // eventClick: function(event) {
                //     var id = event.id;
                //     const swalWithBootstrapButtons = Swal.mixin({
                //         customClass: {
                //             confirmButton: 'btn btn-success',
                //             cancelButton: 'btn btn-danger'
                //         },
                //         buttonsStyling: false
                //     })

                //     swalWithBootstrapButtons.fire({
                //         title: 'Are you sure?',
                //         text: "You won't be able to revert this!",
                //         icon: 'warning',
                //         showCancelButton: true,
                //         confirmButtonText: 'Yes, delete it!',
                //         cancelButtonText: 'No, cancel!',
                //         reverseButtons: true
                //     }).then((result) => {
                //         if (result.isConfirmed) {
                //             $.ajax({
                //                 url: "{{ route('calendar.destroy', '') }}" + '/' +
                //                     id,
                //                 type: "DELETE",
                //                 dataType: 'json',
                //                 success: function(response) {
                //                     $('#calendar').fullCalendar('removeEvents',
                //                         response);
                //                     swalWithBootstrapButtons.fire(
                //                         'Deleted!',
                //                         'Your RDV has been deleted.',
                //                         'success'
                //                     )
                //                 },
                //                 error: function(error) {
                //                     console.log(error)
                //                 },
                //             });

                //         } else if (
                //             /* Read more about handling dismissals below */
                //             result.dismiss === Swal.DismissReason.cancel
                //         ) {
                //             swalWithBootstrapButtons.fire(
                //                 'Cancelled',
                //                 'Your RDV still there',
                //                 'error'
                //             )
                //         }
                //     })

                // },
                // selectAllow: function(event) {
                //     return moment(event.start).utcOffset(false).isSame(moment(event.end).subtract(1,
                //         'second').utcOffset(false), 'day');
                // },




            });


            $("#bookingModal").on("hidden.bs.modal", function() {
                $('#saveBtn').unbind();
            });

            $('.fc-event').css('font-size', '15px');
            $('.fc-button-text-color').css('danger');
            $('.fc-button-bg-color').css('#fff');
            // $('.fc-event').css('text', '20px');
            // $('.fc-event').css('width', '20px');
            // $('.fc-event').css('border-radius', '10%');

            //   --fc-small-font-size: .85em;
            //   --fc-page-bg-color: #fff;
            //   --fc-neutral-bg-color: rgba(208, 208, 208, 0.3);
            //   --fc-neutral-text-color: #808080;
            //   --fc-border-color: #ddd;

            //   --fc-button-text-color: #fff;
            //   --fc-button-bg-color: #2C3E50;
            //   --fc-button-border-color: #2C3E50;
            //   --fc-button-hover-bg-color: #1e2b37;
            //   --fc-button-hover-border-color: #1a252f;
            //   --fc-button-active-bg-color: #1a252f;
            //   --fc-button-active-border-color: #151e27;

            //   --fc-event-bg-color: #3788d8;
            //   --fc-event-border-color: #3788d8;
            //   --fc-event-text-color: #fff;
            //   --fc-event-selected-overlay-color: rgba(0, 0, 0, 0.25);

            //   --fc-more-link-bg-color: #d0d0d0;
            //   --fc-more-link-text-color: inherit;

            //   --fc-event-resizer-thickness: 8px;
            //   --fc-event-resizer-dot-total-width: 8px;
            //   --fc-event-resizer-dot-border-width: 1px;

            //   --fc-non-business-color: rgba(215, 215, 215, 0.3);
            //   --fc-bg-event-color: rgb(143, 223, 130);
            //   --fc-bg-event-opacity: 0.3;
            //   --fc-highlight-color: rgba(188, 232, 241, 0.3);
            //   --fc-today-bg-color: rgba(255, 220, 40, 0.15);
            //   --fc-now-indicator-color: red;
        });
    </script>
</body>

</html>

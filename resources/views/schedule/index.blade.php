@extends('layouts.master')

@section('main')

    <style>
        #myImg {
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        #myImg:hover {
            opacity: 0.7;
        }

        /* The Modal (background) */
        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            padding-top: 100px;
            /* Location of the box */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.9);
            /* Black w/ opacity */
        }

        /* Modal Content (Image) */
        .modal-content {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
        }

        /* Caption of Modal Image (Image Text) - Same Width as the Image */
        #caption {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
            text-align: center;
            color: #ccc;
            padding: 10px 0;
            height: 150px;
        }

        /* Add Animation - Zoom in the Modal */
        .modal-content,
        #caption {
            animation-name: zoom;
            animation-duration: 0.6s;
        }

        @keyframes zoom {
            from {
                transform: scale(0)
            }

            to {
                transform: scale(1)
            }
        }

        /* The Close Button */
        .close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
        }

        .close:hover,
        .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }

        /* 100% Image Width on Smaller Screens */
        @media only screen and (max-width: 700px) {
            .modal-content {
                width: 100%;
            }
        }

    </style>

    <div id="myModal" class="modal">

        <!-- The Close Button -->
        <span class="close">&times;</span>

        <!-- Modal Content (The Image) -->
        <img class="modal-content" id="img01">

        <!-- Modal Caption (Image Text) -->
        <div id="caption"></div>
    </div>

    <section>
        <div class="container-fluid">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert    ">
                    <button type="button" class="close" data-dismiss="alert" aria-label="close">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">SCHEDULES</h6>
                </div>
                <div class="card-body">
                    @hasrole('admin')
                        <a href="{{ route('schedule.create') }}" class="btn btn-primary float-right btn-sm mb-3"
                            data-bs-toggle="modal" data-bs-target="#addSchedule">+ Add Schedule</a>
                    @endhasrole
                    <div class="table-responsive">
                        <table class="table table-striped datatables" style="font-size:13px;" id="dataTable" width="100%"
                            cellspacing="0">
                            <thead style="font-size: 13px;">
                                <tr>
                                    <th> ID </th>
                                    <th> Task Title </th>
                                    <th> Description </th>
                                    <th> AssignTo </th>
                                    <th> Start Time </th>
                                    <th> End Time </th>
                                    <th> Status </th>
                                    <th> Bukti </th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $serial = 1;
                                @endphp
                                @hasrole('user')
                                    @foreach ($data as $schedule)
                                        <tr>
                                            <td>{{ $serial++ }}</td>
                                            <td>{{ $schedule->task_title }}</td>
                                            <td>{{ $schedule->task_description }}</td>
                                            <td>{{ $schedule->user->name }}</td>
                                            <td>{{ $schedule->start_time }}</td>
                                            <td>{{ $schedule->end_time }}</td>
                                            <td>
                                                @if ($schedule['status'] == 'On Progress')
                                                    <span class='badge badge-warning'>{{ $schedule->status }}</span>
                                                @elseif ($schedule['status'] == 'Completed')
                                                    <span class='badge badge-success'>{{ $schedule->status }}</span>
                                                @elseif ($schedule['status'] == 'Incompleted')
                                                    <span class='badge badge-danger'>{{ $schedule->status }}</span>
                                                @endif
                                            </td>
                                            <td><img id="myImg" src="{{ asset('bukti/' . $schedule->upload_bukti) }}" alt=""
                                                    style="width: 50px;"></td>
                                            <td>
                                                @if ($schedule['status'] == 'On Progress')
                                                    <a href="{{ route('schedule.editUser', $schedule->id) }}"
                                                        class="btn btn-warning btn-sm"><i class="fas fa-edit"
                                                            title="Edit"></i></a>
                                                @elseif($schedule['status'] == 'Incompleted')
                                                    <i class="fas fa-times"
                                                        style="font-size: 30px; color:#e74a3b; align-items:center"
                                                        title="Incompleted"></i>
                                                @elseif($schedule['status'] == 'Completed')
                                                    <i class="fas fa-check"
                                                        style="font-size: 30px; color:#1cc88a; align-items:center"
                                                        title="Completed"></i>
                                                @endif

                                                @hasrole('admin')
                                                    <a href="#" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure you want to delete this Users?')"><i
                                                            class="fas fa-trash"></i></a>
                                                @endhasrole
                                            </td>
                                        </tr>
                                    @endforeach
                                @endhasrole

                                @hasrole('admin')
                                    @foreach ($dataadmin as $schedule)
                                        <tr>
                                            <td>{{ $serial++ }}</td>
                                            <td>{{ $schedule->task_title }}</td>
                                            <td>{{ $schedule->task_description }}</td>
                                            <td>{{ $schedule->user->name }}</td>
                                            <td>{{ $schedule->start_time }}</td>
                                            <td>{{ $schedule->end_time }}</td>
                                            <td>
                                                @if ($schedule['status'] == 'On Progress')
                                                    <span class='badge badge-warning'>{{ $schedule->status }}</span>
                                                @elseif ($schedule['status'] == 'Completed')
                                                    <span class='badge badge-success'>{{ $schedule->status }}</span>
                                                @elseif ($schedule['status'] == 'Incompleted')
                                                    <span class='badge badge-danger'>{{ $schedule->status }}</span>
                                                @endif
                                            </td>
                                            <td><img id="myImg" src="{{ asset('bukti/' . $schedule->upload_bukti) }}" alt=""
                                                    style="width: 50px;"></td>
                                            <td>
                                                <a href="{{ route('schedule.edit', $schedule->id) }}"
                                                    class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                                                <a href="{{ route('schedule.delete', $schedule->id) }}"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure you want to delete this Users?')"><i
                                                        class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endhasrole
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

        </div>

        <script type="text/javascript">
            // Get the modal
            var modal = document.getElementById("myModal");

            // Get the image and insert it inside the modal - use its "alt" text as a caption
            var img = document.getElementById("myImg");
            var modalImg = document.getElementById("img01");
            var captionText = document.getElementById("caption");
            img.onclick = function() {
                modal.style.display = "block";
                modalImg.src = this.src;
                captionText.innerHTML = this.alt;
            }

            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];

            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
                modal.style.display = "none";
            }
        </script>
    </section>
@endsection

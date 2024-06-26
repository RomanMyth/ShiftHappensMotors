<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="css/app.css" type="text/css">
</head>

<style>

    body{
        background-color: #f8f9fa;

    }

    .container {
            max-width: 1200px;
        }
        .table-responsive {
            overflow-x: auto;
        }
        .table {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .table th, .table td {
            vertical-align: middle;
            text-align: center;
            /* font-size: 14px; */
        }
        .table th {
            background-color: black;
            color: #fff;
        }
        .table-hover tbody tr:hover {
            background-color: #e9ecef;
            cursor: pointer;
        }
        .modal-content {
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            color: #343a40;
        }

        .modal-header {
            background-color: #343a40;
            color: #fff;
            border-radius: 10px 10px 0 0;
        }
        .modal-title {
            font-weight: bold;
        }
        .modal-body p {
            margin-bottom: 10px;
        }

        #monthFilter {
        width: 25%;
        max-width: 150px; /* Limiting maximum width for better responsiveness */
        }

        #showAllAppointmentsBtn {
            margin-bottom: 20px;
        }
        

    .confirmation-dialog {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.confirmation-dialog p {
    margin-bottom: 10px;
}

.confirmation-dialog button {
    margin-right: 10px;
    cursor: pointer;
    background-color: black;
    border-color: black;
    color: #fff;
    /* Apply the same padding and font properties as .btn-primary */
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    line-height: 1.5;
    font-weight: 400;
    text-align: center;
    text-decoration: none;
    vertical-align: middle;
    border-radius: 0.25rem;
    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    min-width: 54.1px;
}

.confirmation-dialog button:hover {
    background-color: #0056b3;
    border-color: #0056b3;
}

.confirmation-dialog button:focus {
    /* box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.5); */
}

.confirmation-dialog button:last-child {
    margin-right: 0;
}

.header2 {
    font-weight: bold;
}

.modal-header {
    background-color: black;
}

.black-style{
    background-color: black !important;
    border: none !important;
    color: white;
    font-weight: bold !important;
}


</style>

</head>
<body class="viewMaintenanceSchedule">

    <div id="confirmation-dialog" class="confirmation-dialog">
        <p>Are you sure you want to delete this appointment?</p>
        <button id="confirm-delete">Yes</button>
        <button id="cancel-delete">No</button>
    </div>


    <x-navbar>
    </x-navbar>

    <div class="container mt-3">
        <h2 class="maintenanceHeader">Maintenance Schedule</h2>


        <form id="searchForm" action="{{ route('search.appointments') }}" method="GET">
            @csrf
            <div class="input-group mb-3">
                <input type="text" name="query" class="form-control" placeholder="Search appointments by email, phone, or instructions...">
                <button class="btn btn-primary btn-block black-style" type="submit">Search</button>
            </div>
        </form>

        <form action="{{ route('viewSchedule.maintenance') }}" method="GET" id="reload">
            <button id="showAllAppointmentsBtn" class="btn btn-primary btn-block black-style" type="submit">Show all appointments</button>
        </form>

        <p>Filter by month</p>
        <div class="input-group mb-3">
            <select id="monthFilter" class="form-select">
                <option value="">Select Month</option>
                @foreach(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $month)
                    <option value="{{ $month }}">{{ $month }}</option>
                @endforeach
            </select>
        </div>


        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th class="black-style">Email</th>
                        <th class="black-style">Phone Number</th>
                        <th class="black-style">Date</th>
                        <th class="black-style">Time</th>
                        <th class="black-style">Instructions</th>
                    </tr>
                </thead>
                <tbody>
                    @if($appointments->isEmpty())
                        <tr>
                            <td colspan="5" class="text-center">No appointments found.</td>
                        </tr>
                    @else
                        @foreach($appointments as $appointment)
                            <tr data-bs-toggle="modal" data-bs-target="#appointmentModal{{ $appointment->Appointment_ID }}">
                                <td>{{ $appointment->email }}</td>
                                <td>{{ $appointment->phoneNumber }}</td>
                                <td>{{ \Carbon\Carbon::parse($appointment->date)->format('F j, Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($appointment->apptTime)->format('h:i A') }}</td>
                                <td>{{ $appointment->maintenanceInstruction }}</td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="appointmentModal{{ $appointment->Appointment_ID }}" tabindex="-1" aria-labelledby="appointmentModalLabel{{ $appointment->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="appointmentModalLabel{{ $appointment->Apointment_ID }}">Appointment Details</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div id="modalBody" class="modal-body">
                                            <p><strong>Email:</strong> {{ $appointment->email }}</p>
                                            <p><strong>Phone Number:</strong> {{ $appointment->phoneNumber }}</p>
                                            <p><strong>Vehicle VIN:</strong> {{ $appointment->vin }}</p>
                                            <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($appointment->date)->format('F j, Y') }}</p>
                                            <p><strong>Time:</strong> {{ \Carbon\Carbon::parse($appointment->apptTime)->format('h:i A') }}</p>
                                            <p><strong>Make:</strong> {{ $appointment->make }}</p>
                                            <p><strong>Model:</strong> {{ $appointment->model }}</p>
                                            <p><strong>Year:</strong> {{ $appointment->year }}</p>
                                            <p><strong>Instructions:</strong> {{ $appointment->maintenanceInstruction }}</p>
                                            <button id="modalDeleteBtn" class="btn btn-primary btn-block black-style" onclick="deleteAppointment({{ $appointment->Appointment_ID }})">Delete Appointment</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $('#monthFilter').change(function() {

                var selectedMonth = $(this).val();
                console.log("Selected Month:", selectedMonth); // Log selected month
                if (selectedMonth !== '') {
                    $.ajax({
                        url: "{{ route('filter.appointments.by.month') }}",
                        method: 'GET',
                        data: {
                            month: selectedMonth
                        },
                        success: function(response) {
                            console.log("Response:", response); // Log response
                            var appointments = response.appointments;
                            if (appointments.length > 0) {
                                // Clear existing table rows
                                $('tbody').empty();
                                // Append new rows with appointment data
                                appointments.forEach(function(appointment) {
                                    var row = '<tr data-bs-toggle="modal" data-bs-target="#appointmentModal' + appointment.Appointment_ID + '">' +
                                        '<td>' + appointment.email + '</td>' +
                                        '<td>' + appointment.phoneNumber + '</td>' +
                                        '<td>' + formatDate(appointment.date) + '</td>' +
                                        '<td>' + formatTime(appointment.apptTime) + '</td>' +
                                        '<td>' + appointment.maintenanceInstruction + '</td>' +
                                        '</tr>';
                                    $('tbody').append(row);
                                });
                            } else {
                                // Handle case when no appointments are found
                                $('tbody').html('<tr><td colspan="5" class="text-center">No appointments found.</td></tr>');
                            }
                        },
                        error: function(xhr, status, error) {
                            // Handle errors
                            console.error(xhr.responseText);
                        }
                    });
                }
                else{
                    $("#reload").submit();
                }
            });
        });


//         function deleteAppointment(appointmentId) {
//     var confirmationDialog = document.getElementById('confirmation-dialog');
//     confirmationDialog.style.display = 'block';

//     var confirmDeleteBtn = document.getElementById('confirm-delete');
//     var cancelDeleteBtn = document.getElementById('cancel-delete');

//     confirmDeleteBtn.onclick = function() {
//         $.ajax({
//             url: "{{ route('delete.appointment') }}",
//             method: 'DELETE',
//             data: {
//                 _token: "{{ csrf_token() }}",
//                 Appointment_ID: appointmentId // Using Appointment_ID here
//             },
//             success: function(response) {
//                 // Refresh the page or update the table after successful deletion
//                 location.reload(); // You can change this to update the table without refreshing the page
//             },
//             error: function(xhr, status, error) {
//                 console.error(xhr.responseText);
//                 // Handle errors if any
//             }
//         });
//         confirmationDialog.style.display = 'none';
//     };

//     cancelDeleteBtn.onclick = function() {
//         confirmationDialog.style.display = 'none';
//     };



// }

function deleteAppointment(appointmentId) {
        // Hide the appointment modal
        var appointmentModal = document.getElementById('appointmentModal' + appointmentId);
        $(appointmentModal).modal('hide');
        $('.modal-backdrop').remove();

        var confirmationDialog = document.getElementById('confirmation-dialog');
        $("#confirmation-dialog").show();

        var confirmDeleteBtn = document.getElementById('confirm-delete');
        var cancelDeleteBtn = document.getElementById('cancel-delete');

        confirmDeleteBtn.onclick = function() {
            $.ajax({
                url: "{{ route('delete.appointment') }}",
                method: 'DELETE',
                data: {
                    _token: "{{ csrf_token() }}",
                    Appointment_ID: appointmentId // Using Appointment_ID here
                },
                success: function(response) {
                    // Refresh the page or update the table after successful deletion
                    location.reload(); // You can change this to update the table without refreshing the page
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    // Handle errors if any
                }
            });
            $("#confirmation-dialog").hide();
        };

        cancelDeleteBtn.onclick = function() {
            $("#confirmation-dialog").hide();
        };
    }


    //     function deleteAppointment(appointmentId) {
    //     if (confirm("Are you sure you want to delete this appointment?")) {
    //         console.log(appointmentId);
    //         $.ajax({
    //             url: "{{ route('delete.appointment') }}",
    //             method: 'DELETE',
    //             data: {
    //                 _token: "{{ csrf_token() }}",
    //                 Appointment_ID: appointmentId // Using Appointment_ID here
    //             },
    //             success: function(response) {
    //                 alert("Deleted Successfully!");
    //                 // Refresh the page or update the table after successful deletion
    //                 location.reload(); // You can change this to update the table without refreshing the page
    //             },
    //             error: function(xhr, status, error) {
    //                 console.error(xhr.responseText);
    //                 // Handle errors if any
    //             }
    //         });
    //     }
    // }



        // Function to format date (assuming 'Y-m-d' format)
        function formatDate(dateString) {
            var date = new Date(dateString);
            return date.toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
        }

        // Function to format time (assuming 'H:i:s' format)
        function formatTime(timeString) {
        var timeParts = timeString.split(':');
        var hours = parseInt(timeParts[0], 10);
        var minutes = timeParts[1];
        var ampm = hours >= 12 ? 'PM' : 'AM';
        hours = hours % 12;
        hours = hours ? hours : 12; // Handle midnight (0 hours)
        return hours + ':' + minutes + ' ' + ampm;
    }





    </script>


</body>
</html>

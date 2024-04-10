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
            background-color: #007bff;
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

        .pagination {
        justify-content: center;
        }

        .pagination > li > a,
        .pagination > li > span {
        margin: 0 5px; /* Adjust the margin as needed */
        }


</style>

</head>
<body class="viewMaintenanceSchedule">

    <x-navbar>
    </x-navbar>

    <div class="container mt-3">
        <h2>Maintenance Schedule</h2>


        <form id="searchForm" action="{{ route('search.appointments') }}" method="GET">
            @csrf
            <div class="input-group mb-3">
                <input type="text" name="query" class="form-control" placeholder="Search appointments by email, phone, or instructions...">
                <button class="btn btn-primary btn-block" type="submit">Search</button>
            </div>
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
            <table class="table table-hover table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Instructions</th>
                    </tr>
                </thead>
                <tbody>
                    @if($appointments->isEmpty())
                        <tr>
                            <td colspan="5" class="text-center">No appointments found.</td>
                        </tr>
                    @else
                        @foreach($appointments as $appointment)
                            <tr data-bs-toggle="modal" data-bs-target="#appointmentModal{{ $appointment->id }}">
                                <td>{{ $appointment->email }}</td>
                                <td>{{ $appointment->phoneNumber }}</td>
                                <td>{{ \Carbon\Carbon::parse($appointment->date)->format('F j, Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($appointment->apptTime)->format('h:i A') }}</td>
                                <td>{{ $appointment->maintenanceInstruction }}</td>
                                <td>
                                    <!-- Delete button -->
                                    <button class="btn btn-primary btn-block" onclick="deleteAppointment({{ $appointment->id }})">Delete</button>
                                </td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="appointmentModal{{ $appointment->id }}" tabindex="-1" aria-labelledby="appointmentModalLabel{{ $appointment->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="appointmentModalLabel{{ $appointment->id }}">Appointment Details</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Email:</strong> {{ $appointment->email }}</p>
                                            <p><strong>Phone Number:</strong> {{ $appointment->phoneNumber }}</p>
                                            <p><strong>Vehicle VIN:</strong> {{ $appointment->vin }}</p>
                                            <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($appointment->date)->format('F j, Y') }}</p>
                                            <p><strong>Time:</strong> {{ \Carbon\Carbon::parse($appointment->apptTime)->format('h:i A') }}</p>
                                            <p><strong>Make:</strong> {{ $appointment->make }}</p>
                                            <p><strong>Model:</strong> {{ $appointment->model }}</p>
                                            <p><strong>Year:</strong> {{ $appointment->year }}</p>
                                            <p><strong>Instructions:</strong> {{ $appointment->maintenanceInstruction }}</p>
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
            });
        });



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

    function deleteAppointment(appointmentId) {
    if (confirm("Are you sure you want to delete this appointment?")) {
        $.ajax({
            url: "{{ url('/appointments') }}/" + appointmentId,
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                alert(response.message);
                location.reload(); // Reload the page after successful deletion
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
                alert("An error occurred while deleting the appointment.");
            }
        });
    }
}

    </script>


</body>
</html>

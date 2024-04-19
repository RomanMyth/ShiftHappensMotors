<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="css/app.css" type="text/css">
</head>
<body class="maintenance">
    <x-navbar>
    </x-navbar>
    
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">Schedule Maintenance</h3>
                        <form action="/storeAppointment" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="email"  class="form-label">Email Address</label>
                                <input required type="email" name="email" class="form-control" id="email" placeholder="Enter your Email Address">
                            </div>
                            <div class="mb-3">
                                <label for="phoneNumber" class="form-label">Phone Number</label>
                                <input required ="text" name="phoneNumber" class="form-control" id="phoneNumber" placeholder="Enter your Phone Number">
                            </div>
                            <div class="mb-3">
                                <label for="vin"  class="form-label">Vehicle VIN Number</label>
                                <input required ="text" name="vin" class="form-control" id="vin" placeholder="Enter your Vehicle's VIN">
                            </div>
                            <div class="mb-3">
                                <label for="make" class="form-label">Make</label>
                                <input required ="text" name="make" class="form-control" id="make" placeholder="Enter your Vehicle's Make">
                            </div>
                            <div class="mb-3">
                                <label for="model" class="form-label">Model</label>
                                <input required ="text" name="model" class="form-control" id="model" placeholder="Enter your Vehicle's Model">
                            </div>
                            <div class="mb-3">
                                <label for="year" class="form-label">Year</label>
                                <input required type="text" name="year" class="form-control" id="year" placeholder="Enter your Vehicle's Year">
                            </div>
                            <div class="mb-3">
                                <label for="appointmentDate" class="form-label">Booking Date</label>
                                <div class="input-group">
                                    <input required ="text" name="date" class="form-control" id="appointmentDate" placeholder="Select the Appointment Date">
                                    <button type="button" class="btn btn-outline-secondary" id="datepickerTrigger"><i class="bi bi-calendar"></i></button>
                                </div>
                                <p>Grayed-out date indicates the date is unavailable</p>
                            </div>
                            <div class="mb-3">
                                <label for="appointmentTime" class="form-label">Booking Time</label>
                                <select required name="apptTime" class="form-control" id="appointmentTime">
                                    <option value="09:00:00">9:00 AM</option>
                                    <option value="11:00:00">11:00 AM</option>
                                    <option value="13:00:00">1:00 PM</option>
                                    <option value="15:00:00">3:00 PM</option>
                                    <option value="17:00:00">5:00 PM</option>
                                    <!-- Add other available time options -->
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="message" class="form-label">What are you looking to get done?</label>
                                <textarea required name="maintenanceInstruction" class="form-control" id="message" rows="3" placeholder="What maintenance can we perform on your vehicle? "></textarea>
                            </div>
                            <button id = "submitbtn" type="submit" class="btn btn-primary btn-block">Schedule Your Appointment</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>


$(document).ready(function () {
    // Initialize datepicker
    $('#appointmentDate').datepicker({
        minDate: '+5d', // Set minimum date to 5 days in the future
        beforeShowDay: function (date) {
            var currentDate = new Date();
            currentDate.setDate(currentDate.getDate() - 1); // Yesterday's date to include today as selectable
            var minDate = new Date();
            minDate.setDate(minDate.getDate() + 4); // Set minimum date to 5 days in the future (4 + today)

            // Disable dates that are in the past or less than 5 days in the future
            if (date <= currentDate || date <= minDate) {
                return [false, 'unavailable', 'Unavailable']; // Disable these days and add 'unavailable' class
            } else {
                var dateString = $.datepicker.formatDate('yy-mm-dd', date);
                var disabled = false;
                // Fetch appointment count for the date
                $.ajax({
                    url: "/getAppointmentCount",
                    method: "GET",
                    async: false, // Synchronous request to ensure the function waits for the response
                    data: { date: dateString },
                    success: function (data) {
                        if (data.count >= 5) {
                            disabled = true; // If maximum appointments reached, disable the date
                        }
                    }
                });
                if (disabled) {
                    return [false, 'unavailable', 'Maximum appointments reached']; // Disable the date
                } else {
                    return [true]; // Enable the date
                }
            }
        },
        onSelect: function (selectedDate) {
            // Fetch and update available appointment times
            updateAvailableTimes(selectedDate);
        }
    });

    // Function to fetch and update available appointment times based on the selected date
    function updateAvailableTimes(selectedDate) {
        $.get("/getAvailableTimes?date=" + selectedDate, function (data) {
            // Reset the dropdown menu
            $('#appointmentTime').empty();
            // Add available times as options to the dropdown menu
            $.each(data, function (index, time) {
                if (time.available) {
                    $('#appointmentTime').append($('<option>', {
                        value: time.value,
                        text: time.label
                    }));
                }
            });
        });
    }

    // Function to show datepicker when the trigger button is clicked
    $('#datepickerTrigger').on('click', function () {
        $('#appointmentDate').datepicker('show');
    });

    // Disable selected appointment time for the selected date
    $('#appointmentTime').on('change', function () {
        var selectedDate = $('#appointmentDate').val();
        var selectedTime = $(this).val();

        if (selectedDate && selectedTime) {
            $.post("/markTimeUnavailable", { date: selectedDate, time: selectedTime }, function () {
                // After successfully marking the time as unavailable, update available times
                updateAvailableTimes(selectedDate);
            });
        }
    });

    // Update available appointment times when the page loads
    updateAvailableTimes($('#appointmentDate').val());

    $('form').submit(function (event) {
            event.preventDefault(); // Prevent default form submission

            var formData = $(this).serialize(); // Serialize form data
            $.post("/storeAppointment", formData, function (response) {
                // Show success message
                alert("Appointment created successfully!");
                // Redirect to home page
                window.location.href = "/";
            }).fail(function (xhr) {
                // Handle error responses
                alert(xhr.responseJSON.message);
            });
        });

        // Clear input fields after page reload
        $(window).on('load', function () {
            $('input[type="text"], input[type="email"], textarea').val('');
            $('#appointmentTime').prop('selectedIndex', 0); // Reset dropdown selection
        });
});



    </script>

</body>
</html>

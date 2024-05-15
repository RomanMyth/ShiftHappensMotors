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

    <script>
        $(document).ready(function () {
            var appointments = <?php echo json_encode($appointments); ?>;

            Date.prototype.addDays = function(days) {
                var date = new Date(this.valueOf());
                date.setDate(date.getDate() + days);
                return date;
            }

            function getDates(startDate, stopDate) {
                var dateArray = new Array();
                var currentDate = startDate;
                while (currentDate <= stopDate) {
                    dateArray.push(new Date (currentDate).toISOString().split('T')[0]);
                    currentDate = currentDate.addDays(1);
                }
                return dateArray;
            }

            var now = new Date();

            var dates = getDates(now, new Date(now.getFullYear(), now.getMonth(), now.getDate()+30));
            
            var appointments = <?php echo json_encode($appointments); ?>;

            for(var i = 0; i < appointments.length; i++){
                appointments[i].date = appointments[i].date.split(" ")[0];
            }

            apptTimeCount = {};


            //Initialize datepicker
            $('#appointmentDate').datepicker({
                minDate: '+5d', // Set minimum date to 5 days in the future
                beforeShowDay: function (date) {
                    var currentDate = new Date();
                    currentDate.setDate(currentDate.getDate() - 1); // Yesterday's date to include today as selectable

                    var minDate = new Date();
                    minDate.setDate(minDate.getDate() + 4); // Set minimum date to 5 days in the future (4 + today)

                    var maxDate = new Date();
                    maxDate.setDate(maxDate.getDate() + 30);

                    // Disable dates that are in the past or less than 5 days in the future
                    if (date <= currentDate || date <= minDate || date >= maxDate) {
                        return [false, 'unavailable', 'Unavailable']; // Disable these days and add 'unavailable' class
                    } else {
                        var dateString = $.datepicker.formatDate('yy-mm-dd', date);
                        var disabled = false;

                        if(appointments.length != 0){
                            var times = [];

                            for(var i = 0; i < appointments.length; i++){
                                var count = 0;
                                for(var j = 0; j < appointments.length; j++){
                                    if(appointments[j].date.split(" ")[0] == appointments[i].date.split(" ")[0]){
                                        count++;
                                    }                                 
                                }

                                if(count == 5){
                                    times.push(appointments[i].date.split(" ")[0]);
                                }
                            }
                            return [times.indexOf(dateString) == -1];
                        }

                        if (disabled) {
                            return [false, 'unavailable', 'Maximum appointments reached']; // Disable the date
                        } else {
                            return [true]; // Enable the date
                        }
                    }
                },
            });

            // Function to show datepicker when the trigger button is clicked
            $('#datepickerTrigger').on('click', function () {
                $('#appointmentDate').datepicker('show');
            });

            $("#appointmentDate").on('change', function(){

                //var times = [];
                $("#appointmentTime option[value='09:00:00']").attr('disabled', false);
                $("#appointmentTime option[value='11:00:00']").attr('disabled', false);
                $("#appointmentTime option[value='13:00:00']").attr('disabled', false);
                $("#appointmentTime option[value='15:00:00']").attr('disabled', false);
                $("#appointmentTime option[value='17:00:00']").attr('disabled', false);

                var selectedDate = $('#appointmentDate').val();
                var selectedDate = selectedDate.slice(6, 10) + "-" + selectedDate.slice(0, 2) + "-" + selectedDate.slice(3, 5);
            
                
                for(var i = 0; i < appointments.length; i++){
                    console.log(appointments[i].date.split(" ")[0]);
                    
                    if(selectedDate == appointments[i].date.split(" ")[0]){
                        console.log(appointments[i].apptTime.slice(0, 8));
                        $("#appointmentTime option[value='" + appointments[i].apptTime.slice(0, 8) + "']").attr('disabled', true);
                    }
                    
                }
            });

            // Disable selected appointment time for the selected date
            $('#appointmentTime').on('change', function () {
                var selectedDate = $('#appointmentDate').val();
                var selectedTime = $(this).val();

                $("#timeAlert").hide();
            });

            $('form').submit(function (event) {
                event.preventDefault(); // Prevent default form submission

                if($("#appointmentTime").val()==null){
                    $("#timeAlert").show();
                    return;
                }

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

    <style>
        input[type="text"],
        input[type="email"], {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #000;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: white;
            color: #000;
            border: 1px solid black;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        input[type="text"]:hover,
        input[type="email"]:hover,
        textarea:hover {
            border-color: #007bff; /* Change border color on hover */
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        textarea:focus {
            border-color: #007bff; /* Change border color on focus */
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); /* Add box shadow on focus */
        }

        #submitBtn {
            font-weight: bold;
        }

        ::placeholder {
            font-style: italic;

        }

        #messageLabel:hover, #message:hover, #appointmentTime:hover {
            border-color: #007bff; /* Change border color on hover */
        }

        #messageLabel:focus, #message:focus, #appointmentTime:focus {
            border-color: #007bff; /* Change border color on focus */
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5); /* Add box shadow on focus */
        }
        #datepickerTrigger{
            margin-bottom: 20px;
        }


    </style>
</head>
<body class="maintenance">


    <x-navbar>
    </x-navbar>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">Schedule Maintenance</h2>
                        <form action="/storeAppointment" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="email"  class="form-label">Email Address:</label>
                                <input required type="email" name="email" class="form-control" id="email" placeholder="Enter your Email Address">
                            </div>
                            <div class="mb-3">
                                <label for="phoneNumber" class="form-label">Phone Number:</label>
                                <input required type="text" name="phoneNumber" class="form-control" id="phoneNumber" placeholder="Enter your Phone Number">
                            </div>
                            <div class="mb-3">
                                <label for="vin"  class="form-label">Vehicle VIN Number:</label>
                                <input required type="text" name="vin" class="form-control" id="vin" placeholder="Enter your Vehicle's VIN">
                            </div>
                            <div class="mb-3">
                                <label for="make" class="form-label">Make:</label>
                                <input required type="text" name="make" class="form-control" id="make" placeholder="Enter your Vehicle's Make">
                            </div>
                            <div class="mb-3">
                                <label for="model" class="form-label">Model:</label>
                                <input required type="text" name="model" class="form-control" id="model" placeholder="Enter your Vehicle's Model">
                            </div>
                            <div class="mb-3">
                                <label for="year" class="form-label">Year:</label>
                                <input required type="text" name="year" class="form-control" id="year" placeholder="Enter your Vehicle's Year">
                            </div>
                            <div class="mb-3">
                                <label for="appointmentDate" class="form-label">Booking Date:</label>
                                <div class="input-group">
                                    <input required type="text" name="date" class="form-control" id="appointmentDate" placeholder="Select the Appointment Date">
                                    <button type="button" class="btn btn-outline-secondary" id="datepickerTrigger"><i class="bi bi-calendar"></i></button>
                                </div>
                                <p>Grayed-out date indicates the date is unavailable</p>
                            </div>
                            <div class="mb-3">
                                <label for="appointmentTime" class="form-label">Booking Time:</label>
                                <select required name="apptTime" class="form-control" id="appointmentTime">
                                    <option value="09:00:00">9:00 AM</option>
                                    <option value="11:00:00">11:00 AM</option>
                                    <option value="13:00:00">1:00 PM</option>
                                    <option value="15:00:00">3:00 PM</option>
                                    <option value="17:00:00">5:00 PM</option>
                                    <!-- Add other available time options -->
                                </select>
                                <div id="timeAlert" class="alert alert-danger alert-dismissible" style="display: none">
                                    It looks like this time is <strong>Unavaible</strong>. Please choose a different Time.
                                </div>
                            </div>

                            <div class="mb-3">
                                <label id="messageLabel" for="message" class="form-label">What are you looking to get done?</label>
                                <textarea required name="maintenanceInstruction" class="form-control" id="message" rows="3" placeholder="What maintenance can we perform on your vehicle? "></textarea>
                            </div>
                            <button id = "submitBtn" type="submit" class="btn btn-primary btn-block">Schedule Your Appointment</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>
</html>

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
<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">Schedule Maintenance</h3>
                        <form>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter your Email Address">
                            </div>
                            <div class="mb-3">
                                <label for="phoneNumber" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" id="phoneNumber" placeholder="Enter your Phone Number">
                            </div>
                            <div class="mb-3">
                                <label for="VIN" class="form-label">Vehicle VIN Number</label>
                                <input type="text" class="form-control" id="VIN" placeholder="Enter your Vehicle's VIN">
                            </div>
                            <div class="mb-3">
                                <label for="appointmentDate" class="form-label">Booking Date</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="appointmentDate" placeholder="Select the Appointment Date">
                                    <label class="input-group-text" for="appointmentDate"><i class="bi bi-calendar"></i></label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">What are you looking to get done?</label>
                                <textarea class="form-control" id="message" rows="3" placeholder="What maintenance can we perform on your vehicle? "></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Schedule Your Appointment</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function() {
            $('#appointmentDate').datepicker();
        });
    </script>

</body>
</html>

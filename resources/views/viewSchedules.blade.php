<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            margin: 20px auto;
            padding: 20px;
            max-width: 800px;
            background-color: #f7f7f7;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        input[type="date"] {
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        #title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }
    </style>
 <script>
    $(document).ready(function(){
        // Function to fetch schedule for a given date
        function fetchSchedule(selectedDate) {
            $.ajax({
                url: '/showSchedule',
                type: 'GET',
                data: { date: selectedDate },
                success: function(response) {
                    if(response === "None") {
                        $("#title").html("No Schedule Created for " + selectedDate);
                        $("#schedule-table").hide();
                    } else {
                        $("#title").html("Schedule for " + selectedDate);
                        $("#Manager").html(response.Manager);
                        $("#Sales1").html(response.Sales1);
                        $("#Sales2").html(response.Sales2);
                        $("#Technician").html(response.Technician);
                        $("#schedule-table").show();
                    }
                }
            });
        }

        // Function to fetch schedule for the current date
        function fetchScheduleForCurrentDate() {
            var currentDate = new Date().toISOString().slice(0, 10);
            fetchSchedule(currentDate);
        }

        // Call the function to fetch schedule for the current date when the page loads
        fetchScheduleForCurrentDate();

        // Event listener for date change
        $("#date").change(function(){
            var selectedDate = $(this).val();
            fetchSchedule(selectedDate);
        });
    });
</script>


</head>
<body>
    <x-navbar>
    </x-navbar>
    <div class="container">
        <input type="date" id="date">
        <div id="title"></div>
        <table id="schedule-table" style="display: none;">
            <tr>
                <th>Manager</th>
                <th>Salesperson 1</th>
                <th>Salesperson 2</th>
                <th>Technician</th>
            </tr>
            <tr>
                <td id="Manager"></td>
                <td id="Sales1"></td>
                <td id="Sales2"></td>
                <td id="Technician"></td>
            </tr>
        </table>
    </div>
</body>
</html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){

            if("{{ $today }}" == "None"){
                $("#title").html("No Schedule Created for Today");
            }
            else{
                $("#Manager").html("{{ $today[0]->Manager ?? null }}");
                $("#Sales1").html("{{ $today[0]->Sales1 ?? null }}");
                $("#Sales2").html("{{ $today[0]->Sales2 ?? null }}");
                $("#Technician").html("{{ $today[0]->Technician ?? null }}");
            }

            $("#date").change(function(){
                var dates = <?php echo json_encode($schedules); ?>;

                dates.forEach(element => {
                    if($(this).val() == element.Date){
                        console.log("test");
                    }
                    else{
                        console.log("false");
                    }
                });
            });

        });
    </script>
</head>
<body>
    <x-navbar></x-navbar>
    <div class="container">
        <input type="date" id="date">
        <div id="title"></div>
        <table>
            <tr>
                <th>Manager</th>
                <th>Salesperson 1</th>
                <th>Salesperson 2</th>
                <th>Technician</th>
            </tr>
            <tr>
                <th id="Manager"></th>
                <th id="Sales1"></th>
                <th id="Sales2"></th>
                <th id='Technician'></th>
            </tr>
        </table>
    </div>
</body>
</html>
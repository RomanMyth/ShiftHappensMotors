<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            console.log("ready");
            $('#sales1').change(function(){
                $('#sales2 option').show();
                $('#sales2 option[value=' + this.value + ']').hide();
            });
            $('#sales2').change(function(){
                $('#sales1 option').show();
                $('#sales1 option[value=' + this.value + ']').hide();
            });
        });
    </script>
</head>
<body>
    <x-navbar></x-navbar>
    <div class='container'>
        <form action="{{ route('schedule.create') }}" method="POST">
            @csrf
            <label for="Date">Date</label>
            <input type="date"  name='Date' required>

            <select name="Manager" id="" required>
                <option value="" disabled selected>Select Manger</option>
                @foreach ($managers as $manager)
                    <option value="{{ $manager->id }}">{{ $manager->firstName }}</option>
                @endforeach
            </select>

            <select name="Salesperson1" id="sales1" required>
                <option value="" disabled selected>Select Salesperson</option>
                @foreach ($salesperson as $sales)
                    <option value="{{ $sales->id }}">{{ $sales->firstName }}</option>
                @endforeach
            </select>
            <select name="Salesperson2" id="sales2" required>
                <option value="" disabled selected>Select Salesperson</option>
                @foreach ($salesperson as $sales)
                    <option value="{{ $sales->id }}">{{ $sales->firstName }}</option>
                @endforeach
            </select>

            <select name="Technician" id="" required>
                <option value="" disabled selected>Select Technician</option>
                @foreach ($technicians as $technician)
                    <option value="{{ $technician->id }}">{{ $technician->firstName }}</option>
                @endforeach
            </select>
            <button type='submit'>Create Schedule</button>
        </form>
    </div>
</body>
</html>
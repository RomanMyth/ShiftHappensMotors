<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <style>
            #banner{
                display: flex;
                align-items: center;
                justify-content: flex-start;
                width: 100%;
                height: 100px;
                font-size: 50px;
                font-family: Copperplate, "Copperplate Gothic Light", fantasy;
                background-image: linear-gradient(to right, rgba(59, 210, 230, 0.5), white); 
                padding: 20px;
            }
            .navbar{
                justify-content: space-around;
            }
            .container-fluid{
                /* background-color: red;  */
            }
            .row{
                display: flex;
            }
            .vehicleImage{
                padding: 0;
            }
            .col-lg-6{
                display: flex;
                justify-content: center;
                align-items: center;
            }
            .desc-items{
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }
            .desc-item{
                display: flex;
                justify-content: center;
                align-items: center;
            }
            .vehicleImage img{
                /* aspect-ratio: 1/2; */
                width: 95%;
            }
            .image-modal{
                display: flex;
                justify-content: center;
                align-items: center;
                /* background-image: url(https://t3.ftcdn.net/jpg/02/78/85/18/240_F_278851891_YOcWwTNJ4XoaudVUf4qXvpBb9ROrzBQO.jpg);
                background-repeat: no-repeat;
                background-size: cover; */
            }

            .border-end{
                /* background-image: url(https://t3.ftcdn.net/jpg/02/78/85/18/240_F_278851891_YOcWwTNJ4XoaudVUf4qXvpBb9ROrzBQO.jpg);
                background-repeat: no-repeat;
                background-size: cover;
                border-radius: 15px; */
            }

            .vehicleCon{
                height: 100%;
                width: 80%;
                border: 1px solid black;
                border-radius: 15px;
                box-shadow: 5px 5px 10px gray;
                margin: 5px;
            }

            @media only screen and (max-width: 1000px){
                #banner{
                    justify-content: center;
                    font-size: 8vw;
                }
                .col-lg-6{
                    height: auto;
                }
                .vehicleCon{
                    height: auto;
                }
            }
        </style>
    </head>
    <body>
        <div id='banner'>
            ShiftHappensMotors
        </div>

        {{-- Tag that holds Navbar html (Comes from components/navbar.blade.php) --}}
        <x-navbar>
        </x-navbar>

        <div class="container-fluid pt-5">
            @for($i = 0; $i < count($cars); $i++)

                {{-- If the total number of cars is odd and is on the last car, create new row with the car inside --}}
                @if (count($cars) % 2 == 1 && $i == count($cars)-1)
                    <div class='row p-3'>
                        <div class="col-lg-6">
                            <div class="row vehicleCon">
                                <div class="col-lg-6 border-end">

                                    {{-- Image of car that clicks for modal --}}
                                    <div class="vehicleImage" data-bs-toggle="modal" data-bs-target="#{{ $cars[$i]->Make }}{{ $cars[$i]->Model }}{{ $cars[$i]->Year }}Image">
                                        <img src="{{ $cars[$i]->Image }}" alt="">
                                    </div>

                                    {{-- Modal from image that shows a blownup image --}}
                                    <div class="modal fade" id="{{ $cars[$i]->Make }}{{ $cars[$i]->Model }}{{ $cars[$i]->Year }}Image" role="dialog">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body image-modal">
                                                    <img src="{{ $cars[$i]->Image }}" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        
                                {{-- Short description of car that clicks for modal --}}
                                <div class="col-lg-6" data-bs-toggle="modal" data-bs-target="#{{ $cars[$i]->Make }}{{ $cars[$i]->Model }}{{ $cars[$i]->Year }}">
                                    <div class="row">
                                        <div class="desc-item">
                                            Make: {{ $cars[$i]->Make }}
                                        </div>
                                        <div class="desc-item">
                                            Model: {{ $cars[$i]->Model }}
                                        </div>
                                        <div class="desc-item">
                                            Year: {{ $cars[$i]->Year }}
                                        </div>
                                        <div class="desc-item">
                                            Price: {{ $cars[$i]->Price }}
                                        </div>
                                    </div>

                                    {{-- Modal for description that shows all desc items of vehicle --}}
                                    <div class="modal fade" id="{{ $cars[$i]->Make }}{{ $cars[$i]->Model }}{{ $cars[$i]->Year }}" role="dialog">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="desc-item col-lg-4">
                                                            Make: {{ $cars[$i]->Make }}
                                                        </div>
                                                        <div class="desc-item col-lg-4">
                                                            Model: {{ $cars[$i]->Model }}
                                                        </div>
                                                        <div class="desc-item col-lg-4">
                                                            Year: {{ $cars[$i]->Year }}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="desc-item col-lg-4">
                                                            Price: {{ $cars[$i]->Price }}
                                                        </div>
                                                        <div class="desc-item col-lg-4">
                                                            Gas Type: {{ $cars[$i]->gasType }}
                                                        </div>
                                                        <div class="desc-item col-lg-4">
                                                            Vehicle Type: {{ $cars[$i]->vehicleType }}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="desc-item col-lg-4">
                                                            Mileage: {{ $cars[$i]->Mileage }}
                                                        </div>
                                                        <div class="desc-item col-lg-4">
                                                            Transmission: {{ $cars[$i]->Transmission }}
                                                        </div>
                                                        <div class="desc-item col-lg-4">
                                                            Drive Train: {{ $cars[$i]->driveTrain }}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="desc-item col-lg-4">
                                                            Engine: {{ $cars[$i]->Engine }}
                                                        </div>
                                                        <div class="desc-item col-lg-4">
                                                            Color: {{ $cars[$i]->Color }}
                                                        </div>
                                                        <div class="desc-item col-lg-4">
                                                            Interior Color: {{ $cars[$i]->interiorColor }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Checks if the current car should start a new row (even number) --}}
                @elseif ($i % 2 == 0)
                    <div class='row p-3'>
                        <div class="col-lg-6">
                            <div class="row vehicleCon">
                                <div class="col-lg-6 border-end">
                                    {{-- Image of car that clicks for modal --}}
                                    <div class="vehicleImage" data-bs-toggle="modal" data-bs-target="#{{ $cars[$i]->Make }}{{ $cars[$i]->Model }}{{ $cars[$i]->Year }}Image">
                                        <img src="{{ $cars[$i]->Image }}" alt="">
                                    </div>

                                    {{-- Modal from image that shows a blownup image --}}
                                    <div class="modal fade" id="{{ $cars[$i]->Make }}{{ $cars[$i]->Model }}{{ $cars[$i]->Year }}Image" role="dialog">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body image-modal">
                                                    <img src="{{ $cars[$i]->Image }}" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        
                                {{-- Short description of car that clicks for modal --}}
                                <div class="col-lg-6" data-bs-toggle="modal" data-bs-target="#{{ $cars[$i]->Make }}{{ $cars[$i]->Model }}{{ $cars[$i]->Year }}">
                                    <div class="row">
                                        <div class="desc-item">
                                            Make: {{ $cars[$i]->Make }}
                                        </div>
                                        <div class="desc-item">
                                            Model: {{ $cars[$i]->Model }}
                                        </div>
                                        <div class="desc-item">
                                            Year: {{ $cars[$i]->Year }}
                                        </div>
                                        <div class="desc-item">
                                            Price: {{ $cars[$i]->Price }}
                                        </div>
                                    </div>

                                    {{-- Modal for description that shows all desc items of vehicle --}}
                                    <div class="modal fade" id="{{ $cars[$i]->Make }}{{ $cars[$i]->Model }}{{ $cars[$i]->Year }}" role="dialog">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="desc-item col-lg-4">
                                                            Make: {{ $cars[$i]->Make }}
                                                        </div>
                                                        <div class="desc-item col-lg-4">
                                                            Model: {{ $cars[$i]->Model }}
                                                        </div>
                                                        <div class="desc-item col-lg-4">
                                                            Year: {{ $cars[$i]->Year }}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="desc-item col-lg-4">
                                                            Price: {{ $cars[$i]->Price }}
                                                        </div>
                                                        <div class="desc-item col-lg-4">
                                                            Gas Type: {{ $cars[$i]->gasType }}
                                                        </div>
                                                        <div class="desc-item col-lg-4">
                                                            Vehicle Type: {{ $cars[$i]->vehicleType }}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="desc-item col-lg-4">
                                                            Mileage: {{ $cars[$i]->Mileage }}
                                                        </div>
                                                        <div class="desc-item col-lg-4">
                                                            Transmission: {{ $cars[$i]->Transmission }}
                                                        </div>
                                                        <div class="desc-item col-lg-4">
                                                            Drive Train: {{ $cars[$i]->driveTrain }}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="desc-item col-lg-4">
                                                            Engine: {{ $cars[$i]->Engine }}
                                                        </div>
                                                        <div class="desc-item col-lg-4">
                                                            Color: {{ $cars[$i]->Color }}
                                                        </div>
                                                        <div class="desc-item col-lg-4">
                                                            Interior Color: {{ $cars[$i]->interiorColor }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    {{-- Leaves the div without an ending tag to be finsished when another car is set into the row --}}
                @else
                    {{-- If is an odd index car and isn't the last it add a car to the row and then ends the row --}}
                        <div class="col-lg-6">
                            <div class="row vehicleCon">
                                <div class="col-lg-6 border-end">
                                    {{-- Image of car that clicks for modal --}}
                                    <div class="vehicleImage" data-bs-toggle="modal" data-bs-target="#{{ $cars[$i]->Make }}{{ $cars[$i]->Model }}{{ $cars[$i]->Year }}Image">
                                        <img src="{{ $cars[$i]->Image }}" alt="">
                                    </div>

                                    {{-- Modal from image that shows a blownup image --}}
                                    <div class="modal fade" id="{{ $cars[$i]->Make }}{{ $cars[$i]->Model }}{{ $cars[$i]->Year }}Image" role="dialog">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body image-modal">
                                                    <img src="{{ $cars[$i]->Image }}" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                                {{-- Short description of car that clicks for modal --}}
                                <div class="col-lg-6" data-bs-toggle="modal" data-bs-target="#{{ $cars[$i]->Make }}{{ $cars[$i]->Model }}{{ $cars[$i]->Year }}">
                                    <div class="row">
                                        <div class="desc-item">
                                            Make: {{ $cars[$i]->Make }}
                                        </div>
                                        <div class="desc-item">
                                            Model: {{ $cars[$i]->Model }}
                                        </div>
                                        <div class="desc-item">
                                            Year: {{ $cars[$i]->Year }}
                                        </div>
                                        <div class="desc-item">
                                            Price: {{ $cars[$i]->Price }}
                                        </div>
                                    </div>

                                    {{-- Modal for description that shows all desc items of vehicle --}}
                                    <div class="modal fade" id="{{ $cars[$i]->Make }}{{ $cars[$i]->Model }}{{ $cars[$i]->Year }}" role="dialog">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="desc-item col-lg-4">
                                                            Make: {{ $cars[$i]->Make }}
                                                        </div>
                                                        <div class="desc-item col-lg-4">
                                                            Model: {{ $cars[$i]->Model }}
                                                        </div>
                                                        <div class="desc-item col-lg-4">
                                                            Year: {{ $cars[$i]->Year }}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="desc-item col-lg-4">
                                                            Price: {{ $cars[$i]->Price }}
                                                        </div>
                                                        <div class="desc-item col-lg-4">
                                                            Gas Type: {{ $cars[$i]->gasType }}
                                                        </div>
                                                        <div class="desc-item col-lg-4">
                                                            Vehicle Type: {{ $cars[$i]->vehicleType }}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="desc-item col-lg-4">
                                                            Mileage: {{ $cars[$i]->Mileage }}
                                                        </div>
                                                        <div class="desc-item col-lg-4">
                                                            Transmission: {{ $cars[$i]->Transmission }}
                                                        </div>
                                                        <div class="desc-item col-lg-4">
                                                            Drive Train: {{ $cars[$i]->driveTrain }}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="desc-item col-lg-4">
                                                            Engine: {{ $cars[$i]->Engine }}
                                                        </div>
                                                        <div class="desc-item col-lg-4">
                                                            Color: {{ $cars[$i]->Color }}
                                                        </div>
                                                        <div class="desc-item col-lg-4">
                                                            Interior Color: {{ $cars[$i]->interiorColor }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endfor
        </div>
    </body>
</html>
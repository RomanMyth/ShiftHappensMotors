<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>ShiftHappensMotors</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                Colors = [];
                interiorColors = [];
                
                filters = {
                    "Colors" : Colors,
                    "Interior" : interiorColors,
                    "Make" : "",
                    "MinPrice" : 0,
                    "MaxPrice" : 0,
                    "Age": "",
                    "MinMiles": 0,
                    "MaxMiles": 0,
                    "Transmission" : "",
                    "Gas" : ""
                };

                $(".color-filter").change(function(){
                    current_color = this.value;
                    if(this.checked){
                        filters.Colors.push(current_color);
                    }
                    else{
                        filters.Colors = filters.Colors.filter(item => item !== current_color);
                    }
                });

                $(".interior-color").change(function(){
                    current_color = this.value;
                    if(this.checked){
                        filters.Interior.push(current_color);
                    }
                    else{
                        filters.Interior = filters.Interior.filter(item => item !== current_color);
                    }
                });

                $(".make-filter").change(function(){
                    filters.Make = this.value;
                });

                $(".min-filter").change(function(){
                    filters.MinPrice = this.value;
                });

                $(".max-filter").change(function(){
                    filters.MaxPrice =  this.value;
                });

                $(".age").change(function(){
                    filters.Age = this.value;
                });

                $(".min-mileage").change(function(){
                    filters.MinMiles = this.value;
                });

                $(".max-mileage").change(function(){
                    filters.MaxMiles = this.value;
                });

                $(".transmission").change(function(){
                    filters.Transmission = this.value;
                });

                $(".gas-type").change(function(){
                    filters.Gas = this.value;
                });

                $(".filter-option").change(function(){
                    $(".vehicle").each(function(){
                        if((filters.Colors.includes($(this).attr("data-color")) || filters.Colors.length == 0) && (filters.Interior.includes($(this).attr("data-interior")) || filters.Interior.length == 0) && (filters.Make == $(this).attr("data-make") || filters.Make == "") && (filters.MinPrice <= parseFloat($(this).attr("data-price")) || filters.MinPrice == 0) && (filters.MaxPrice >= parseFloat($(this).attr("data-price")) || filters.MaxPrice == 0) && (filters.Age == $(this).attr("data-age") || filters.Age == "") && (filters.MinMiles < $(this).attr("data-mileage") || filters.MinMiles == 0) && (filters.MaxMiles > $(this).attr("data-mileage") || filters.MaxMiles == 0) && (filters.Transmission == $(this).attr("data-transmission") || filters.Transmission == "") && (filters.Gas == $(this).attr("data-gas") || filters.Gas == "")){
                            $(this).show();
                        }
                        else{
                            $(this).hide();
                        }
                    });
                });
            });
        </script>

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
                display: flex;
                flex-direction: row;
                /* background-color: red;  */
            }
            #con{
                width: 100%;
                height: 100%;
            }
            .row{
                display: flex;
            }
            .vehicleImage{
                padding: 0;
            }
            .vehicle{
                margin-bottom: 20px;
                height: 30vh;
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

            .radio-item{
                display: none !important;
            }
            .label-item{
                width: 20px;
                height: 20px;
            }
            .label-item img{
                width: 100%;
                height: 100%;
            }
            .radio-item:checked + label{
                opacity: 1;
            }
            .col-lg-2{
                display: flex;
                flex-direction: column;
                align-items: center;
                background-color:rgba(0, 0, 0, 0.1);
                border: 1px solid rgba(0, 0, 0, 0.4);
                border-radius: 15px;
            }
            #filter-header{
                display: flex;
                justify-content: center;
                align-items: center;
                font-size: 2em;
            }

            .col-lg-2{
                height: fit-content;
                padding: 10px;
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

        <div class="container-fluid p-5">
            <div class="row" id="con">
                <div class="col-lg-2 sticky-top">
                    <div id="filter-header">
                        Filter Vehicles
                    </div>
                    Color: 
                    <div class="row">
                        <div class="col-lg-3">
                            <input type="checkbox" id="Red" name="color" value="Red" class="color-filter filter-option">
                            <label for="Red">Red</label>
                        </div>
                        <div class="col-lg-3">
                            <input type="checkbox" id="Black" name="color" value="Black" class="color-filter filter-option">
                            <label for="Black">Black</label>
                        </div>
                        <div class="col-lg-3">
                            <input type="checkbox" id="Blue" name="color" value="Blue" class="color-filter filter-option">
                            <label for="Blue">Blue</label>
                        </div>
                        <div class="col-lg-3">
                            <input type="checkbox" id="White" name="color" value="White" class="color-filter filter-option">
                            <label for="White">White</label>
                        </div>
                        <div class="col-lg-3">
                            <input type="checkbox" id="Green" name="color" value="Green" class="color-filter filter-option">
                            <label for="Green">Green</label>
                        </div>
                        <div class="col-lg-3">
                            <input type="checkbox" id="Silver" name="color" value="Silver" class="color-filter filter-option">
                            <label for="Silver">Silver</label>
                        </div>
                        <div class="col-lg-3">
                            <input type="checkbox" id="Orange" name="color" value="Orange" class="color-filter filter-option">
                            <label for="Orange">Orange</label>
                        </div>
                        <div class="col-lg-3">
                            <input type="checkbox" id="Gray" name="color" value="Gray" class="color-filter filter-option">
                            <label for="Gray">Gray</label>
                        </div>
                    </div>
                    Interior Color: 
                    <div class="row">
                        <div class="col-lg-3">
                            Black
                            <input type="checkbox" value="Black" class="interior-color filter-option">
                        </div>
                        <div class="col-lg-3">
                            Gray
                            <input type="checkbox" value="Gray" class="interior-color filter-option">
                        </div>
                        <div class="col-lg-3">
                            White
                            <input type="checkbox" value="White" class="interior-color filter-option">
                        </div>
                    </div>
                    Make:
                    <div class="row">
                        <select name="make" id="" class="make-filter filter-option">
                            <option value="">All</option>
                            @foreach ($makes as $make)
                                <option value="{{ $make->Make }}">{{ $make->Make }}</option>
                            @endforeach
                        </select>
                    </div>
                    Minimum Price:
                    <div>
                        <input type="number" class="min-filter filter-option">
                    </div>
                    Maximum Price:
                    <div>
                        <input type="number" class="max-filter filter-option">
                    </div>
                    New or Used:
                    <div>
                        <select name="age" class="age filter-option">
                            <option value="">All</option>
                            <option value="0">New</option>
                            <option value="1">Used</option>
                        </select>
                    </div>
                    Minimum Mileage:
                    <div>
                        <input type="number" class="min-mileage filter-option">
                    </div>
                    Maximum Mileage:
                    <div>
                        <input type="number" class="max-mileage filter-option">
                    </div>
                   Transmission:
                   <div>
                        <select name="transmission" class="transmission filter-option">
                            <option value="">All</option>
                            <option value="Automatic">Automatic</option>
                            <option value="Manual">Manual</option>
                        </select>
                   </div>
                   Gas Type:
                   <div>
                        <select name="Gas" class="gas-type filter-option">
                            <option value="">All</option>
                            <option value="Gas">Gas</option>
                            <option value="Diesel">Diesel</option>
                        </select>
                   </div>
                </div>
                <div class="col-lg-10">
                    <div class="row">
                        @for($i = 0; $i < count($cars); $i++)
                            <div class="col-lg-6 vehicle" data-color="{{ $cars[$i]->Color }}" data-make="{{ $cars[$i]->Make }}" data-price="{{ $cars[$i]->Price }}" data-age="{{ $cars[$i]->newOrUsed }}" data-mileage="{{ $cars[$i]->Mileage }}" data-transmission="{{ $cars[$i]->Transmission }}" data-interior="{{ $cars[$i]->interiorColor }}" data-gas="{{ $cars[$i]->gasType }}">
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
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
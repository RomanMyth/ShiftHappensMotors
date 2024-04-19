<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>ShiftHappensMotors</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

        <meta name="csrf-token" content="{{ csrf_token() }}"/>
        <script>
            $(document).ready(function(){
                //check when a a vehicle has the 'favorite' button clicked
                $("ion-icon").click(function(){

                    //save the element that triggered the function
                    var trigger = this;

                    //check if the vehicle is not favorited
                    if(!$(trigger).hasClass("fav")){
                        try{
                            $.ajax({
                                url: "/favorite",
                                type: 'POST',
                                data: {Vin:$(trigger).attr("data-vin")},
                                dataType: 'JSON',
                                headers: {
                                    'X_CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                error: function(xhr) {
                                    if(xhr.status == 401){
                                        window.location.href = '/login'
                                    }
                                }
                            }) 
                        }
                        catch(err){
                            alert(err);
                        }

                        $(trigger).addClass("fav");
                    }

                    //else unfavorite it
                    else{
                        $.ajax({
                            url: "/deleteFavorite",
                            type: 'DELETE',
                            data: {_token: $('meta[name="csrf-token"]').attr('content'), Vin:$(trigger).attr("data-vin")},
                            dataType: 'JSON'
                        })

                        $(trigger).removeClass("fav");
                    }

                });


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

            *{
                font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
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

            .vehicleCon{
                height: 100%;
                width: 80%;
                border: 1px solid grey;
                border-radius: 15px;
                /* box-shadow: 5px 5px 10px gray; */
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

            .vehicleInfo{
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                align-items: stretch;
            }

            .favorite{
                width: 100%;
                height: 10%;
                display: flex;
                justify-content: flex-start;
                align-items: center;
                align-content: center;
                margin: 0;
            }

            .favorite button{
                height: 100%;
                border: none;
                background: none;
            }

            .fav{
                fill: red;
            }

            ion-icon{
                height: 10%;
                width: 20px;
                stroke: black;
                stroke-width: 4px;
                stroke-linejoin: round;
                paint-order: stroke;
                transition: 200ms;
            }
            ion-icon:hover{
                fill: red;
            }

            /* .purchase{
                display: flex;
                flex-direction: row;
            } */

            /* .overtop{
                pointer-events: none;
            } */

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
            /* Slideshow Styles */
            /* Slideshow container */
            .mySlides {
                display: none
            }
            img {
                vertical-align: middle;
            }

            .slideshow-container {
                max-width: 100%;
                position: relative;
                margin: auto;
                height: auto;
            }

            .mySlides img {
                width: 95%; /* Adjust the width as needed */
                height: auto; /* Maintain the aspect ratio */
            }

            .mySlides {
                display: none;
                transition: opacity 1s; /* Adjust the duration as needed (e.g., 1s for 1 second) */
            }

            .mySlides.fade {
                opacity: 1;
            }


            /* Next & previous buttons */
            .prev, .next {
                cursor: pointer;
                position: absolute;
                top: 50%;
                width: auto;
                padding: 16px;
                margin-top: -22px;
                color: white;
                font-weight: bold;
                font-size: 18px;
                transition: 0.6s ease;
                border-radius: 0 3px 3px 0;
                user-select: none;
            }

            /* Position the "next button" to the right */
            .next {
                right: 0;
                border-radius: 3px 0 0 3px;
            }

            /* On hover, add a black background color with a little bit see-through */
            .prev:hover, .next:hover {
                background-color: rgba(0,0,0,0.8);
            }

            /* Caption text */
            .text {
                color: #f2f2f2;
                font-size: 33px;
                padding: 8px 12px;
                position: absolute;
                bottom: 8px;
                width: 100%;
                text-align: right;
            }

            /* Number text (1/3 etc) */
            .numbertext {
                color: #f2f2f2;
                font-size: 12px;
                padding: 8px 12px;
                position: absolute;
                top: 0;
            }

            #ShowcaseCon{
                width: 100%;
                display: flex;
                justify-content: center;
            }

            #ShowcaseVehicle{
                width: 80%;
            }

            .index{
                z-index: 0 !important;
                top: 11% !important;
            }

            /* On smaller screens, decrease text size */
            @media only screen and (max-width: 300px) {
                .prev, .next,.text {
                    font-size: 11px
                }
            }  
        </style>
    </head>
    <body>
        <x-navbar>
        </x-navbar>
        
        
        
        
        {{-- <div class="slideshow-container">

            <div class="mySlides ">
            <div class="numbertext">1 / 3</div>
            <img src="https://th.bing.com/th/id/R.0e2b1959d1970ae86743ecd18df9d2ca?rik=AjbNLihgK4ZOww&riu=http%3a%2f%2fhondanewspecs.com%2fwp-content%2fuploads%2f2022%2f07%2f2024-Honda-Accord-Redesign.png&ehk=mGKXS9cxcKAuE3AlWv8fv6Vb6GLACqyaiC7dwBo3sGY%3d&risl=&pid=ImgRaw&r=0" style="width:100%">
            <div class="text">2024 Honda Accord</div>
            </div>
            
            <div class="mySlides">
            <div class="numbertext">2 / 3</div>
            <img src="https://moparinsiders.com/wp-content/uploads/2022/07/2023-Jeep%C2%AE-Wrangler-Unlimited-Rubicon-4xe.-Jeep..jpg" style="width:100%">
            <div class="text">2023 Jeep Wrangler</div>
            </div>
            
            <div class="mySlides ">
            <div class="numbertext">3 / 3</div>
            <img src="https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/2020-lamborghini-urus-mmp-1-1570563282.jpg?crop=0.923xw:0.702xh;0.00801xw,0.298xh&resize=1200:*" style="width:100%">
            <div class="text">2020 Lamborghini Urus</div>
            </div>
            
            <a class="prev" onclick="plusSlides(-1)">❮</a>
            <a class="next" onclick="plusSlides(1)">❯</a>
            
        </div> --}}

        <div id="ShowcaseCon">
            <div id="ShowcaseVehicle" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#ShowcaseVehicle" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#ShowcaseVehicle" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#ShowcaseVehicle" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="https://th.bing.com/th/id/R.0e2b1959d1970ae86743ecd18df9d2ca?rik=AjbNLihgK4ZOww&riu=http%3a%2f%2fhondanewspecs.com%2fwp-content%2fuploads%2f2022%2f07%2f2024-Honda-Accord-Redesign.png&ehk=mGKXS9cxcKAuE3AlWv8fv6Vb6GLACqyaiC7dwBo3sGY%3d&risl=&pid=ImgRaw&r=0">
                    </div>
    
                    <div class="carousel-item">
                        <img class="d-block w-100" src="https://moparinsiders.com/wp-content/uploads/2022/07/2023-Jeep%C2%AE-Wrangler-Unlimited-Rubicon-4xe.-Jeep..jpg">
                    </div>
    
                    <div class="carousel-item">
                        <img class="d-block w-100" src="https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/2020-lamborghini-urus-mmp-1-1570563282.jpg?crop=0.923xw:0.702xh;0.00801xw,0.298xh&resize=1200:*">
                    </div>
                </div>
    
                <button class="carousel-control-prev" type="button" data-bs-target="#ShowcaseVehicle" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden"><</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#ShowcaseVehicle" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">></span>
                </button>
    
            </div>
        </div>
        
        
        {{-- <div style="text-align:center">
          <span class="dot" onclick="currentSlide(1)"></span> 
          <span class="dot" onclick="currentSlide(2)"></span> 
          <span class="dot" onclick="currentSlide(3)"></span> 
        </div> --}}

          {{-- Tag that holds Navbar html (Comes from components/navbar.blade.php) --}}
    
        <div class="container-fluid p-5">
            <div class="row" id="con">
                <div class="col-lg-2 sticky-top index">
                    <div id="filter-header" class="mb-3">
                        Filter Vehicles
                    </div>
                    Color: 
                    <div class="row mb-4">
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
                    <div class="row mb-4">
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
                    <div class="row mb-4">
                        <select name="make" id="" class="make-filter filter-option">
                            <option value="">All</option>
                            @foreach ($makes as $make)
                                <option value="{{ $make->Make }}">{{ $make->Make }}</option>
                            @endforeach
                        </select>
                    </div>
                    Minimum Price:
                    <div>
                        <input type="number" class="min-filter filter-option mb-3">
                    </div>
                    Maximum Price:
                    <div>
                        <input type="number" class="max-filter filter-option mb-3">
                    </div>
                    New or Used:
                    <div>
                        <select name="age" class="age filter-option">
                            <option value="">All</option>
                            <option value="0">New</option>
                            <option value="1">Used</option>
                        </select>
                    </div>
                   <h5> Minimum Mileage:</h5>
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
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body image-modal">
                                                        <img src="{{ $cars[$i]->Image }}" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            
                                    {{-- Short description of car that clicks for modal --}}
                                    <div class="col-lg-6 vehicleInfo">
                                        @php
                                            $count = 0;
                                            foreach($favorites as $favorite){
                                                if($cars[$i]->Vin == $favorite->Vin){
                                                    $count++;
                                                    break;
                                                }
                                            }
                                        //jon and amaury was here
                                        @endphp
                                        @if($count == 0)
                                            <ion-icon name="heart" data-vin="{{ $cars[$i]->Vin }}"></ion-icon>
                                        @else
                                            <ion-icon name="heart" class="fav" data-vin="{{ $cars[$i]->Vin }}"></ion-icon>
                                        @endif
                                        <div class="row" data-bs-toggle="modal" data-bs-target="#{{ $cars[$i]->Make }}{{ $cars[$i]->Model }}{{ $cars[$i]->Year }}">
                                            <div class="desc-item">
                                            ${{ $cars[$i]->Price }}
                                            </div>
                                            <div class="desc-item">
                                                {{ $cars[$i]->Year }}  {{ $cars[$i]->Make }} {{ $cars[$i]->Model }}
                                            </div>
                            
                                    
                                        </div>
                                        <div class="row purchase">
                                            <form class="col-lg-6" action="{{ route('car.buy', ['vin' => $cars[$i]->Vin]) }}" method="GET">
                                                @csrf
                                                <input type="hidden" name="car_details" value="{{$cars[$i]->Vin }}">
                                                <button type="submit" class="btn btn-primary">Buy</button>
                                            </form>
                                            <form class="col-lg-6" action="{{ route('car.leaseDetails') }}" method="GET">
                                                @csrf
                                                <input type="hidden" name="car_details" value="{{ $cars[$i]->Vin }}">
                                                <button type="submit" class="btn btn-primary">Lease</button>
                                            </form>
                                        </div>
                                        

                                        {{-- Modal for description that shows all desc items of vehicle --}}
                                        <div class="modal fade" id="{{ $cars[$i]->Make }}{{ $cars[$i]->Model }}{{ $cars[$i]->Year }}" role="dialog">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
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

        {{-- <script>
            let slideIndex = 1;
            showSlides(slideIndex);
            
            function plusSlides(n) {
              showSlides(slideIndex += n);
            }
            
            function currentSlide(n) {
              showSlides(slideIndex = n);
            }
            
            function showSlides(n) {
    let i;
    let slides = document.getElementsByClassName("mySlides");
    let dots = document.getElementsByClassName("dot");
    if (n > slides.length) {slideIndex = 1}    
    if (n < 1) {slideIndex = slides.length}
    
    // Hide all slides
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";  
        slides[i].style.opacity = 0;  // Start with opacity 0
    }
    
    // Remove active class from all dots
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    
    // Fade in the current slide
    slides[slideIndex-1].style.display = "block";  
    fadeIn(slides[slideIndex-1]); // Apply fade in effect
    dots[slideIndex-1].className += " active";
}

// Function to fade in a specific element
function fadeIn(element) {
    var opacity = 0;
    var timer = setInterval(function() {
        if (opacity >= 1) {
            clearInterval(timer); // Stop the timer when opacity reaches 1
        }
        element.style.opacity = opacity;
        opacity += 0.05; // Increase opacity gradually with smaller steps
    }, 20); // Decrease the interval for smoother animation
}

            </script> --}}

    </body>
</html>
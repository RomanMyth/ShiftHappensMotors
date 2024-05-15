<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>ShiftHappensMotors</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

        <meta name="csrf-token" content="{{ csrf_token() }}"/>
        <script>
            $(document).ready(function(){
                //check when a a vehicle has the 'favorite' button clicked
                $(".icon").click(async function(){

                    //save the element that triggered the function
                    var trigger = this;

                    //check if the vehicle is not favorited
                    if(!$(trigger).hasClass("fav")){
                        try{
                            await $.ajax({
                                url: "/favorite",
                                type: 'POST',
                                data: {Vin:$(trigger).attr("data-vin")},
                                dataType: 'JSON',
                                headers: {
                                    'X_CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function(data){
                                    $(trigger).addClass("fav");
                                },
                                error: function(xhr) {
                                    if(xhr.status == 401){
                                        window.location.href = '/login'
                                    }
                                }
                            })    
                        }
                        finally{}
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
    * {
        font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
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

    .navbar {
        justify-content: space-around;
    }

    .container-fluid {
        display: flex;
        flex-direction: row;
        /* background-color: red; */
    }

    #con {
        width: 100%;
        height: 100%;
    }

    .row {
        display: flex;
    }

    .vehicleImage {
        padding: 0;
    }

    .vehicle {
        margin-bottom: 20px;
        height: 30vh;
    }

    .col-lg-6 {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .desc-items {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .desc-item {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .vehicleImage img {
        /* aspect-ratio: 1/2; */
        width: 95%;
    }

    .image-modal {
        display: flex;
        justify-content: center;
        align-items: center;
        /* background-image: url(https://t3.ftcdn.net/jpg/02/78/85/18/240_F_278851891_YOcWwTNJ4XoaudVUf4qXvpBb9ROrzBQO.jpg);
        background-repeat: no-repeat;
        background-size: cover; */
    }

    .vehicleCon {
        height: 100%;
        width: 80%;
        border: 1px solid grey;
        border-radius: 15px;
        /* box-shadow: 5px 5px 10px gray; */
        margin: 5px;

    }

    .radio-item {
        display: none !important;
    }

    .label-item {
        width: 20px;
        height: 20px;
    }

    .label-item img {
        width: 100%;
        height: 100%;
    }

    .radio-item:checked+label {
        opacity: 1;
    }

    .col-lg-2 {
        display: flex;
        flex-direction: column;
        align-items: center;
        background-color: rgb(179 179 179 / 10%);
        border: 1px solid rgba(0, 0, 0, 0.4);
        border-radius: 15px;
    }

    #filter-header {
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 2em;
    }

    .col-lg-2 {
        height: fit-content;
        padding: 10px;
    }

    .vehicleInfo {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: stretch;
    }

    .favorite {
        width: 100%;
        height: 10%;
        display: flex;
        justify-content: flex-start;
        align-items: center;
        align-content: center;
        margin: 0;
    }

    .favorite button {
        height: 100%;
        border: none;
        background: none;
    }

    .fav {
        fill: red;
    }

    .icon {
        height: 100%;
        width: 20px;
        stroke: black;
        stroke-width: 4px;
        stroke-linejoin: round;
        paint-order: stroke;
        transition: 200ms;
    }

    .index{
        z-index: 0 !important;
        top: 13% !important;
        
    }
    
    .icon:hover {
        fill: red;
    }

    @media only screen and (max-width: 1000px) {
        #banner {
            justify-content: center;
            font-size: 8vw;
        }

        .col-lg-6 {
            height: auto;
        }

        .vehicleCon {
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
    .prev,
    .next {
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
    .prev:hover,
    .next:hover {
        background-color: rgba(0, 0, 0, 0.8);
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

    /* Set ShowcaseCon to flex and align items to the center */
    #ShowcaseCon {
        width: 100%;
        display: flex;
        justify-content: flex-start; /* Change from center to flex-start */
        align-items: center;
    }

    /* Set ShowcaseVehicle to a fixed width */
    #ShowcaseVehicle {
        width: 100%;
    }

    /* Set the carousel items to align-items: flex-start */
    .carousel-item {
        display: flex; /* Add this line */
        align-items: flex-start; /* Add this line */
    }

    /* Set the description to display on the right */
    /* Set the description to match the height of the image */
    .description {
        flex: 1; /* Allow the description to take up remaining space */
        /* margin-left: 21px; Adjust the margin as needed */
        background-color: rgb(25, 24, 24);
        padding: 20px; /* Add padding for spacing */
        object-fit: cover;
        color: white; /* Set text color to white */
    }

    /* Make images taller and descriptions smaller */
    /* Set the images in the carousel to have a fixed height */
    .carousel-item img {
        object-fit: cover; /* Ensure the entire image is visible within the fixed height */
    }

    .fav-align{
        display: flex;
        flex-direction: row;
        justify-content: flex-end;
        height: 10%;
    }

    .col-lg-4{
        display: flex;
        flex-direction: column;
    }

    /* On smaller screens, decrease text size */
    @media only screen and (max-width: 300px) {
        .prev,
        .next,
        .text {
            font-size: 11px;
        }
    }

</style>
    </head>
    <body>
        <x-navbar>
        </x-navbar>
        <div id="ShowcaseCon">
            <div id="ShowcaseVehicle" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="d-flex">
                            <img class="d-block w-75 h-auto" src="https://th.bing.com/th/id/R.0e2b1959d1970ae86743ecd18df9d2ca?rik=AjbNLihgK4ZOww&riu=http%3a%2f%2fhondanewspecs.com%2fwp-content%2fuploads%2f2022%2f07%2f2024-Honda-Accord-Redesign.png&ehk=mGKXS9cxcKAuE3AlWv8fv6Vb6GLACqyaiC7dwBo3sGY%3d&risl=&pid=ImgRaw&r=0">
                            <div class="description">
                                <!-- Description for Slide 1 -->
                                <br>
                                <h3 style="font-family: Arial, sans-serif; font-size: 28px;">2024 Honda Accord</h3>
                                <p style="font-family: 'Times New Roman', Times, serif; font-size: 18px;">Experience luxury redefined with the 2024 Honda Accord. Unleash the thrill of driving with cutting-edge technology and superior comfort. Lease for as low as <span style="font-family: 'Arial Black', sans-serif; font-size: 24px;">$399.99/day</span> or own it today for just <span style="font-family: 'Arial Black', sans-serif; font-size: 24px;">$39,999</span>. Elevate your drive, elevate your lifestyle.</p>
                            </div>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <div class="d-flex">
                            <img class="d-block w-75 h-auto" src="https://media.autoexpress.co.uk/image/private/s--X-WVjvBW--/f_auto,t_content-image-full-desktop@1/v1562227927/autoexpress/0/18/honda-civic-ek9-54e0cfb452d5d.jpg">
                            <div class="description">
                                <!-- Description for Slide 3 -->
                                <br>
                                <h3 style="font-family: Arial, sans-serif; font-size: 28px;">Shift Happens Motors will make sure you are 100% Satisfied</h3>
                                <p style="font-family: 'Times New Roman', Times, serif; font-size: 18px;">With the right parts for your car , and with mechanics ready to install the part needed as soon as the parts is bought.</p>
                                <br>
                                <p style="font-family: 'Times New Roman', Times, serif; font-size: 18px;"> We want to make sure that not only you buy parts from us but to be an place you can trust your cars needs.</p>
                            </div>
                        </div>
                    </div>
        
                    <div class="carousel-item">
                        <div class="d-flex">
                            <img class="d-block w-75 h-auto" src="https://pictures.dealer.com/i/igburtonberlinchryslerdodgecllc/0776/33f57276011b64714d11780c0c018059x.jpg">
                            <div class="description">
                                <!-- Description for Slide 2 -->
                                <br>
                                <h3 style="font-family: Arial, sans-serif; font-size: 28px;">2023 Jeep Wrangler Unlimited Rubicon 4xe</h3>
                                <p style="font-family: 'Times New Roman', Times, serif; font-size: 18px;">Conquer every terrain with the legendary 2023 Jeep Wrangler Unlimited Rubicon 4xe. Dominate the off-road and make a statement on the streets. Starting at <span style="font-family: 'Arial Black', sans-serif; font-size: 24px;">$30,000</span>, experience adventure like never before. Unleash your inner explorer.</p>
                            </div>
                        </div>
                    </div>
        
                    <div class="carousel-item">
                        <div class="d-flex">
                            <img class="d-block w-75 h-auto" src="https://hips.hearstapps.com/hmg-prod.s3.amazonaws.com/images/2020-lamborghini-urus-mmp-1-1570563282.jpg?crop=0.923xw:0.702xh;0.00801xw,0.298xh&resize=1200:*">
                            <div class="description">
                                <!-- Description for Slide 3 -->
                                <h3 style="font-family: Arial, sans-serif; font-size: 28px;">2020 Lamborghini Urus</h3>
                                <p style="font-family: 'Times New Roman', Times, serif; font-size: 18px;">Unleash the power of prestige with the 2020 Lamborghini Urus. Elevate your status with Italian craftsmanship and unparalleled performance. Priced at <span style="font-family: 'Arial Black', sans-serif; font-size: 24px;">$200,000</span>, experience the epitome of luxury and speed. Own the road, own the dream.</p>
                                <br>
                                <p style="font-family: 'Times New Roman', Times, serif; font-size: 18px;"> Already with the parts needed installed , and free maintance for 4 years. This car is ready to be yours! <span style="font-family: 'Arial Black', sans-serif; font-size: 24px;">BUY NOW BELOW!</span>, see details about Buying or Leasing by scrolling down.</p>

                            </div>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <div class="d-flex">
                            <img class="d-block w-75 h-auto" src="https://cdn.classic-trader.com/I/images/1920_1920_inset/vehicle_ad_standard_image_c9941636f5e01c9d44e9bacb78bb77be.jpg">
                            <div class="description">
                                <!-- Description for Slide 3 -->
                                <br>
                                <h3 style="font-family: Arial, sans-serif; font-size: 28px;">1920 Ford Model-T</h3>
                                <p style="font-family: 'Times New Roman', Times, serif; font-size: 18px;">Go Back in Time with this amazing classic , our team managed to fully restore this beauty to how it was at its prime, it could be yours for <span style="font-family: 'Arial Black', sans-serif; font-size: 24px;">$250,000</span>, with this car you will have ultimate 1900's experience not forgetting as well this would be an pretty valuable addition to your colection.</p>
                            </div>
                        </div>
                    </div>
        
        
                    <!-- Add more carousel items with similar structure as needed -->
        
                </div>
        
                <button class="carousel-control-prev" type="button" data-bs-target="#ShowcaseVehicle" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#ShowcaseVehicle" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
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
                    <div class="mb-4">
                        <h5>Color:</h5>
                        <div class="row">
                            <div class="col-lg-4">
                                <input type="checkbox" id="Red" name="color" value="Red" class="color-filter filter-option">
                                <label for="Red">Red</label>
                            </div>
                            <div class="col-lg-4">
                                <input type="checkbox" id="Black" name="color" value="Black" class="color-filter filter-option">
                                <label for="Black">Black</label>
                            </div>
                            <div class="col-lg-4">
                                <input type="checkbox" id="Blue" name="color" value="Blue" class="color-filter filter-option">
                                <label for="Blue">Blue</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <input type="checkbox" id="White" name="color" value="White" class="color-filter filter-option">
                                <label for="White">White</label>
                            </div>
                            <div class="col-lg-4">
                                <input type="checkbox" id="Green" name="color" value="Green" class="color-filter filter-option">
                                <label for="Green">Green</label>
                            </div>
                            <div class="col-lg-4">
                                <input type="checkbox" id="Silver" name="color" value="Silver" class="color-filter filter-option">
                                <label for="Silver">Silver</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4">
                                <input type="checkbox" id="Orange" name="color" value="Orange" class="color-filter filter-option">
                                <label for="Orange">Orange</label>
                            </div>
                            <div class="col-lg-4">
                                <input type="checkbox" id="Gray" name="color" value="Gray" class="color-filter filter-option">
                                <label for="Gray">Gray</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <h5>Interior Color:</h5>
                        <div class="row">
                            <div class="col-lg-4">
                                <input type="checkbox" value="Black" class="interior-color filter-option">
                                <label>Black</label>
                            </div>
                            <div class="col-lg-4">
                                <input type="checkbox" value="Gray" class="interior-color filter-option">
                                <label>Gray</label>
                            </div>
                            <div class="col-lg-4">
                                <input type="checkbox" value="White" class="interior-color filter-option">
                                <label>White</label>
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <h5>Make:</h5>
                        <select name="make" class="make-filter filter-option">
                            <option value="">All</option>
                            @foreach ($makes as $make)
                            <option value="{{ $make->Make }}">{{ $make->Make }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <h5>Price Range:</h5>
                        <div class="row">
                            <div class="col-lg-6">
                                <input type="number" class="min-filter filter-option form-control" placeholder="Min">
                            </div>
                            <div class="col-lg-6">
                                <input type="number" class="max-filter filter-option form-control" placeholder="Max">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <h5>Condition:</h5>
                        <select name="age" class="age filter-option form-control">
                            <option value="">All</option>
                            <option value="0">New</option>
                            <option value="1">Used</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <h5>Mileage Range:</h5>
                        <div class="row">
                            <div class="col-lg-6">
                                <input type="number" class="min-mileage filter-option form-control" placeholder="Min">
                            </div>
                            <div class="col-lg-6">
                                <input type="number" class="max-mileage filter-option form-control" placeholder="Max">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <h5>Transmission:</h5>
                        <select name="transmission" class="transmission filter-option form-control">
                            <option value="">All</option>
                            <option value="Automatic">Automatic</option>
                            <option value="Manual">Manual</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <h5>Gas Type:</h5>
                        <select name="Gas" class="gas-type filter-option form-control">
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
                                        <div class="vehicleImage" data-bs-toggle="modal" data-bs-target="#{{ $cars[$i]->Make }}{{ $cars[$i]->Model }}{{ $cars[$i]->Year }}Image">
                                            <img src="{{ $cars[$i]->Image }}" alt="">
                                        </div>
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
                                    <div class="col-lg-6 vehicleInfo">
                                        @php
                                            $count = 0;
                                            foreach($favorites as $favorite){
                                                if($cars[$i]->Vin == $favorite->Vin){
                                                    $count++;
                                                    break;
                                                }
                                            }
                                        @endphp
                                        <div class='Fav-align'>
                                            @if($count == 0)
                                                <ion-icon name="heart" class="icon" data-vin="{{ $cars[$i]->Vin }}"></ion-icon>
                                            @else
                                                <ion-icon name="heart" class="fav icon" data-vin="{{ $cars[$i]->Vin }}"></ion-icon>
                                            @endif
                                        </div>
                                        <div class="row" data-bs-toggle="modal" data-bs-target="#{{ $cars[$i]->Make }}{{ $cars[$i]->Model }}{{ $cars[$i]->Year }}">
                                            <div class="desc-item" style="font-size: 18px; color: #333; font-family: Arial, sans-serif;"> <!-- Car name -->
                                                {{ $cars[$i]->Year }} {{ $cars[$i]->Make }} {{ $cars[$i]->Model }}
                                            </div>
                                            <div class="desc-item" style="font-weight: bold; color: #007bff; font-size: 18px; font-family: Arial, sans-serif;"> <!-- Price -->
                                                ${{ $cars[$i]->Price }}
                                            </div>
                                            <div class="desc-item">
                                               Transmission: {{ $cars[$i]->Transmission }}
                                            </div>
                                            <div class="desc-item">
                                                DriveTrain: {{ $cars[$i]->driveTrain }}
                                             </div>
                                        </div>
                                        <div class="row purchase">
                                            <form class="col-lg-6" action="{{ route('car.buy', ['vin' => $cars[$i]->Vin]) }}" method="GET">
                                                @csrf
                                                <input type="hidden" name="car_details" value="{{ $cars[$i]->Vin }}">
                                                <button type="submit" class="btn btn-primary">Buy</button>
                                            </form>
                                            <form class="col-lg-6" action="{{ route('car.leaseDetails') }}" method="GET">
                                                @csrf
                                                <input type="hidden" name="car_details" value="{{ $cars[$i]->Vin }}">
                                                <button type="submit" class="btn btn-primary">Lease</button>
                                            </form>
                                        </div>
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
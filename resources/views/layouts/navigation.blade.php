<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>


<style>
    #dashBtn {
        color: black;
        text-decoration: none;
    }

    .dashLink {
        color: black;
    }

    .dashLink:hover, #dashBtn:hover {
        font-weight: bold;
    }

    #welcome {
        margin-bottom: 30px;
    }

    .favoriteContainer {
        /* background-color: #f9f9f9; */
        padding: 20px;
        margin-bottom: 20px;
    }

    .containerHead {
        margin-bottom: 30px;
    }

    .favoriteContainer {
        /* background-color: #f9f9f9; */
        padding: 20px;
        margin-bottom: 20px;
    }

    .containerHead {
        margin-bottom: 30px;
    }

    .favoriteContainer .col-lg-4 {
    /* border: solid 1px black; */
    border-radius: 10px;
    padding: 5px;
    display: flex; /* Align image and text horizontally */
    background-color: #f9f9f9; /* Light gray background */
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1); /* Shadow */
    margin-bottom: 40px; /* Adjust vertical spacing */
    flex: 0 0 30%;
}

.favoriteContainer .col-lg-4:hover {
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2); /* Shadow on hover */
}

    img {
        width: 50%; /* Adjust image width */
        height: auto; /* Maintain aspect ratio */
        margin-right: 10px; /* Add space between image and text */
    }

    .vehicle-info {
        flex: 1; /* Allow text to take remaining space */
    }

    .favoriteContainer .row {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }


    .price {
        color: #007bff;
    }

    .info {
        font-weight:600;
    }


</style>


<body>
    <x-navbar>
    </x-navbar>
    <!-- Primary Navigation Menu -->

    <!-- Responsive Settings Options -->
    <div class="container mt-4">
        <div class="text-center">
            <div id="welcome">
                <h2>Welcome {{ Auth::user()->firstName }}!</h2>
            </div>
        </div>

       <div class="favoriteContainer">
        <div class="row mt-4">
            <h3 class="containerHead">Saved vehicle(s)</h3>
            @if(!is_null($favorites))
            @foreach ($favorites as $favorite)
                <div class="col-lg-4 mb-3">
                    <img src="{{ $favorite->Image }}" class="img-fluid" alt="">
                    <div class="vehicle-info">
                        {{-- <h5>{{ $favorite->newOrUsed }}</h5> --}}
                        <h5 class="info">{{ $favorite->Year }} {{ $favorite->Make}} {{ $favorite->Model}}</h5>
                        {{-- <h3>{{ $favorite->newOrUsed }}</h3> --}}
                        <p class="price">${{ $favorite->Price}}</p>
                        <!-- Add more vehicle information as needed -->
                    </div>
                </div>
            @endforeach
            @endif
        </div>
    </div>

        {{-- <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <!-- Navigation Links -->
                            <li class="nav-item">
                                <a class="nav-link" href="{{ '/' }}">Home</a>
                            </li>
                            <!-- Add more navigation links as needed -->
                        </ul>
                    </div>
                </div>
            </nav>
        </div> --}}


    <div class="text-center">
        <div class="mt-3">
            <a href="{{ route('profile.edit') }}" class="dashLink">Update Profile</a>

            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}" class="">
                @csrf
                <button id="dashBtn" type="submit" class="btn btn-link">Log Out</button>
            </form>
        </div>
      </div>
  </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .row{
            height: 300px;
        }
        .vehicleImage{
            width: 100%;
            height: 100%;
            padding: 0;
        }
        .vehicleImage img{
            /* aspect-ratio: 6/5; */
            width: 95%;
        }
        .modal-body{
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>
<body>
    <div class="container pt-5">
        @for($i = 0; $i < count($cars); $i++)
            @if (count($cars) % 2 == 1 && $i == count($cars)-1)
                </div>
                <div class='row p-3'>
                    <div class="col-lg-3 border-end">
                        <button type="button" class="btn btn-info btn-lg vehicleImage" data-bs-toggle="modal" data-bs-target="#{{ $cars[$i]->Make }}{{ $cars[$i]->Model }}{{ $cars[$i]->Year }}Image">
                            <img src="{{ $cars[$i]->Image }}" alt="">
                        </button>
                        <div class="modal fade" id="{{ $cars[$i]->Make }}{{ $cars[$i]->Model }}{{ $cars[$i]->Year }}Image" role="dialog">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <img src="{{ $cars[$i]->Image }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <div class="col-lg-3">
                        <div>
                            {{ $cars[$i]->Make }}
                            {{ $cars[$i]->Model }}
                            {{ $cars[$i]->Year }}
                        </div>
                    </div>
                </div>
            @elseif ($i % 2 == 0)
                <div class='row p-3'>
                <div class="col-lg-3 border-end">
                    <button type="button" class="btn btn-info btn-lg vehicleImage" data-bs-toggle="modal" data-bs-target="#{{ $cars[$i]->Make }}{{ $cars[$i]->Model }}{{ $cars[$i]->Year }}Image">
                        <img src="{{ $cars[$i]->Image }}" alt="">
                    </button>
                    <div class="modal fade" id="{{ $cars[$i]->Make }}{{ $cars[$i]->Model }}{{ $cars[$i]->Year }}Image" role="dialog">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <img src="{{ $cars[$i]->Image }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
                <div class="col-lg-3">
                    <div>
                        {{ $cars[$i]->Make }}
                        {{ $cars[$i]->Model }}
                        {{ $cars[$i]->Year }}
                    </div>
                </div>
            @else
            <div class="col-lg-3 border-end">
                <button type="button" class="btn btn-info btn-lg vehicleImage" data-bs-toggle="modal" data-bs-target="#{{ $cars[$i]->Make }}{{ $cars[$i]->Model }}{{ $cars[$i]->Year }}Image">
                    <img src="{{ $cars[$i]->Image }}" alt="">
                </button>
                <div class="modal fade" id="{{ $cars[$i]->Make }}{{ $cars[$i]->Model }}{{ $cars[$i]->Year }}Image" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <img src="{{ $cars[$i]->Image }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="col-lg-3">
                <div>
                    {{ $cars[$i]->Make }}
                    {{ $cars[$i]->Model }}
                    {{ $cars[$i]->Year }}
                </div>
                </div>
            @endif
        @endfor
    </div>
</body>
</html>
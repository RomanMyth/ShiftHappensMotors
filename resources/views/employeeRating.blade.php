<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Ratings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
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
            font-weight: bold;
        }

        button[type="submit"]:hover {
            background-color: white;
            color: #000;
            border: 1px solid black;
        }

        .navbar {
            justify-content: space-around;
        }
        .container {
            padding: 20px;
            margin-top: 30px;
        }
        .star-rating {
            font-size: 24px;
        }
        .star {
            cursor: pointer;
        }
        .star:hover,
        .star.active {
            color: gold;
        }
        .ratings-table th,
        .ratings-table td {
            text-align: center;
            vertical-align: middle;
        }
        .card {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #007bff;
            color: #fff;
            border-bottom: none;
            padding: 15px 20px;
        }
        .card-body {
            padding: 20px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .form-label {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .form-control {
            border-radius: 0;
        }
        .form-select {
            border-radius: 0;
        }
        .form-select:hover, textarea:hover {
            border-color: black;
        }
        .form-select:focus, textarea:focus {
            border-color: black; /* Change border color on focus */
            box-shadow: 0 0 5px black; /* Add box shadow on focus */
        }
        .btn {
            border-radius: 0;
        }
        .table {
            background-color: #fff;
        }
        .table th,
        .table td {
            padding: 12px;
        }
    </style>
</head>
<body>
    <x-navbar>
    </x-navbar>

    <div class="container">
        <div class="card">
            <div class="card-header text-center">
                <h1 class="mb-0">Employee Ratings</h1>
            </div>
            <div class="card-body">
                <!-- Add Rating Form -->
                <form action="{{ route('ratings.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="employee" class="form-label">Select Employee:</label>
                        <select name="employee_id" class="form-select">
                            <option value="">Select Employee</option>
                            @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->firstName }} {{ $employee->lastName }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="rating" class="form-label">Rating:</label>
                        <div class="star-rating">
                            <span class="star" data-rating="1">&#9733;</span>
                            <span class="star" data-rating="2">&#9733;</span>
                            <span class="star" data-rating="3">&#9733;</span>
                            <span class="star" data-rating="4">&#9733;</span>
                            <span class="star" data-rating="5">&#9733;</span>
                        </div>
                        <input type="hidden" name="rating" id="rating" value="0">
                    </div>
                    <div class="mb-3">
                        <label for="comment" class="form-label">Comment:</label>
                        <textarea class="form-control" name="comment" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Rating</button>
                </form>
            </div>
        </div>
    </div>
    @if ($ratings->count() > 0)
    <div class="container mt-5">
        <div class="card">
            <div class="card-header text-center">
                <h2 class="mb-0">Submitted Ratings</h2>
            </div>
            <div class="card-body">
                <table class="table ratings-table">
                    <thead>
                        <tr>
                            <th>Employee Being Rated</th>
                            <th>Rating</th>
                            <th>Comment</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ratings as $rating)
                        <tr>
                            <td>{{ $rating->employee->firstName }} {{ $rating->employee->lastName }}</td>
                            <td>{{ $rating->rating }}</td>
                            <td>{{ $rating->comment }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @else
    <div class="container mt-5">
        <p class="text-center">No ratings found.</p>
    </div>
    @endif
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const stars = document.querySelectorAll('.star');
            const ratingInput = document.getElementById('rating');

            stars.forEach(star => {
                star.addEventListener('click', function() {
                    const rating = parseInt(this.dataset.rating);
                    ratingInput.value = rating;

                    // Remove 'active' class from all stars
                    stars.forEach(s => s.classList.remove('active'));

                    // Add 'active' class to stars up to the selected rating
                    for (let i = 0; i < rating; i++) {
                        stars[i].classList.add('active');
                    }
                });
            });
        });
    </script>
</body>
</html>

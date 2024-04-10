<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Ratings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>

#banner {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 250px; /* You can adjust the height as needed */
    background-image: linear-gradient(to right, rgba(19, 19, 19, 0.922), white);
    padding: 10px;
}
            .navbar{
                justify-content: space-around;
            }


        .container {
            padding: 20px;
        }
        .table {
            margin-bottom: 20px;
        }
        .btn {
            margin-top: 10px;
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
        .rating {
            margin-bottom: 20px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
        }
        .rating p {
            margin: 0;
        }
    </style>
</head>
<body>
    <div id='banner'>
        <img src="https://github.com/RomanMyth/ShiftHappensMotors/blob/Frank/Logo.png?raw=true" alt="ShiftHappensMotors Logo" style="max-width: 280%; max-height: 130%;">
    </div>
    
    <x-navbar>
    </x-navbar>
    <div class="container">
        <h1>Employee Ratings</h1>
        
        <!-- Add Rating Form -->
        <form action="{{ route('ratings.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="employee">Select Employee:</label>
                <select name="employee_id">
                    <option value="">Select Employee</option>
                    @foreach ($employees as $employee)
                    <option value="{{ $employee->id }}">{{ $employee->firstName }} {{ $employee->lastName }}</option>
                    @endforeach                
                </select>
            </div>
            <div class="mb-3">
                <label for="rating">Rating:</label>
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
                <label for="comment">Comment:</label>
                <textarea class="form-control" name="comment" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit Rating</button>
        </form>
    </div>
    
    
    @if ($ratings->count() > 0)
        <div class="container mt-5">
            <h2>Submitted Ratings</h2>
            <table class="table">
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
    @else
        <p>No ratings found.</p>
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

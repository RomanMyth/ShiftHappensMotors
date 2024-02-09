<!DOCTYPE html>
<html lang="en">
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <style>
            .col-lg-3{
                display: flex;
                flex-direction: column;
            }
        </style>
    </head>
<body>
    <div>
        <form action=""method="POST" class=".container p-5">
            <h3>Login</h3>
            <input type ="text" name="emailID" placeholder="Email" required/><br/>
            <input type="password" name="userPass" placeholder="Password" required/><br/>
                <button type="submit">Login</button>
        </form>
        <form action="{{url('/Register')}}" method="" class=".container p-5">
            
            <p>Not Registered?</p>
            <button type="submit">Register Now</button>
        </form>
    </div>
</body>
</html>

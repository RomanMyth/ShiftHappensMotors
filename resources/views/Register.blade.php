

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
    <div class="box">
     
        <form id = "register" method="POST" class=".container p-5">
            <h3>Register</h3>
            
            <label for="first_name">First Name:</label>
            <input placeholder= "First" type="text" name="firstName" id="first_name" required>

            <label for="last_name">Last Name:</label>
            <input placeholder= "Last" type="text" name="lastName" id="last_name" required>

            <label for="email">Email:</label>
            <input placeholder= "example@email.com" id="emailID" name="emailID" id="emailID" required>

            <label for="phone">Phone:</label>
            <input placeholder= "(###)-###-####" type="tel" name="phoneNumber" id="phone" required>

            <label for="password">Password:</label>
            <input placeholder= "password" type="password" name="userPass" id="password" required>
            <div class="checkbox-container">
                <label for="checkbox">Show Password?</label>
                <input type="checkbox" id="checkbox" onclick="showPass()">
            </div>

            <br>

            <label class= "last" for="dob">Date of Birth:</label>
            <input placeholder= "YYYY-MM-DD" type="date" name="DOB" id="dob" required>

          

          
            <button type="submit" name="register">Submit</button>
            <button type="button" onclick="clearFields()">Clear</button>
        </form>
        <br>
        <form id="already" action="{{url('/Login')}}" method="" class=".container p-5">
        
          <p>Already a member?</p>
          <button type="submit">Log In</button>
      </form>
    </div>
    


    <script>
        
        function clearFields() {
            var element = document.getElementById("register");
            element.reset()
        }

        function showPass() {
        var passwordField = document.getElementById('password');
            if (passwordField.type === "password") {
                    passwordField.type = "text";
             } else {
                passwordField.type = "password";
                }
              }
    </script>

    @if(isset($error)) --}}
    <script>
      alert("{{ $error }}")
      </script>
    @endif

</body>
</html>
       

            


  




   


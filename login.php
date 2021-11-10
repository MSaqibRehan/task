<?php
  include 'includes/connection.php';
  include 'includes/sessions.php';
?>
<?php  
   if (isset($_SESSION['logedin_user'])) {
     $_SESSION['message'] = "<li class='text-danger font-weight-bold'>Already Logged In</li>";
     header("location:index.php");
   }
?>
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

        <title>Sign Up </title>
    </head>
    <body>
    <div class="container mt-2 mb-4">
        <?php 
            if (isset($_SESSION['message'])) {
                message();
            }
        ?>
        <div class="col-sm-8 ml-auto mr-auto">
            <ul class="nav nav-pills nav-fill mb-1" id="pills-tab" role="tablist">
                <li class="nav-item"> <a class="nav-link active" id="pills-signin-tab" data-toggle="pill" href="#pills-signin" role="tab" aria-controls="pills-signin" aria-selected="true">Sign In</a> </li>
                <li class="nav-item"> <a class="nav-link" id="pills-signup-tab" data-toggle="pill" href="#pills-signup" role="tab" aria-controls="pills-signup" aria-selected="false">Sign Up</a> </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-signin" role="tabpanel" aria-labelledby="pills-signin-tab">
                    <div class="col-sm-12 border border-primary shadow rounded pt-2">
                        <form method="post" action="controller.php" id="singninFrom">
                            <div class="form-group">
                                <label class="font-weight-bold">Username <span class="text-danger">*</span></label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Enter Username" >
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Password <span class="text-danger">*</span></label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="***********" >
                            </div>
                            
                            <div class="form-group">
                                <input type="submit" name="submitlogin" value="Sign In" class="btn btn-block btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-signup" role="tabpanel" aria-labelledby="pills-signup-tab">
                    <div class="col-sm-12 border border-primary shadow rounded pt-2">
                        <form method="post" action="controller.php" id="singnupFrom">
                            <div class="form-group">
                                <label class="font-weight-bold">Full Name <span class="text-danger">*</span></label>
                                <input type="text" name="signupfullname" id="signupfullname" class="form-control" placeholder="Enter your Full name" >
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Email <span class="text-danger">*</span></label>
                                <input type="email" name="signupemail" id="signupemail" class="form-control" placeholder="Enter valid email" >
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">User Name <span class="text-danger">*</span></label>
                                <input type="text" name="signupusername" id="signupusername" class="form-control" placeholder="Choose your user name" >
                                <div class="text-danger"><em>This will be your login name!</em></div>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Phone #</label>
                                <input type="text" name="signupphone" id="signupphone" class="form-control" placeholder="(000)-(0000000)">
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Password <span class="text-danger">*</span></label>
                                <input type="password" name="signuppassword" id="signuppassword" class="form-control" placeholder="***********"   >
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Confirm Password <span class="text-danger">*</span></label>
                                <input type="password" name="signupcpassword" id="signupcpassword" class="form-control"  placeholder="***********" >
                            </div>
                            
                            <div class="form-group">
                                <input type="submit" name="signupsubmit" value="Sign Up" class="btn btn-block btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
   

    
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            $('#singnupFrom').submit(function(e) {
                
                var signupfullname = $('#signupfullname').val();
                var signupusername = $('#signupusername').val();
                var signupphone = $('#signupphone').val();
                var signupemail = $('#signupemail').val();
                var signuppassword = $('#signuppassword').val();
                var signupcpassword = $('#signupcpassword').val();
                var valid =true;
                $(".error").remove();
                if (signupfullname.length < 1) {
                    $('#signupfullname').after('<span class="error text-danger">This field is required</span>');
                    valid = false;
                }
                if (signupusername.length < 1) {
                   
                    $('#signupusername').after('<span class="error text-danger">This field is required</span>');
                    valid = false;
                    
                }
                if (signupphone.length < 1) {
                   
                    $('#signupphone').after('<span class="error text-danger">This field is required</span>');
                    valid = false;
                }
                if (signupemail.length < 1) {
                   
                    $('#signupemail').after('<span class="error text-danger">This field is required</span>');
                    valid = false;
                } else {
                   
                    var regEx =  /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i;
                    var validsignupemail = regEx.test(signupemail);
                    if (!validsignupemail) {
                        $('#signupemail').after('<span class="error text-danger">Enter a valid email</span>');
                        valid = false;

                    }
                }
                if (signuppassword.length < 6 || signupcpassword.length < 6) {
                   
                    $('#signupcpassword').after('<span class="error text-danger">Password must be at least 6 characters long</span>');
                    valid = false;
                }
                if(signuppassword != signupcpassword){
                   
                    $('#signupcpassword').after('<span class="error text-danger">Passwords do not match</span>');
                    valid = false;
                }
                if (valid==false) {
                    return false;
                }
               
            });


            $('#singninFrom').submit(function(e) {
                
                var username = $('#username').val();
                var password = $('#password').val();
               var valid =true;
                $(".error").remove();
                if (username.length < 1) {
                    $('#username').after('<span class="error text-danger">This field is required</span>');
                    valid = false;
                }
                if (password.length < 1) {
                    $('#password').after('<span class="error text-danger">This field is required</span>');
                    valid = false;
                }
                if (valid==false) {
                    return false;
                }
               
            });

        });
        
    </script>
  </body>
</html>
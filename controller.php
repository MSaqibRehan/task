<?php
  include 'includes/connection.php';
  include 'includes/sessions.php';
?>
<?php 
	if (isset($_POST['signupsubmit'])) {
        $signupemail = mysqli_real_escape_string($conn , $_POST['signupemail']);
        $signupfullname = mysqli_real_escape_string($conn , $_POST['signupfullname']);
        $signupusername = mysqli_real_escape_string($conn , $_POST['signupusername']);
        $signupcpassword = mysqli_real_escape_string($conn , $_POST['signupcpassword']);
        $signupphone = mysqli_real_escape_string($conn , $_POST['signupphone']);
       
        date_default_timezone_set("Asia/Karachi");
       	$date =  date("Y-m-d H:i:s");
       
        

   
       if (empty($signupfullname) || empty($signupusername) || empty($signupemail) || empty($signupcpassword) ) {
            $_SESSION['message'] = null;
            $_SESSION['message'] .= "<li>Please Fill All Required Fields</li>"; 
            echo "<script>location='login.php'</script>";         
            
          
          }else{
            $pass = md5($signupcpassword);
            $query = "INSERT INTO `users`(`name`,`username`, `email`, `phone`, `password`, `created_at`) VALUES('{$signupfullname}' ,'{$signupusername}' , '{$signupemail}' , '{$signupphone}' , '{$pass}','{$date}')";
            if (mysqli_query($conn , $query)) {
            	$_SESSION['logedin_user'] = $signupusername;
			    $emailsubject = "Confirmation"; 
			    $emailmessage = "Thank You For Registration";
			    $emailheaders = "From:Registration Form ";
			    'X-Mailer: PHP/' . phpversion();
			    mail($signupemail, $emailsubject, $emailmessage, $emailheaders);
              $_SESSION['message'] = "Thank You For Registration";
              echo "<script>location='index.php'</script>";
              
            }else{
              $_SESSION['message'] = mysqli_error($conn);
              echo "<script>location='login.php'</script>";
              
            }
          }
        }

     if(isset($_POST['submitlogin'])) {
        // username and password sent from form 
        
        $username = $_POST['username'];
        $password = $_POST['password']; 
        
       

        if ( empty($username) || empty($password) ) {

            $_SESSION['message'] = null;
            $_SESSION['message'] .= "<li>Please Enter Username And Password</li>" ;
            echo "<script>location='login.php'</script>";
            
          
          }else{
            $pass=md5($password);
            $sql = "SELECT * FROM users WHERE username = '$username' and password = '$pass'";
            $result = mysqli_query($conn,$sql);
            $row = mysqli_fetch_assoc($result);
                       

           $count = mysqli_num_rows($result);
        
            // If result matched $username and $password, table row must be 1 row
          
            if($count == 1) {
               $_SESSION['logedin_user'] = $username;
               $_SESSION['message']   = "Welcome : ".$username ;
               echo "<script>location='index.php'</script>";
               
            }else {
               $_SESSION['message'] = "Invalid Username or password";
               echo "<script>location='login.php'</script>";
            }
          }
        
     }
?>
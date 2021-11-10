<?php 
	  include 'includes/sessions.php';
 ?>
<?php   


session_destroy(); //destroy the session

header("location:login.php"); //to redirect back to "index.php" after logging out

?>
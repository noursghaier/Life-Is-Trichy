<?php
$conn= mysqli_connect("localhost", "root", "", "life-is-trichy");
if (!$conn)
       {
          die("Connection failed: ".mysqli_connect_error());
	    }
if (isset($_POST['signup-submit']))
       {
         $username = $_POST['username'];
		 $mail = $_POST['mail'];
		 $pwd = $_POST['pwd'];
		 $pwd_repeat = $_POST['pwd-repeat'];
		 
		 if(empty($username) || empty($mail) || empty($pwd) || empty($pwd_repeat)){
			 
			 header("location: signup.php?error=emptyfields&username=".$username."&mail=".$mail);
			 exit();
			 
		 }
		 else if(!filter_var($mail, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)){
                  header("location: signup.php?error=invalidmail&username");
			 exit();		 
		 }
		 else if(!filter_var($mail, FILTER_VALIDATE_EMAIL)){
                  header("location: signup.php?error=invalidmail&username=".$username);
			 exit();		 
		 }
		 
		  else if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
                  header("location: signup.php?error=invalidusername&mail=".$mail);
			 exit();		 
		 }
		 
		 else if($pwd !== $pwd_repeat){
                  header("location: signup.php?error=passwordcheck&username=".$username."&mail=".$mail);
			 exit();		 
		 }
		 else{
			 
			$sql="SELECT username FROM user WHERE username=?"; 
			$stmt= mysqli_stmt_init($conn);
			if(!mysqli_stmt_prepare($stmt, $sql)){
				header("location: signup.php?error=sqlerror");
			 exit();
				
			}
			else{
				mysqli_stmt_bind_param($stmt, "s", $username);
				mysqli_stmt_execute($stmt);
				mysqli_stmt_store_result($stmt);
				$resultCheck= mysqli_stmt_num_rows($stmt);
				if ($resultCheck > 0){
					header("location: signup.php?error=usertaken&mail=".$mail);
			 exit();
					
				}
				
				else{
					
				$sql="INSERT INTO user (`username`,mail,pwd) VALUES (?, ?, ?) ";	
				$stmt= mysqli_stmt_init($conn);	
				if(!mysqli_stmt_prepare($stmt, $sql)){
				header("location: signup.php?error=sqlerror");
			 exit();
				
			}
			else{
				$hashedPwd = password_hash($pwd,PASSWORD_DEFAULT);
				mysqli_stmt_bind_param($stmt, "sss", $username, $mail, $pwd );
				mysqli_stmt_execute($stmt);
				header("location: shareyourstory.php?=success");
			 exit();
			}
				}
			}
			 
		 }
		 
		 mysqli_stmt_close($stmt);
		 mysqli_close($conn);
	    }
		else{
			header("location: signup.php");
			 exit();
		}

?>
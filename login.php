<?php 
$conn= mysqli_connect("localhost", "root", "", "life-is-trichy");
if (!$conn)
       {
          die("Connection failed: ".mysqli_connect_error());
	    }
if(isset($_POST['loginSubmit'])){
	
$username = $_POST['username'];
		 
$pwd = $_POST['pwd']; 

if ( empty($uid) || empty($pwd))	{
	header("location: shareyourstory.php?error=emptyfields");
			 exit();	
}	 

else{
	$sql="SELECT * FROM user WHERE username=? ;";
	$stmt= mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sql)){
		
		header("location: shareyourstory.php?error=sqlerror");
			 exit();	
	}
	else{
		mysqli_stmt_bind_param($stmt, "ss", $uid, $uid);
	mysqli_stmt_execute($stmt);
	$result= mysqli_stmt_get_result($stmt);
		if ($row = mysqli_fetch_assoc($result)){
			$pwdCheck = password_verify($pwd, $row['pwd']);
			if ($pwdCheck == false){
				header("location: shareyourstory.php?error=wrongpwd");
			 exit();
				
				
			}
			else if ($pwdCheck == true){
				session_start();
		  $_SESSION['id'] = $row['id'];
		  $_SESSION['username'] = $row['username'];
			
			
           header("location: shareyourstory.php?login=success");
			 exit();
				
			}
			else {
				header("location: shareyourstory.php?error=wrongpwd");
			 exit();
				
			}
			
		}
		else{
			header("location: shareyourstory.php?error=nouser");
			 exit();
			
		}
	}
	
	
}


}

else{
	header("location: shareyourstory.php");
			 exit();
}




?> 























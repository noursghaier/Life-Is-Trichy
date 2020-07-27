<?php

$conn= mysqli_connect("localhost", "root", "", "life-is-trichy");
if (!$conn)
       {
          die("Connection failed: ".mysqli_connect_error());
	    }


function setComments($conn){
	if (isset($_POST['commentSubmit']))
       {
         $uid = $_POST['username'];
		 $date = $_POST['date'];
		 $message = $_POST['message'];
		 
		 $sql = "INSERT INTO `comments` (`uid`, `date`, `message`) VALUES ('$uid', '$date', '$message') ";
		
		$result= mysqli_query($conn, $sql);
		header("Location: shareyourstory.php?messageinserted");
	    }
	
	} 
	
	
function getComments($conn){
	$sql = "SELECT * FROM comments";
	$result= mysqli_query($conn, $sql);
	while ($row = mysqli_fetch_assoc($result)){
		
		echo "<div class='container' id='comment-box'><p>";
		echo $row['uid']."<br>";
		echo $row['date']."<br>";
		echo nl2br($row['message']);
		echo "</p>
		
		<form class='delete-form' action='".deleteComments($conn)."' method='post'>
		<input type='hidden' name='cid' value='".$row['cid']."'>
<button type='submit' name='commentDelete' >Delete </button>

</form>


		
		<form class='edit-form' action='editcomment.php' method='post'>
<input type='hidden' name='cid' value='".$row['cid']."'>
<input type='hidden' name='uid' value='".$row['uid']."'>
<input type='hidden' name='date' value='".$row['date']."'>
<input type='hidden' name='message' value='".$row['message']."'>
<button >Edit </button>

</form>
		
		</div>";
	}
	}
		
	
	
	
	
	function editComments($conn){
	if (isset($_POST['commentSubmit']))
       {
		   $cid = $_POST['cid'];
         $uid = $_POST['uid'];
		 $date = $_POST['date'];
		 $message = $_POST['message'];
		 
		 $sql = "UPDATE comments SET `message`='$message' WHERE cid='$cid' ";
		$result= mysqli_query($conn, $sql);
		header("Location: shareyourstory.php");
		 
	    }
	
	} 
	
	function deleteComments($conn){
	          if (isset($_POST['commentDelete']))
       {
		   $cid = $_POST['cid'];
		 $sql = "DELETE FROM comments WHERE cid='$cid'";
		
		$result= mysqli_query($conn, $sql);
		header("Location: shareyourstory.php");
		exit();
	    }
	    }
		
		
		function getLogin($conn){ 
		if (isset($_POST['loginSubmit'])){
			
			$username= $_POST['username'];
			$pwd= $_POST['pwd'];
		
	$sql = "SELECT `uid`, `username`, pwd FROM user WHERE `username`='$username' AND pwd='$pwd'";
	$result= mysqli_query($conn, $sql);
	if(mysqli_num_rows($result) > 0){
	if($row = mysqli_fetch_assoc($result)){
		$_SESSION['uid'] = $row['uid'];
		$_SESSION['username'] = $row['username'];
		header("Location: shareyourstory.php?loginsuccess");
		exit();}
	 }	
	 
	 else{
		header("Location: shareyourstory.php?loginfailed");
		exit();
	}
	}
	}
	
	
	function userLogout(){
		if (isset($_POST['logoutSubmit'])){
			session_start();
			session_destroy();
			header("Location: shareyourstory.php");
			exit();
			
			}
			}
		
		
		
		
	
?>

<!DOCTYPE html>
<html lang="en">

  <head>
      <link rel="icon"  
      href="res/logo.png">

      <title>Life is trichy</title>
      <meta charset="utf-8">
	  
	 

  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  
  
  
    
	<style>
	#comment-box{
		width: 100%;
            background-color: #dee;
            padding: 20px;
            margin-bottom: 8px;
			border-radius:4px;
			position:relative;
			}
			
			 .edit-form button {
  background-color: #dee; 
    border-color: #fff;
  color: black;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  margin: 4px 2px;
  cursor: pointer;
  opacity: 0.7;

}

.edit-form button:hover {
    opacity: 1;

}
       
 
		  
		  .edit-form{
		  position: absolute;
			top: 0px;
			right: 0px;
          }
		  
		  
		  .delete-form button {
  background-color: #dee; 
    border-color: #fff;
  color: black;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  margin: 4px 2px;
  cursor: pointer;
  opacity: 0.7;

}

.delete-form button:hover {
    opacity: 1;

}
       
 
		  
		  .delete-form{
		  position: absolute;
			top: 0px;
			right: 100px;
          }
		  
		  
	
	</style>
	
	
    </head>

</html>	
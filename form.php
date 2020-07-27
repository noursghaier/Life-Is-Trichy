<?php


$link = mysqli_connect("localhost", "root", "", "life-is-trichy");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Escape user inputs for security
$fname = mysqli_real_escape_string($link, $_REQUEST['fname']);
$lname = mysqli_real_escape_string($link, $_REQUEST['lname']);
$mail = mysqli_real_escape_string($link, $_REQUEST['mail']);
$subject = mysqli_real_escape_string($link, $_REQUEST['subject']);

// Attempt insert query execution
$sql = "INSERT INTO form (fname, lname, mail, subject) VALUES ('$fname', '$lname', '$mail', '$subject')";
if(mysqli_query($link, $sql)){
	
	header("location: index.php?datainsert=success");
} else{
	  header("location: index.php?datainsert=failed");
} 
 
// Close connection
mysqli_close($link);

?>
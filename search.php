<?php
   include 'header.php';
?>



<!--navbar-->
<div class="container">
    <nav class="navbar navbar-expand-lg py-3 navbar-dark bg-dark shadow-sm fixed-top transparent">
        <div class="container">
            <a href="index.php" class="navbar-brand">
                <!-- Logo Image -->
                <img src="res/logo.png" width="30" alt="" class="d-inline-block align-middle mr-2">
                <!-- Logo Text -->
                <span class="text-uppercase font-weight-bold">Life is trichy</span>
            </a>

            <button type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler"><span class="navbar-toggler-icon"></span></button>

            <div id="navbarSupportedContent" class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active"><a href="index.php" class="nav-link">Home <span class="sr-only">(current)</span></a></li>
                    <li class="nav-item"><a href="index.php#1" class="nav-link">Trich</a></li>
                    <li class="nav-item"><a href="index.php#2" class="nav-link">Mental Health</a></li>
                    <li class="nav-item"><a href="index.php#3" class="nav-link">Contact Us</a></li>
					<li class="nav-item"><a href="shareyourstory.php" class="nav-link">Share your story</a></li>
                </ul>

                

            </div>


        </div>
    </nav>
</div>


<div class="rectangle" style="margin-top: 130px">
<h1> Search page </h1>
   <?php
      if (isset($_POST['submit-search']))
       {
            $search= mysqli_real_escape_string($conn, $_POST['search'] );
			$sql = "SELECT * FROM comments WHERE message LIKE '%$search%'";
            $result = mysqli_query($conn, $sql);
			$queryResult= mysqli_num_rows($result);
			
			echo "There are ".$queryResult." results! ";
			echo"<br><br>";
			if ($queryResult > 0) {
	                  while($row = mysqli_fetch_assoc($result)){
						       echo "<div>
                  
                             <p>  ".$row['message']." <br> <br></p>
                        
                                    </div>";
								
						  
						           }
	              } else {
	                     echo "There are no results matching your search!";
                          }

	    }
   
   
   ?>
 

</div>
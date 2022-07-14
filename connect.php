<?php




$username="root";
$server="localhost";
$password="";
$database="students";


$con= mysqli_connect($server, $username, $password,$database);



if(!$con)
{
  die("connection failed due to  ". 
   mysqli_connect_error());

}
else
echo "connected";


$email=$_POST['email'];
  $password=$_POST['password'];


  $sql= "INSERT INTO 'students'.'new' ( `email`, `password`, ) VALUES ('$email','$password',')";

  echo $sql;

 if(mysqli_query($con, $sql)){  

    echo "Record inserted successfully";  
   
   }else{  
   
   echo "Could not insert record: ". mysqli_error($con);  
   
   }  
   
   mysqli_close($conn);  





?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="new.css">
    <title>college </title>
</head>
<body>

<!----------=-----------------header  and navabar -------------------------->

<!----------------form-------------->


<div class="container">

    <div class="signup">

        <form action="connect.php" method="post">
 
            <input type="text" name="fullname "  id="fullname" placeholder="Full name"><br>
            <input type="email" name="email" id="email" placeholder="Email"><br>
            <input type="password" name="password" id="password" placeholder="Password"><br>

            <button class="btn"> Sign Up</button>




        </form>


    </div>



</div>
    
</body>
</html>

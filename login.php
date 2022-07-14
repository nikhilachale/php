<?php

$username="root";
  $server="localhost";
  $password="";
  $database="students";
  


  $conn= mysqli_connect($server, $username, $password,$database);
  if(!$conn)
  {
    die("connection failed due to  ". 
     mysqli_connect_error());

  }
  

  
  $email=$_POST['email'];
  $password=$_POST['password'];
  

  $query ="SELECT * FROM `new` WHERE email='$email'";
  $result = mysqli_query($conn, $query);

  if($result)
  {
    if(mysqli_num_rows($result)==1)
    {
      echo "user found";
        $result_fetch=mysqli_fetch_array($result);
        $pass=$result_fetch['password'];
        echo $pass ;
       
        echo $password;
        // if(password_verify($password,$pass))
        if($password==$pass)
        {
             echo" correct password;
             
             <script>
             window.location.href='index.html';
             </script> ";
        }
         else{
            echo "incorrect password";
            
         }

    }   

    else
    {
        echo "not registered";
    }
  }
  else{
    echo "query not run";
  }


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

        <form action="login.php" method="post">
 
            
            <input type="email" name="email" id="email" placeholder="Email"><br>
            <input type="password" name="password" id="password" placeholder="Password"><br>
            


            <button class="btn">login</button>




        </form>


    </div>



</div>
    
</body>
</html>

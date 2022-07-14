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

  $showAlert = false;
$showError = false;
$exists=false;

// //Import PHPMailer classes into the global namespace
// //These must be at the top of your script, not inside a function
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
// use PHPMailer\PHPMailer\Exception;



  
 error_reporting(0);
  
  $email=$_POST['email'];
  $password=$_POST['password'];
  $cpassword = $_POST["cpassword"];
  

//   #function for mail check

//   function sendmail($email,$v_code)
//   {
// 	//Load Composer's autoloader
// require 'mail/PHPMailer.php';
// require 'mail/SMTP.php';
// require 'mail/Exception.php';
// //Create an instance; passing `true` enables exceptions
// $mail = new PHPMailer(true);
// try {
    
//     $mail->isSMTP();                                            //Send using SMTP
//     $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
//     $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
//     $mail->Username   = 'nicachale456@gmail.com';                     //SMTP username
//     $mail->Password   = '9752034120';                               //SMTP password
//     $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
//     $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

//     //Recipients
//     $mail->setFrom('nicachale456@gmail.com', 'web dev ');
//     $mail->addAddress($email);     //Add a recipient
   

//     //Attachments
//     // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
//     // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

//     //Content
//     $mail->isHTML(true);                                  //Set email format to HTML
//     $mail->Subject = ' Email verification from teacher ';
//     $mail->Body    = "Thanks for registration :
// 		click the link below to verify email address
// 		<a href="http://localhost/try/verify.php?email=$email&v_code=$v_code"> Verify</a>";
//     $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

//     $mail->send();
//     echo 'Message has been sent';
// } catch (Exception $e) {
//     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
// }



//   }

  #function of referal code
  function  updateReferal(){

	$referalcode=$_POST['refralcode']; 
	 $query="SELECT * FROM `new` WHERE refralcode='$referalcode'";
	 $result=mysqli_query($GLOBALS['conn'],$query);
	 if($result){

		if(mysqli_num_rows($result)==1){
			$result_fetch=mysqli_fetch_assoc($result);
			$points=$result_fetch['referpoints']+20;
      $v_code=$v_code+10;
			$update_query="UPDATE `new` SET `referpoints`='$points' WHERE `email`='$result_fetch[email]'"; 	
			if(!mysqli_query($GLOBALS['conn'],$update_query))
			{
					exit;
					 
			}


		}

	 }
	 else{
		echo "not run ";
	 }
  }

  $v_code=(bin2hex(random_bytes(16)));
		
  

  $sql = "Select * from new where email ='$email'";
	
	$result = mysqli_query($conn, $sql);
	
	$num = mysqli_num_rows($result);
  
	
	// This sql query is use to check if
	// the username is already present
	// or not in our Database
	if($num == 0) {

		if($_POST['refralcode']!='')
		{
			updateReferal();
		}

		
		$referal_code=strtoupper(bin2hex(random_bytes(4)));
		if(($password == $cpassword) && $exists==false) {
			
			// $hash = password_hash($password,
			// 					PASSWORD_DEFAULT);
				
			// Password Hashing is used here.
			

			$sql="INSERT INTO `new`(`email`, `password`, `date`, `refralcode`, `referpoints`, `v_code`, `verified`) VALUES ('$email','$password',current_timestamp(),'$referal_code','0','$v_code _code','0')";
			// $sql = "INSERT INTO `new`(`email`, `password`, `date`, `refralcode`, `referpoints`,'v_code','verified') VALUES ('$email','$hash',current_timestamp(),'$referal_code','0','$v_code',0)";
			
#sendmail($_POST['email'],$v_code)
  if(mysqli_query($conn,$sql)){

    echo "registration successfully;
    <script>
    window.location.href='index.html';
    </script>";
}
else{
 echo "query not registered";
}
	
			if ($result) {
				$showAlert = true;
			}
		}
		else {
			$showError = "Passwords do not match";
		}	
	}// end if
	
// if($num>0)
// {
// 	$exists="Email  not available";
// }
	
//end 
 

  
  $conn->close();

#}
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <!-- Style -->
    <link rel="stylesheet" href="style.css">

    <title>Sign Up</title>
  </head>
  <body>


  <?php
	
	if($showAlert) {
	
		echo ' <div class="alert alert-success
			alert-dismissible fade show" role="alert">
	
			<strong>Success!</strong> Your account is
			now created and you can login.
			<button type="button" class="close"
				data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
		</div> ';
	}
	
	if($showError) {
	
		echo ' <div class="alert alert-danger
			alert-dismissible fade show" role="alert">
		<strong>Error!</strong> '. $showError.'
	
	<button type="button" class="close"
			data-dismiss="alert aria-label="Close">
			<span aria-hidden="true">×</span>
	</button>
	</div> ';
}
		
	if($exists) {
		echo ' <div class="alert alert-danger
			alert-dismissible fade show" role="alert">
	
		<strong>Error!</strong> '. $exists.'
		<button type="button" class="close"
			data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">×</span>
		</button>
	</div> ';
	}

?>
	


      <!-- Topbar Start -->
      <div class="container-fluid d-none d-lg-block">
        <div class="row align-items-center py-4 px-xl-5">
            <div class="col-lg-11">
                <a href="file:///C:/Users/HP/webpro/Project-Site/index.html" class="text-decoration-none ">
                    <h1 class="m-2" ><span class="text-primary">S</span>mart and Bright Future Academy</h1>
                </a>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid">
        <div class="row border-top px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="d-flex align-items-center justify-content-between bg-secondary w-100 text-decoration-none" data-toggle="collapse" href="#navbar-vertical" style="height: 67px; padding: 0 30px;">
                    <h5 class="text-primary m-0"><i class="fa fa-book-open mr-2"></i>ClassWise Courses</h5>
                    <i class="fa fa-angle-down text-primary"></i>
                </a>
                <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 9;">
                    <div class="navbar-nav w-100">
                            <a href="#" class="nav-link" data-toggle="dropdown">Class 1</a>
                            <!-- <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                                <a href="" class="dropdown-item">HTML</a>
                                <a href="" class="dropdown-item">CSS</a>
                                <a href="" class="dropdown-item">jQuery</a>
                            </div> -->
                        
                        <a href="" class="nav-item nav-link">Class 2</a>
                        <a href="" class="nav-item nav-link">Class 3</a>
                        <a href="" class="nav-item nav-link">Class 4</a>
                        <a href="" class="nav-item nav-link">Class 5</a>
                        <a href="" class="nav-item nav-link">Class 6</a>
                        <a href="" class="nav-item nav-link">Class 7</a>
                        <a href="" class="nav-item nav-link">Class 8</a>
                        <a href="" class="nav-item nav-link">Class 9</a>
                        <a href="" class="nav-item nav-link">Class 10</a>
                </nav>
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <h1 class="m-0"><span class="text-primary">S</span>mart and bright future Acedemy</h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav py-0">
                            <a href="index.html" class="nav-item nav-link active">Home</a>
                            <a href="about.html" class="nav-item nav-link">About</a>
                            <a href="course.html" class="nav-item nav-link">Courses</a>
                            <a href="contact.html" class="nav-item nav-link">Contact</a>
                        </div>
                        <a class="btn btn-primary py-2 px-4 ml-auto d-none d-lg-block" href="../Project-Site/login/index.html">Login Now</a>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->
    <!--------------------login form ------------------->
  

  
  <div class="content">
    <div class="container">
      
            <div class="col-md-8">
              <div class="mb-4">
              <h3>Sign In</h3>
              <p class="mb-4">Your success is our passion</p>
            </div>
            <form action="index.php" method="post">
 
            
              <input type="email" name="email" id="email" placeholder="Email"><br>
              <input type="password" name="password" id="password" placeholder="Password"><br>
              <input type="password" id="cpassword" name="cpassword" placeholder="CPassword"><br>
        <input type="text" name="refralcode" id="refralcode" placeholder="Referral Code">
  
              <div class="btn"><button> Sign Up</button></div>
              
  
            </form>
            </div>
          </div>
          
    </div>
 

  
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>
<?php 
 include 'inc/auth/header.php';
 // Registration Php Code Starts here

 if(isset($_POST) && !empty($_POST)) { 
   $errors = array();	
   $success=array();
   $failure=array();
   if(empty($_POST['fullname'])){		
			$errors[] = 'Please enter your full name';
		} else {
			$fullname = htmlspecialchars(trim(mysqli_real_escape_string($dbc,$_POST['fullname'])));	
		}

  if(empty($_POST['username'])){		
			$errors[] = 'Please enter your username';
		} else {
			$username = htmlspecialchars(trim(mysqli_real_escape_string($dbc,$_POST['username'])));	
		}

 if(empty($_POST['email'])){		
    $errors[] = 'Please enter your email';
   } else {
    $email = htmlspecialchars(trim(mysqli_real_escape_string($dbc,$_POST['email'])));	
   }

 if(empty($_POST['password'])){		
  $errors[] = 'Please enter your password';
 } else {
  $password = htmlspecialchars(trim(mysqli_real_escape_string($dbc,$_POST['password'])));	
 }

 if(empty($_POST['repassword'])){		
    $errors[] = 'Please enter your re-type password';
   } else {
    $repassword = htmlspecialchars(trim(mysqli_real_escape_string($dbc,$_POST['repassword'])));	
   }

 if($_POST['password'] !=$_POST['repassword']){		
    $errors[] = 'Your password and confirm password does not match';
   } 
  
 if(empty($_POST['terms'])){		
    $errors[] = 'Please check the terms and conditions';
   } else {
    $terms = htmlspecialchars(trim(mysqli_real_escape_string($dbc,$_POST['terms'])));	
   }

 if(empty($errors)){	
  $hashpassword=sha1($password);
  $insert = "INSERT INTO users (fullname, username, email, password, join_date)
						VALUES ('$fullname','$username','$email','$hashpassword', Now())";		
			$result = mysqli_query($dbc, $insert);	
			if($result) {
     $success[]='Your registration has been submitted for Admin approval';
			   

   } else{ 
    $failure[]='Your registration was not submitted';
     
			   
   }
 }
}



?>

<body class="hold-transition register-page">
 <div class="register-box">
  <div class="card card-outline card-primary">
   <div class="card-header text-center">
    <a href="" class="h1"><b>Blog</b>Page</a>
   </div>
   <div class="card-body">
    <p class="login-box-msg">Register a new membership</p>
    <?php 
	      if(!empty($errors)){
		      foreach($errors as $error){	
                        echo'<div class="alert alert-danger" role="alert">';
                              echo $error;
                        echo'</div>'; 				
		      }
	     
	      } if(!empty($success)){
           
		      foreach($success as $successes){	
                        echo'<div class="alert alert-success" role="alert">';
                              echo $successes;
                        echo'</div>'; 				
		      }
            } if(!empty($failure)){
           
		      foreach($falure as $failures){	
                        echo'<div class="alert alert-danger" role="alert">';
                              echo $falures;
                        echo'</div>'; 				
		      }
            }
      ?>
    <form action="" method="post">
     <div class="input-group mb-3">
      <input type="text" name="fullname" class="form-control" placeholder="Full name">
      <div class="input-group-append">
       <div class="input-group-text">
        <span class="fas fa-user"></span>
       </div>
      </div>
     </div>
     <div class="input-group mb-3">
      <input type="text" name="username" class="form-control" placeholder="Username">
      <div class="input-group-append">
       <div class="input-group-text">
        <span class="far fa-user"></span>
       </div>
      </div>
     </div>
     <div class="input-group mb-3">
      <input type="email" name="email" class="form-control" placeholder="Email">
      <div class="input-group-append">
       <div class="input-group-text">
        <span class="fas fa-envelope"></span>
       </div>
      </div>
     </div>
     <div class="input-group mb-3">
      <input type="password" name="password" class="form-control" placeholder="Password">
      <div class="input-group-append">
       <div class="input-group-text">
        <span class="fas fa-lock"></span>
       </div>
      </div>
     </div>
     <div class="input-group mb-3">
      <input type="password" name="repassword" class="form-control" placeholder="Retype password">
      <div class="input-group-append">
       <div class="input-group-text">
        <span class="fas fa-lock"></span>
       </div>
      </div>
     </div>
     <div class="row">
      <div class="col-8">
       <div class="icheck-primary">
        <input type="checkbox" id="agreeTerms" name="terms" value="agree">
        <label for="agreeTerms">
         I agree to the <a href="#">terms</a>
        </label>
       </div>
      </div>
      <!-- /.col -->
      <div class="col-4">
       <input type="submit" name="register" class="btn btn-primary btn-block" value="Register">
      </div>
      <!-- /.col -->
     </div>
    </form>

    <div class="social-auth-links text-center">
     <a href="#" class="btn btn-block btn-primary">
      <i class="fab fa-facebook mr-2"></i>
      Sign up using Facebook
     </a>
     <a href="#" class="btn btn-block btn-danger">
      <i class="fab fa-google-plus mr-2"></i>
      Sign up using Google+
     </a>
    </div>

    <a href="index.php" class="text-center">I already have a membership</a>
   </div>
   <!-- /.form-box -->
  </div><!-- /.card -->
 </div>
 <!-- /.register-box -->

 <?php 
 include 'inc/auth/footer.php';
?>
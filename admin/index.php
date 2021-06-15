<?php 
 include 'inc/auth/header.php';
// Check login php code start here 

  if(isset($_POST['login'])){ 
   $error = array();
   $loginerror=array();	
   $email=mysqli_real_escape_string($dbc,$_POST['email']);
   $password=mysqli_real_escape_string($dbc,$_POST['password']);
   $hashpassword=sha1($password);
   $query="SELECT * FROM users WHERE email='$email' AND status=1";
   $queryData=mysqli_query($dbc,$query);
   $countData=mysqli_num_rows($queryData);
   if ($countData>0) { 
     while($row=mysqli_fetch_array($queryData)){ 
      $_SESSION['user_id']   =$row['user_id'];
      $_SESSION['fullname']  =$row['fullname'];
      $_SESSION['username']  =$row['username'];
      $_SESSION['email']     =$row['email'];
      $_SESSION['status']    =$row['status'];
      $_SESSION['user_role'] =$row['user_role'];
      $password              =$row['password'];
      $phone                 =$row['phone'];
      $address               =$row['address'];
      $image                 =$row['image'];
      $join_date             =$row['join_date'];

      if($_SESSION['email']==$email && $password==$hashpassword) { 
       
       header("Location:dashboard.php");

      } else if ($_SESSION['email']!=$email || $password!=$hashpassword) { 

        $loginerror[]="Invalid username or password";

      } else if ($_SESSION['status'] !=1) { 

        $loginerror[]="You are not an active user";

      } 
      
      else { 

        header("Location:index.php");

      }
      
     }
   } else if ($countData<=0){ 
     $error[]="You are not an active user";
   }
   
  }
?>

<body class="hold-transition login-page">
 <div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
   <div class="card-header text-center">
    <a href="" class="h1"><b>Blog</b>Page</a>
   </div>
   <div class="card-body">
    <p class="login-box-msg">Sign in to start your session</p>
    <?php
     if(!empty($error)){
      foreach($error as $errors){	?>

    <div class="alert alert-danger"><?php echo $errors; ?></div>

    <?php 
      }
     }
    ?>
    <?php
     if(!empty($loginerror)){
      foreach($loginerror as $loginerrors){	?>

    <div class="alert alert-danger"><?php echo $loginerrors; ?></div>

    <?php 
      }
     }
    ?>
    <form action="" method="post">
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
     <div class="row">
      <div class="col-8">
       <div class="icheck-primary">
        <input type="checkbox" id="remember">
        <label for="remember">
         Remember Me
        </label>
       </div>
      </div>
      <!-- /.col -->
      <div class="col-4">
       <input type="submit" name="login" class="btn btn-primary btn-block" value="Sign In">
      </div>
      <!-- /.col -->
     </div>
    </form>

    <div class="social-auth-links text-center mt-2 mb-3">
     <a href="#" class="btn btn-block btn-primary">
      <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
     </a>
     <a href="#" class="btn btn-block btn-danger">
      <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
     </a>
    </div>
    <!-- /.social-auth-links -->

    <p class="mb-1">
     <a href="forgot-password.php">I forgot my password</a>
    </p>
    <p class="mb-0">
     <a href="register.php" class="text-center">Register a new membership</a>
    </p>
   </div>
   <!-- /.card-body -->
  </div>
  <!-- /.card -->
 </div>
 <!-- /.login-box -->






 <?php 
 include 'inc/auth/footer.php';
?>
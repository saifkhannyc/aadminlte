<?php 
include 'inc/admin/header.php';
include 'inc/admin/topbar.php';
include 'inc/admin/menubar.php';
 $success=array();
?>

<!-- Body Content Start -->
<div class="content-wrapper">
 <!-- Content Header (Page header) -->
 <div class="content-header">
  <div class="container-fluid">
   <div class="row mb-2">
    <div class="col-sm-6">
     <h1 class="m-0">View/ Edit My Profile</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
     <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
      <li class="breadcrumb-item active">My Profile</li>
     </ol>
    </div><!-- /.col -->
   </div><!-- /.row -->
  </div><!-- /.container-fluid -->
 </div>
 <!-- /.content-header -->

 <!-- Main Body area start -->
 <section class="content">
  <div class="container-fluid">
   <div class="row">

    <div class="col-lg-12">
     <?php
     $u_id= $_SESSION['user_id'];
     $query="SELECT * FROM users WHERE user_id='$u_id'";
     $selectUser=mysqli_query($dbc,$query);
     while ($row=mysqli_fetch_array($selectUser))
     {
     $user_id =$row['user_id'];
     $image =$row['image'];
     $fullname =$row['fullname'];
     $username =$row['username'];
     $email =$row['email'];
     $phone =$row['phone'];
     $address =$row['address'];
     $status =$row['status'];
     $user_role =$row['user_role'];
     $join_date =$row['join_date'];

     ?>

     <div class="card">
      <div class="card-header">
       <h3 class="card-title">Update My Profile</h3>
      </div>
      <div class="card-body">
       <!-- My Profile Form Starts -->
       <form action="" method="POST" enctype="multipart/form-data">
        <div class="row">
         <div class="col-lg-6">
          <div class="form-group">
           <label for="fullname">Full Name</label>
           <input type="text" name="fullname" id="" class="form-control" required autocomplete="off"
            placeholder="Enter Fullname of the user" value="<?php echo $fullname; ?>">
          </div>
          <div class="form-group">
           <label for="username">Username</label>
           <input type="text" name="username" id="" class="form-control" required autocomplete="off"
            placeholder="Enter username of the user" value="<?php echo $username; ?>">
          </div>
          <div class=" form-group">
           <label for="email">Email</label>
           <input type="email" name="email" id="" class="form-control" required autocomplete="off"
            placeholder="Enter user email" value="<?php echo $email; ?>" title="Email cannot be changed" readonly>
          </div>
          <div class=" form-group">
           <label for="password">Password</label>
           <input type="password" name="password" id="" class="form-control" placeholder="*****">
          </div>
          <div class="form-group">
           <label for="re-password">Re-type Password</label>
           <input type="password" name="re-password" id="" class="form-control">
          </div>
         </div>

         <div class="col-lg-6">
          <div class="form-group">
           <label for="phone">Phone no.</label>
           <input type="text" name="phone" id="" class="form-control" required autocomplete="off"
            placeholder="Enter phone number" value="<?php echo $phone; ?>">
          </div>
          <div class=" form-group">
           <label for="address">Address</label>
           <input type="text" name="address" id="" class="form-control" required autocomplete="off"
            placeholder="Enter address" value="<?php echo $address; ?>">
          </div>
          <div class=" form-group">
           <label for="status">User Status</label>
           <input type="text" name="status" id="" class="form-control" required autocomplete="off"
            value="<?php if($status==1){ echo 'Active'; } else { echo 'Inactive';} ?>"
            title="Only admin can change status" readonly>
          </div>
          <div class=" form-group">
           <label for="user_role">User Role</label>
           <input type="text" name="user_role" id="" class="form-control" required autocomplete="off"
            value="<?php if($user_role==2){ echo 'Editor'; }?>" title="Only admin can change user role" readonly>
          </div>
          <div class="form-group">
           <label for="image">Profile Image</label> <br>
           <?php 
           if(!empty($image))
           { ?>

           <img src="dist/img/users/<?php echo $image?>" alt="<?php echo $image?>" width="40">

           <?php 
           } else {

           echo "No Picture Uploaded";

          

           }
           
           ?>
           <br>
           <input type="file" name="image" id="" class="form-control-file">
          </div>
         </div>
         <div class="col-lg-12 text-right">
          <a href="dashboard.php" class="btn btn-warning">Back </a>
          <input type="hidden" name="updateUserID" value="<?php echo $u_id; ?>">
          <input type="submit" name="update" id="" class="btn btn-primary" value="Update User">
         </div>
        </div>

       </form>

       <!-- Add New User Form ends -->

       <!-- Update Profile Code -->
       <?php
       if(isset($_POST['update'])){ 
          $updateUserID = $_POST['updateUserID'];
          $fullname     =$_POST['fullname'];
          $username     =$_POST['username'];
          $email        =$_POST['email'];
          $phone        =$_POST['phone'];
          $address      =$_POST['address'];
          // Get the Image File and Name
          $image        =$_FILES['image']['name'];
          // Get the Image File and Temporary Folder Name
          $image_tmp    =$_FILES['image']['tmp_name'];

          $password     =$_POST['password'];
          $repassword   =$_POST['re-password'];

          if(!empty($password) && !empty($image)){ 

            if($password==$repassword) { 
              // hashed password
              $hashedpass=sha1($password);
              // Remove old image from the Folder
              $removeQuery="SELECT * FROM users where user_id='$updateUserID'";
              $removeImage= mysqli_query($dbc,$removeQuery);
              while($row = mysqli_fetch_assoc($removeImage)){ 
                $rImage= $row['image'];
                unlink("dist/img/users/". $rImage);
              }
              // Change Image Name
              $randomNumber=rand(0,9999999);
              
              $imageFileName=$randomNumber.$image;
              // Move uploaded file from temporary folder to destination Folder
              move_uploaded_file($image_tmp, "dist/img/users/".$imageFileName);
              
              // Update users data into the database 
              $query= "UPDATE users SET fullname='$fullname',	username='$username' , email='$email', password='$hashedpass', phone='$phone', address='$address', image='$imageFileName' where user_id='$updateUserID'";
              $updateUser=mysqli_query($dbc,$query);
              if($updateUser){ 

                header("Location:dashboard.php");

              } else { 

                die("MySQL Database Error.". mysqli_error($dbc));
                
              }
            }

          } else if (!empty($password) && empty($image)) { 

            if($password==$repassword) { 
              // hashed password
              $hashedpass=sha1($password);
              
              // Update users data into the database 
              $query= "UPDATE users SET fullname='$fullname',	username='$username' , email='$email', password='$hashedpass', phone='$phone', address='$address' where user_id='$updateUserID'";
              $updateUser=mysqli_query($dbc,$query);
              if($updateUser){ 

                header("Location:dashboard.php");

              } else { 

                die("MySQL Database Error.". mysqli_error($dbc));
                
              }
            }

          } else if (empty($password) && !empty($image)) { 

            // Remove old image from the Folder
              $removeQuery="SELECT * FROM users where user_id='$updateUserID'";
              $removeImage= mysqli_query($dbc,$removeQuery);
              while($row = mysqli_fetch_assoc($removeImage)){ 
                $rImage= $row['image'];
                unlink("dist/img/users/". $rImage);
              }
              // Change Image Name
              $randomNumber=rand(0,9999999);
              
              $imageFileName=$randomNumber.$image;
              // Move uploaded file from temporary folder to destination Folder
              move_uploaded_file($image_tmp, "dist/img/users/".$imageFileName);
              
              // Update users data into the database 
              $query= "UPDATE users SET fullname='$fullname',	username='$username' , email='$email', phone='$phone', address='$address', image='$imageFileName' where user_id='$updateUserID'";
              $updateUser=mysqli_query($dbc,$query);
              if($updateUser){ 

                header("Location:dashboard.php");

              } else { 

                die("MySQL Database Error.". mysqli_error($dbc));
                
              }

          } else if (empty($password) && empty($image)) { 
             $query= "UPDATE users SET fullname='$fullname',	username='$username' , email='$email', phone='$phone', address='$address' where user_id='$updateUserID'";
              $updateUser=mysqli_query($dbc,$query);
              if($updateUser){ 

                header("Location:dashboard.php");

              } else { 

                die("MySQL Database Error.". mysqli_error($dbc));
                
              }
          }
        }
       
       ?>
      </div>
     </div>

     <?php }
       
        ?>
    </div>
   </div>
  </div>
 </section>
 <!-- Main Body area end -->
</div>

<!-- Body Content end -->
<?php 
include 'inc/admin/footer.php';
?>
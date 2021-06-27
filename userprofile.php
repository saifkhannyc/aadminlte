<?php
include 'inc/header.php';
if (empty($_SESSION['email']) && empty($_SESSION['user_id']))
{
    header('Location:admin/index.php');
}
?>
<section class="profile">
 <div class="container">
  <div class="row">
   <div class="col-md-9 mx-auto">
    <!-- Display logged in users information  -->
    <?php
$u_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE user_id='$u_id'";
$selectUser = mysqli_query($dbc, $query);
while ($row = mysqli_fetch_array($selectUser))
{
    $user_id = $row['user_id'];
    $image = $row['image'];
    $fullname = $row['fullname'];
    $username = $row['username'];
    $email = $row['email'];
    $phone = $row['phone'];
    $address = $row['address'];
    $status = $row['status'];
    $user_role = $row['user_role'];
    $join_date = $row['join_date']; ?>
    <div class="card">
     <div class="card-header">
      <h3 class="card-title">Update Your Profile</h3>
     </div>
     <!-- /.card-header -->
     <!-- form start -->

     <form class="form-horizontal" method="POST" enctype="multipart/form-data">
      <div class="card-body">
       <?php
    if (isset($msg))
    {
        echo $msg;
    }
?>
       <div class="form-group row">
        <label for="image" class="col-md-2 col-form-label">Change Picture</label>
        <div class="col-md-10">
         <?php
    if (!empty($image))
    { ?>
         <img class="profile-user-img img-fluid img-round" src="admin/dist/img/users/<?php echo $image ?>"
          alt="<?php echo $image ?>" alt="User profile picture">
         <?php
    }
    else
    { ?>

         <img class="profile-user-img img-fluid img-round" src="admin/dist/img/avatar4.png">
         <?php
    }
?>
         <br><br>
         <input type="file" name="image" id="" class="form-control-file">
        </div>
       </div>
       <div class="form-group row">
        <label for="fullname" class="col-md-2 col-form-label">Full Name</label>
        <div class="col-md-10">
         <input type="text" name="fullname" class="form-control" id="fullname" value="<?php echo $fullname; ?>">
        </div>
       </div>
       <div class="form-group row">
        <label for="email" class="col-md-2 col-form-label">Email</label>
        <div class="col-md-10">
         <input type="email" name="email" class="form-control" id="email" value="<?php echo $email; ?>" readonly>
        </div>
       </div>
       <div class="form-group row">
        <label for="phone" class="col-md-2 col-form-label">Phone</label>
        <div class="col-md-10">
         <input type="text" name="phone" class="form-control" id="phone" value="<?php echo $phone; ?>">
        </div>
       </div>
       <div class="form-group row">
        <label for="address" class="col-md-2 col-form-label">Address</label>
        <div class="col-md-10">
         <input type="address" name="address" class="form-control" id="address" value="<?php echo $address; ?>">
        </div>
       </div>
       <div class="form-group row">
        <label for="password" class="col-md-2 col-form-label">Password</label>
        <div class="col-md-10">
         <input type="password" name="password" class="form-control" id="password" placeholder="*****">
        </div>
       </div>
       <div class="form-group row">
        <label for="repassword" class="col-md-2 col-form-label">Re-Password</label>
        <div class="col-md-10">
         <input type="repassword" name="repassword" class="form-control" id="repassword" placeholder="*****">
        </div>
       </div>

      </div>
      <!-- /.card-body -->
      <div class="card-footer text-right">
       <input type="hidden" name="updateUserID" value="<?php echo $u_id; ?>">
       <input type="submit" name="update" id="" class="btn btn-primary" value="Update Profile">
      </div>
      <!-- /.card-footer -->
     </form>
     <!-- Update User Profile Code -->
     <?php
    if (isset($_POST['update']))
    {
        $updateUserID = $_POST['updateUserID'];
        $fullname = $_POST['fullname'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        // Get the Image File and Name
        $image = $_FILES['image']['name'];
        // Get the Image File and Temporary Folder Name
        $image_tmp = $_FILES['image']['tmp_name'];

        $password = $_POST['password'];
        $repassword = $_POST['repassword'];

        if (!empty($password) && !empty($image))
        {

            if ($password == $repassword)
            {
                // hashed password
                $hashedpass = sha1($password);
                // Remove old image from the Folder
                $removeQuery = "SELECT * FROM users where user_id='$updateUserID'";
                $removeImage = mysqli_query($dbc, $removeQuery);
                while ($row = mysqli_fetch_assoc($removeImage))
                {
                    $rImage = $row['image'];
                    unlink("admin/dist/img/users/" . $rImage);
                }
                // Change Image Name
                $randomNumber = rand(0, 9999999);

                $imageFileName = $randomNumber . $image;
                // Move uploaded file from temporary folder to destination Folder
                move_uploaded_file($image_tmp, "admin/dist/img/users/" . $imageFileName);

                // Update users data into the database
                $query = "UPDATE users SET image='$imageFileName', fullname='$fullname',phone='$phone', address='$address', password='$hashedpass' where user_id='$updateUserID'";
                $updateUser = mysqli_query($dbc, $query);
                if ($updateUser)
                {
                    $msg = "<div class='alert alert-success'>Your profile updated successfully!</div>";
                    header("Location:userprofile.php");

                }
                else
                {

                    die("MySQL Database Error." . mysqli_error($dbc));

                }
            }

        }
        else if (!empty($password) && empty($image))
        {

            if ($password == $repassword)
            {
                // hashed password
                $hashedpass = sha1($password);

                // Update users data into the database
                $query = "UPDATE users SET fullname='$fullname', phone='$phone', address='$address', password='$hashedpass' where user_id='$updateUserID'";
                $updateUser = mysqli_query($dbc, $query);
                if ($updateUser)
                {

                    $msg = "<div class='alert alert-success'>Your profile updated successfully!</div>";
                    header("Location:userprofile.php");

                }
                else
                {

                    die("MySQL Database Error." . mysqli_error($dbc));

                }
            }

        }
        else if (empty($password) && !empty($image))
        {

            // Remove old image from the Folder
            $removeQuery = "SELECT * FROM users where user_id='$updateUserID'";
            $removeImage = mysqli_query($dbc, $removeQuery);
            while ($row = mysqli_fetch_assoc($removeImage))
            {
                $rImage = $row['image'];
                unlink("admin/dist/img/users/" . $rImage);
            }
            // Change Image Name
            $randomNumber = rand(0, 9999999);

            $imageFileName = $randomNumber . $image;
            // Move uploaded file from temporary folder to destination Folder
            move_uploaded_file($image_tmp, "admin/dist/img/users/" . $imageFileName);

            // Update users data into the database
            $query = "UPDATE users SET image='$imageFileName', fullname='$fullname', phone='$phone', address='$address' where user_id='$updateUserID'";
            $updateUser = mysqli_query($dbc, $query);
            if ($updateUser)
            {

                $msg = "<div class='alert alert-success'>Your profile updated successfully!</div>";
                header("Location:userprofile.php");
            }
            else
            {

                die("MySQL Database Error." . mysqli_error($dbc));

            }

        }
        else if (empty($password) && empty($image))
        {
            $query = "UPDATE users SET fullname='$fullname', phone='$phone', address='$address' where user_id='$updateUserID'";
            $updateUser = mysqli_query($dbc, $query);
            if ($updateUser)
            {
                $msg = "<div class='alert alert-success'>Your profile updated successfully!</div>";
                header("Location:userprofile.php");

            }
            else
            {

                die("MySQL Database Error." . mysqli_error($dbc));

            }
        }
    }

?>
    </div>
    <?php
}
?>
   </div>
  </div>
 </div>
</section>


<?php
include 'inc/footer.php';

?>
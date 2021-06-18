<?php 
// Includes files
include 'inc/admin/header.php';
include 'inc/admin/topbar.php';
include 'inc/admin/menubar.php';
?>

<!-- Body Content Start -->
<div class="content-wrapper">
 <!-- Content Header (Page header) -->
 <div class="content-header">
  <div class="container-fluid">
   <div class="row mb-2">
    <div class="col-sm-6">
     <h1 class="m-0">Manage All Posts</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
     <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
      <li class="breadcrumb-item active">Manage Posts</li>
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
      if($_SESSION['user_role']==1){ ?>
     <?php 

     $do= isset ($_GET['do']) ? $_GET['do']: 'Manage';
       // Manage all posts. Display All Posts
       if ($do=="Manage")
       {  ?>
     <div class="card">
      <div class="card-header">
       <h3 class="card-title">Manage All Posts</h3>
      </div>
      <div class="card-body">
       <table class="table table-bordered">
        <tr>
         <th scope="col">SL#</th>
         <th scope="col">Title</th>
         <th scope="col">Description</th>
         <th scope="col">Thumbnail</th>
         <th scope="col">Category</th>
         <th scope="col">Author</th>
         <th scope="col">tags</th>
         <th scope="col">Status</th>
         <th scope="col">Date</th>
         <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
         <!-- View all Posts code starts here -->
         <?php 
         $query="SELECT * FROM posts ORDER BY post_id DESC";
         $allPosts=mysqli_query($dbc,$query);
         $i=0;

         while($row=mysqli_fetch_assoc($allPosts)){ 
          $post_id      =$row['post_id'];
          $title        =$row['title'];
          $description  =$row['description'];
          $image        =$row['image'];
          $category_id  =$row['category_id'];
          $author_id    =$row['author_id'];
          $tags         =$row['tags'];
          $status       =$row['status'];
          $date_posted  =$row['date_posted'];
          $i++;
         
        ?>
         <tr>
          <td scope="row"><?php echo $i; ?></td>
          <td scope="row"><?php echo $title; ?></td>
          <td scope="row"><?php echo $description; ?></td>
          <td scope="row">
           <?php if(!empty($image)){ ?>

           <img src="dist/img/posts/<?php echo $image; ?>" alt="<?php echo $image;?>" class="img-fluid" width="30">

           <?php
            } else { 
           ?>
           <img src="dist/img/posts/boxed-bg.png" class="img-fluid" width="30">
           <?php
           }
           ?>
          </td>
          <td scope="row"><?php echo $category_id; ?></td>
          <td scope="row"><?php echo $author_id; ?></td>
          <td scope="row"><?php echo $tags; ?></td>
          <td scope="row">
           <?php 
          if($status==1){ ?>
           <span class="badge badge-success">Active</span>

           <?php } 
           
           else if ($status==2)
           
          { ?>

           <span class="badge badge-danger">Inactive</span>

           <?php
          }
          ?>

          <td scope="row"><?php echo $date_posted?></td>
          <td>
           <a href="posts.php?do=Edit&p_id=<?php echo $post_id;?>" data-toggle="tooltip" title="Edit"><i
             class="fa fa-edit"></i></a>
           <a href="" data-toggle="modal" data-target="#deletePosts<?php echo $post_id;?>" title="Delete"><i
             class="fa fa-trash" style="color:red;"></i></a>
          </td>
          <!-- Delete Modal -->
          <div class="modal fade" id="deletePosts<?php echo $post_id;?>" tabindex="-1"
           aria-labelledby="exampleModalLabel" aria-hidden="true">
           <div class="modal-dialog">
            <div class="modal-content">
             <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to delete
               <b><?php echo $title;?></b>
              </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
              </button>
             </div>
             <div class="modal-body">
              <form action="posts.php?do=Delete&d_id=<?php echo $post_id;?>" method="POST">
               <input name="deletePosts" type="submit" class="btn btn-danger" value="Confirm">
               <a type="button" class="btn btn-success" data-dismiss="modal">Cancel</a>
              </form>

             </div>

            </div>
           </div>
          </div>
         </tr>
         <?php } ?>
        </tbody>
       </table>
      </div>
     </div>

     <?php  

      } 
    //  View all Users code starts here 

    // Add New Users Code starts here
    else if($do=="Add"){ ?>
     <div class="card">
      <div class="card-header">
       <h3 class="card-title">Add New Posts</h3>
      </div>
      <div class="card-body">
       <!-- Add New User Form Starts -->
       <form action="posts.php?do=Insert" method="POST" enctype="multipart/form-data">
        <div class="row">
         <div class="col-lg-12">
          <div class="form-group">
           <label for="title">Title</label>
           <input type="text" name="title" id="" class="form-control" required autocomplete="off"
            placeholder="Enter post title">
          </div>
          <div class="form-group">
           <label for="description">Description</label>
           <textarea id="posts_desc" class="form-control" rows="4" name="description"></textarea>
          </div>
          <div class="form-group">
           <label for="email">Email</label>
           <input type="email" name="email" id="" class="form-control" required autocomplete="off"
            placeholder="Enter user email">
          </div>
          <div class="form-group">
           <label for="password">Password</label>
           <input type="password" name="password" id="" class="form-control" required autocomplete="off"
            placeholder="Enter password">
          </div>
          <div class="form-group">
           <label for="re-password">Re-type Password</label>
           <input type="password" name="re-password" id="" class="form-control" required autocomplete="off"
            placeholder="Re-enter password">
          </div>
         </div>


         <div class="col-lg-12">
          <div class="form-group">
           <input type="submit" name="register" id="" class="btn btn-primary float-lg-right" value="Add New User">
          </div>
         </div>
        </div>

       </form>

       <!-- Add New User Form ends -->
      </div>
     </div>
     <?php } 
      //  Insert the inputted New User data into the database from the form
       else if ($do=="Insert"){ 
        // PHP code to insert data into the database
        if(isset($_POST['register'])){ 
          $fullname     =$_POST['fullname'];
          $username     =$_POST['username'];
          $email        =$_POST['email'];
          $phone        =$_POST['phone'];
          $address      =$_POST['address'];
          $status       =$_POST['status'];
          $user_role    =$_POST['user_role'];
          // Get the Image File and Name
          $image        =$_FILES['image']['name'];
          // Get the Image File and Temporary Folder Name
          $image_tmp    =$_FILES['image']['tmp_name'];

          $password     =$_POST['password'];
          $repassword   =$_POST['re-password'];
          // Check to see if password and repeat password match
          if($password==$repassword) { 
            // hashed password
            $hashedpass=sha1($password);
            $randomNumber=rand(0,9999999);
            // Change Image Name
            $imageFileName=$randomNumber.$image;
            // Move uploaded file from temporary folder to destination Folder
            move_uploaded_file($image_tmp, "dist/img/users/".$imageFileName);
            
            // Insert users data into the database 
            $query= "INSERT INTO users (fullname,	username, email, password, phone, address,	status, user_role, join_date, image) VALUES('$fullname','$username', '$email', '$hashedpass','$phone','$address','$status','$user_role', NOW(),'$imageFileName' )";
            $saveUser=mysqli_query($dbc,$query);
            if($saveUser){ 
              header("Location:users.php?do=Manage");
            } else { 
              die("MySQL Database Error.". mysqli_error($dbc));
            }

          }

          
        }


       }

       else if ($do=="Edit"){ 
        if(isset($_GET['u_id'])){ 
          $u_id= $_GET['u_id'];
          $query="SELECT * FROM users WHERE user_id='$u_id'";
          $selectUser=mysqli_query($dbc,$query);
          while ($row=mysqli_fetch_assoc($selectUser))
          { 
          $user_id   =$row['user_id'];
          $image     =$row['image'];
          $fullname  =$row['fullname'];
          $username  =$row['username'];
          $email     =$row['email'];
          $phone     =$row['phone'];
          $address   =$row['address'];
          $status    =$row['status'];
          $user_role =$row['user_role'];
          $join_date =$row['join_date'];  
            
            ?>

     <div class="card">
      <div class="card-header">
       <h3 class="card-title">Update User Information</h3>
      </div>
      <div class="card-body">
       <!-- Add New User Form Starts -->
       <form action="users.php?do=Update" method="POST" enctype="multipart/form-data">
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
           <input type="password" name="password" id="" class="form-control" placeholder="Enter password">
          </div>
          <div class="form-group">
           <label for="re-password">Re-type Password</label>
           <input type="password" name="re-password" id="" class="form-control" placeholder="Re-enter password">
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
           <select name="status" id="" class="form-control">
            <option value="2">Please select the status</option>
            <option value="1" <?php if($status==1){ echo 'selected'; } ?>>Active</option>
            <option value="2" <?php if($status==2){ echo 'selected'; }?>>Inactive</option>
           </select>
          </div>
          <div class="form-group">
           <label for="user_role">User Role</label>
           <select name="user_role" id="" class="form-control">
            <option value="3">Please select the user role</option>
            <option value="1" <?php if($user_role==1){ echo 'selected';}?>>Super Admin</option>
            <option value="2" <?php if($user_role==2){ echo 'selected';}?>>Editor</option>
            <option value="3" <?php if($user_role==3){ echo 'selected';}?>>User</option>
           </select>
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
          <a href="users.php?do=Manage" class="btn btn-warning">Back </a>
          <input type="hidden" name="updateUserID" value="<?php echo $user_id; ?>">
          <input type="submit" name="update" id="" class="btn btn-primary" value="Update User">
         </div>
        </div>

       </form>

       <!-- Add New User Form ends -->
      </div>
     </div>

     <?php }
        }



       }
      // Update changes into the database
       else if ($do=="Update"){ 
        if(isset($_POST['update'])){ 
          $updateUserID = $_POST['updateUserID'];
          $fullname     =$_POST['fullname'];
          $username     =$_POST['username'];
          $email        =$_POST['email'];
          $phone        =$_POST['phone'];
          $address      =$_POST['address'];
          $status       =$_POST['status'];
          $user_role    =$_POST['user_role'];
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
              $query= "UPDATE users SET fullname='$fullname',	username='$username' , email='$email', password='$hashedpass', phone='$phone', address='$address',	status='$status', user_role='$user_role', image='$imageFileName' where user_id='$updateUserID'";
              $updateUser=mysqli_query($dbc,$query);
              if($updateUser){ 

                header("Location:users.php?do=Manage");

              } else { 

                die("MySQL Database Error.". mysqli_error($dbc));
                
              }
            }

          } else if (!empty($password) && empty($image)) { 

            if($password==$repassword) { 
              // hashed password
              $hashedpass=sha1($password);
              
              // Update users data into the database 
              $query= "UPDATE users SET fullname='$fullname',	username='$username' , email='$email', password='$hashedpass', phone='$phone', address='$address',	status='$status', user_role='$user_role' where user_id='$updateUserID'";
              $updateUser=mysqli_query($dbc,$query);
              if($updateUser){ 

                header("Location:users.php?do=Manage");

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
              $query= "UPDATE users SET fullname='$fullname',	username='$username' , email='$email', phone='$phone', address='$address',	status='$status', user_role='$user_role', image='$imageFileName' where user_id='$updateUserID'";
              $updateUser=mysqli_query($dbc,$query);
              if($updateUser){ 

                header("Location:users.php?do=Manage");

              } else { 

                die("MySQL Database Error.". mysqli_error($dbc));
                
              }

          } else if (empty($password) && empty($image)) { 
             $query= "UPDATE users SET fullname='$fullname',	username='$username' , email='$email', phone='$phone', address='$address',	status='$status', user_role='$user_role' where user_id='$updateUserID'";
              $updateUser=mysqli_query($dbc,$query);
              if($updateUser){ 

                header("Location:users.php?do=Manage");

              } else { 

                die("MySQL Database Error.". mysqli_error($dbc));
                
              }
          }
        }
       }

       else if ($do=="Delete"){ 
        // Delete User
        if(isset($_GET['d_id'])) { 
          $deleteUserID=$_GET['d_id'];
          // Remove old image from the Folder
              $removeQuery="SELECT * FROM users where user_id='$deleteUserID'";
              $removeImage= mysqli_query($dbc,$removeQuery);
              while($row = mysqli_fetch_assoc($removeImage)){ 
                $rImage= $row['image'];
                unlink("dist/img/users/". $rImage);
              }
            $deleteQuery="DELETE FROM users where user_id='$deleteUserID'";
            $deleteUser=mysqli_query($dbc,$deleteQuery);
            if($deleteUser){ 

                header("Location:users.php?do=Manage");

              } else { 

                die("MySQL Database Error.". mysqli_error($dbc));
                
              }
        }
       }

       else{ 
        header("Location: 404.php");
       }
     
     ?>

     <?php } else { 
        echo '<div class="alert alert-warning">You have no access to this page. Please contact site administrator.</div>';
      }
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
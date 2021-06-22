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
         $count=mysqli_num_rows($allPosts);
         if($count<= 0) { 

          echo '<div class="alert alert-info"> There are no posts. Please Add new Post.</div>';
         }

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
          <td scope="row">
           <?php 
            $query="SELECT* FROM category where cat_id='$category_id'";
            $category_name=mysqli_query($dbc,$query);
            while ($row = mysqli_fetch_array($category_name)){ 
              $cat_id=$row['cat_id'];
              $cat_name=$row['cat_name'];
              echo $cat_name;
            }
          ?>

          </td>
          <td scope="row">
           <?php 
            $query="SELECT* FROM users where user_id='$user_id'";
            $fullname=mysqli_query($dbc,$query);
            while ($row = mysqli_fetch_array($fullname)){ 
              $user_id=$row['user_id'];
              $name=$row['fullname'];
              echo $name;
            }
          
          ?>
          </td>
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
           <label for="title">Category</label>
           <select name="category_id" class="form-control">
            <option value="0">Please select category/sub-category</option>
            <?php 
             $query="SELECT * FROM category where parent_id=0 order by cat_name ASC";
             $parent_cat=mysqli_query($dbc, $query);
             while ($row=mysqli_fetch_assoc($parent_cat)){ 
               $cat_id =$row['cat_id'];
               $cat_name=$row['cat_name'];
               $parent_id=$row['parent_id']; ?>

            <option value="<?php echo $cat_id; ?>"><?php echo $cat_name; ?></option>
            <?php 
             $query2="SELECT * FROM category where parent_id='$cat_id' order by cat_name ASC";
             $child_cat=mysqli_query($dbc, $query2);
             while ($row=mysqli_fetch_assoc($child_cat)) {
                 $cat_id=$row['cat_id'];
                 $cat_name=$row['cat_name'];
              ?>
            <option value="<?php echo $cat_id; ?>">--<?php echo $cat_name; ?></option>
            <?php 
             } 
            ?>
            <?php  
             }
            ?>
           </select>
          </div>
          <div class="form-group">
           <label for="description">Description</label>
           <textarea id="posts_desc" class="form-control" rows="4" name="description"></textarea>
          </div>
          <div class="form-group">
           <label for="tags">Meta Tags</label>
           <input type="tags" name="tags" id="" class="form-control" required autocomplete="off"
            placeholder="Enter post tags separated by commas">
          </div>
          <div class="form-group">
           <label for="status">Post Status</label>
           <select name="status" class="form-control">
            <option value="0">Please select status</option>
            <option value="1">Active</option>
            <option value="2">Inactive</option>
           </select>
          </div>
          <div class="form-group">
           <label for="image">Select Post thumbnail</label>
           <input type="file" name="image" id="" class="form-control-file">
          </div>
         </div>


         <div class="col-lg-12">
          <div class="form-group">
           <input type="submit" name="publish" id="" class="btn btn-primary float-lg-right" value="Publish Post">
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
        if(isset($_POST['publish'])){ 
          $title              =mysqli_real_escape_string($dbc,$_POST['title']);
          $category_id        =mysqli_real_escape_string($dbc,$_POST['category_id']);
          $description        =strip_tags(mysqli_real_escape_string($dbc,$_POST['description']));
          $tags               =mysqli_real_escape_string($dbc,$_POST['tags']);
          $status             =mysqli_real_escape_string($dbc,$_POST['status']);
          $author_id          =mysqli_real_escape_string($dbc,$_SESSION['user_id']);
          // Get the Image File and Name
          $image        =$_FILES['image']['name'];
          // Get the Image File and Temporary Folder Name
          $image_tmp    =$_FILES['image']['tmp_name'];
          $randomNumber=rand(0,9999999);
            // Change Image Name
            $imageFileName=$randomNumber.$image;
            // Move uploaded file from temporary folder to destination Folder
            move_uploaded_file($image_tmp, "dist/img/posts/".$imageFileName);
            
            // Insert post data into the database 
            $query= "INSERT INTO posts (title,	category_id,description, tags, status, author_id,	image, date_posted) VALUES('$title','$category_id', '$description', '$tags','$status','$author_id','$imageFileName', Now() )";
            $saveUser=mysqli_query($dbc,$query);
            if($saveUser){ 
              header("Location:posts.php?do=Manage");
            } else { 
              die("MySQL Database Error.". mysqli_error($dbc));
            }

         

          
        }


       }

       else if ($do=="Edit"){ 
        if(isset($_GET['p_id'])){ 
          $p_id= $_GET['p_id'];
          $query="SELECT * FROM posts WHERE post_id='$p_id'";
          $selectPosts=mysqli_query($dbc,$query);
          while ($row=mysqli_fetch_assoc($selectPosts))
          { 
          $post_id      =$row['post_id'];
          $title        =$row['title'];
          $description  =$row['description'];
          $image        =$row['image'];
          $category_id  =$row['category_id'];
          $author_id    =$row['author_id'];
          $tags         =$row['tags'];
          $status       =$row['status'];
          $date_posted  =$row['date_posted'];
            
            ?>

     <div class="card">
      <div class="card-header">
       <h3 class="card-title">Update Post Information</h3>
      </div>
      <div class="card-body">
       <!-- Update Post Form Starts -->
       <form action="posts.php?do=Update" method="POST" enctype="multipart/form-data">
        <div class="row">
         <div class="col-lg-12">
          <div class="form-group">
           <label for="title">Title</label>
           <input type="text" name="title" id="" class="form-control" required autocomplete="off"
            placeholder="Enter post title" value="<?php echo $title; ?>">
          </div>
          <div class="form-group">
           <label for="title">Category</label>
           <select name="category_id" class="form-control">
            <option value="0">Please select category/sub-category</option>
            <?php 
             $query="SELECT * FROM category where parent_id=0 order by cat_name ASC";
             $parent_cat=mysqli_query($dbc, $query);
             while ($row=mysqli_fetch_assoc($parent_cat)){ 
               $cat_id =$row['cat_id'];
               $cat_name=$row['cat_name'];
               $parent_id=$row['parent_id']; ?>

            <option value="<?php echo $cat_id; ?>" <?php if($category_id==$cat_id) { echo 'selected';} ?>>
             <?php echo $cat_name; ?></option>
            <?php 
             $query2="SELECT * FROM category where parent_id='$cat_id' order by cat_name ASC";
             $child_cat=mysqli_query($dbc, $query2);
             while ($row=mysqli_fetch_assoc($child_cat)) {
                 $cat_id=$row['cat_id'];
                 $cat_name=$row['cat_name'];
              ?>
            <option value="<?php echo $cat_id; ?>" <?php if($category_id==$cat_id) { echo 'selected';} ?>>
             --<?php echo $cat_name; ?></option>
            <?php 
             } 
            ?>
            <?php  
             }
            ?>
           </select>
          </div>
          <div class="form-group">
           <label for="description">Description</label>
           <textarea id="posts_desc" class="form-control" rows="4"
            name="description"><?php echo $description; ?></textarea>
          </div>
          <div class="form-group">
           <label for="tags">Meta Tags</label>
           <input type="tags" name="tags" id="" class="form-control" required autocomplete="off"
            placeholder="Enter post tags separated by commas" value="<?php echo $tags ?>">
          </div>
          <div class="form-group">
           <label for="status">Post Status</label>
           <select name="status" class="form-control">
            <option value="0">Please select status</option>
            <option value="1" <?php if($status==1){ echo'selected';}?>>Active</option>
            <option value="2" <?php if($status==2){ echo'selected';}?>>Inactive</option>
           </select>
          </div>
          <div class="form-group">
           <label for="image">Post thumbnail</label>
           <?php 
            if(!empty($image))
           { ?>

           <img src="dist/img/posts/<?php echo $image?>" alt="<?php echo $image?>" width="400" height="400"
            style="display:block; margin-bottom:15px;">

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
          <a href="posts.php?do=Manage" class="btn btn-warning">Back </a>
          <input type="hidden" name="updatePostID" value="<?php echo $post_id; ?>">
          <input type="submit" name="update" id="" class="btn btn-primary" value="Update Post">
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
          $updatePostID       = $_POST['updatePostID'];
          $title              =mysqli_real_escape_string($dbc,$_POST['title']);
          $category_id        =mysqli_real_escape_string($dbc,$_POST['category_id']);
          $description        =mysqli_real_escape_string($dbc,$_POST['description']);
          $tags               =mysqli_real_escape_string($dbc,$_POST['tags']);
          $status             =mysqli_real_escape_string($dbc,$_POST['status']);
          $author_id          =mysqli_real_escape_string($dbc,$_SESSION['user_id']);
           // Get the Image File and Name
          $image        =$_FILES['image']['name'];
          // Get the Image File and Temporary Folder Name
          $image_tmp    =$_FILES['image']['tmp_name'];
          if(!empty($image)){ 
            $randomNumber=rand(0,9999999);
            // Change Image Name
            $imageFileName=$randomNumber.$image;
            // Move uploaded file from temporary folder to destination Folder
            move_uploaded_file($image_tmp, "dist/img/posts/".$imageFileName);
            $deletePostThumbnail="SELECT * FROM posts where post_id='$updatePostID'";
            $removeImage= mysqli_query($dbc, $deletePostThumbnail);
              while($row = mysqli_fetch_assoc($removeImage)){ 
                $rImage= $row['image'];
                unlink("dist/img/posts/". $rImage);
              }
            $query="UPDATE posts SET title='$title', description='$description', category_id='$category_id', author_id='$author_id', tags='$tags', status='$status', image='$imageFileName' where post_id='$updatePostID' ";
            $updatePost=mysqli_query($dbc, $query);
            if($updatePost){ 

                header("Location:posts.php?do=Manage");

              } else { 

                die("MySQL Database Error.". mysqli_error($dbc));
                
              }
            
          } else{ 
            $query="UPDATE posts SET title='$title', description='$description', category_id='$category_id', author_id='$author_id', tags='$tags', status='$status' where post_id='$updatePostID' ";
            $updatePost=mysqli_query($dbc, $query);
            if($updatePost){ 

                header("Location:posts.php?do=Manage");

              } else { 

                die("MySQL Database Error.". mysqli_error($dbc));
                
              }
          }


         
          
            
           
        }
       }

       else if ($do=="Delete"){ 
        // Delete User
        if(isset($_GET['d_id'])) { 
          $deletePostsID=$_GET['d_id'];
          // Remove old image from the Folder
              $removeQuery="SELECT * FROM posts where post_id='$deletePostsID'";
              $removeImage= mysqli_query($dbc,$removeQuery);
              while($row = mysqli_fetch_assoc($removeImage)){ 
                $rImage= $row['image'];
                unlink("dist/img/posts/". $rImage);
              }
            $deleteQuery="DELETE FROM posts where post_id='$deletePostsID'";
            $deleteUser=mysqli_query($dbc,$deleteQuery);
            if($deleteUser){ 

                header("Location:posts.php?do=Manage");

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
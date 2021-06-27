<?php
include 'inc/header.php';
include 'admin/inc/auth/functions.php';
?>




<!-- :::::::::: Page Banner Section Start :::::::: -->
<section class="blog-bg background-img">
 <div class="container">
  <!-- Row Start -->
  <div class="row">
   <div class="col-md-12">
    <h2 class="page-title">Single Blog Page</h2>
    <!-- Page Heading Breadcrumb Start -->
    <nav class="page-breadcrumb-item">
     <ol>
      <li><a href="index.html">Home <i class="fa fa-angle-double-right"></i></a></li>
      <li><a href="">Blog <i class="fa fa-angle-double-right"></i></a></li>
      <!-- Active Breadcrumb -->
      <li class="active">Single Right Sidebar</li>
     </ol>
    </nav>
    <!-- Page Heading Breadcrumb End -->
   </div>

  </div>
  <!-- Row End -->
 </div>
</section>
<!-- ::::::::::: Page Banner Section End ::::::::: -->



<!-- :::::::::: Blog With Right Sidebar Start :::::::: -->
<section>
 <div class="container">
  <div class="row">
   <!-- Blog Single Posts -->
   <div class="col-md-8">
    <?php
if (isset($_GET['article']))
{
    $postID = mysqli_real_escape_string($dbc, $_GET['article']);
    $query = "SELECT * FROM posts WHERE post_id='$postID'";
    $post = mysqli_query($dbc, $query);
    while ($row = mysqli_fetch_assoc($post))
    {
        $post_id = $row['post_id'];
        $title = $row['title'];
        $description = $row['description'];
        $image = $row['image'];
        $category_id = $row['category_id'];
        $author_id = $row['author_id'];
        $tags = $row['tags'];
        $status = $row['status'];
        $date_posted = $row['date_posted'];
?>
    <div class="blog-single">
     <!-- Blog Title -->
     <a href="#">
      <h3 class="post-title"><?php echo $title; ?></h3>
     </a>

     <!-- Blog Categories -->
     <div class="single-categories">
      <?php
        $query = "SELECT* FROM category where cat_id='$category_id'";
        $category_name = mysqli_query($dbc, $query);
        while ($row = mysqli_fetch_array($category_name))
        {
            $cat_id = $row['cat_id'];
            $cat_name = $row['cat_name'];
?>
      <span><?php echo $cat_name; ?></span>
      <?php
        }
?>
      <!-- <span>Corporate</span>
      <span>Tech Business</span> -->
     </div>

     <!-- Blog Thumbnail Image Start -->
     <div class="blog-banner">
      <?php if (!empty($image))
        { ?>

      <img src="admin/dist/img/posts/<?php echo $image; ?>" alt="<?php echo $image; ?>" class="img-fluid">

      <?php
        }
        else
        {
?>
      <img src="admin/dist/img/posts/boxed-bg.png" class="img-fluid">
      <?php
        }
?>
     </div>
     <!-- Blog Thumbnail Image End -->

     <!-- Blog Description Start -->
     <p><?php echo $description; ?></p>
     <!-- Blog Description End -->
    </div>
    <?php
    }
}
?>


    <!-- Single Comment Section Start -->
    <div class="single-comments">
     <!-- Comment Heading Start -->
     <div class="row">
      <div class="col-md-12">
       <?php
$query = "SELECT * FROM comment WHERE post_id='$postID'";
$postComment = mysqli_query($dbc, $query);
$countComments = mysqli_num_rows($postComment);
?>
       <h4>All Latest Comments (<?php echo $countComments; ?>)</h4>
       <div class="title-border"></div>
       <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
      </div>
     </div>
     <!-- Comment Heading End -->
     <?php
$query = "SELECT * FROM comment WHERE post_id='$postID'";
$postComment = mysqli_query($dbc, $query);
$count = mysqli_num_rows($postComment);
if ($count > 0)
{
    while ($row = mysqli_fetch_assoc($postComment))
    {
        $post_id = $row['post_id'];
        $user_id = $row['user_id'];
        $reply_id = $row['reply_id'];
        $cmt_desc = $row['cmt_desc'];
        $cmt_date = $row['cmt_date'];
        $timeago = timeago($cmt_date);
?>
     <!-- Single Comment Post Start -->
     <div class="row each-comments">
      <div class="col-md-2">
       <!-- Commented Person Thumbnail -->
       <div class="comments-person">
        <?php
        $query = "SELECT* FROM users where user_id='$user_id'";
        $users = mysqli_query($dbc, $query);
        while ($row = mysqli_fetch_array($users))
        {
            $fullname = $row['fullname'];
            $user_image = $row['image'];
            if (!empty($user_image))
            { ?>
        <img src="admin/dist/img/users/<?php echo $user_image; ?>" class="img-fluid">
        <?php
            }
            else
            { ?>

        <img src="assets/images/corporate-team/team-1.jpg">
        <?php
            }
?>
       </div>
      </div>

      <div class="col-md-10 no-padding">
       <!-- Comment Box Start -->

       <div class="comment-box">
        <div class="comment-box-header">
         <ul>
          <li class="post-by-name"><?php echo $fullname ?></li>
          <?php
        } ?>
          <li class="post-by-hour"><?php echo $timeago; ?></li>
         </ul>
        </div>
        <p><?php echo $cmt_desc; ?></p>
       </div>
       <!-- Comment Box End -->
      </div>
     </div>
     <!-- Single Comment Post End -->


     <!-- Comment Reply Post Start -->
     <div class="row each-comments">
      <div class="col-md-2 offset-md-2">
       <!-- Commented Person Thumbnail -->
       <div class="comments-person">
        <img src="assets/images/corporate-team/team-2.jpg">
       </div>
      </div>

      <div class="col-md-8 no-padding">
       <!-- Comment Box Start -->
       <div class="comment-box">
        <div class="comment-box-header">
         <ul>
          <li class="post-by-name">Dalia Rahman</li>


          <li class="post-by-hour">20 Hours Ago</li>
         </ul>
        </div>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.Lorem ipsum dolor sit amet, consectetur adipisicing
         elit</p>
       </div>
       <!-- Comment Box Start -->
      </div>
     </div>
     <!-- Comment Reply Post End -->
     <?php
    }
}
else
{
    echo '<div class="alert alert-info"> There are no comments for this post</div>';
}
?>
     <!-- Single Comment Post Start -->
     <!-- <div class="row each-comments"> -->
     <!-- <div class="col-md-2"> -->
     <!-- Commented Person Thumbnail -->
     <!-- <div class="comments-person">
        <img src="assets/images/corporate-team/team-1.jpg">
       </div>
      </div> -->


     <!-- </div> -->
     <!-- Single Comment Post End -->
    </div>
    <!-- Single Comment Section End -->


    <!-- Post New Comment Section Start -->
    <div class="post-comments">
     <h4>Post Your Comments</h4>
     <?php
if (!empty($_SESSION['email']) && !empty($_SESSION['user_id']))
{ ?>
     <div class="title-border"></div>
     <p>Let us know your thoughts</p>
     <!-- Form Start -->
     <?php
    $u_id = $_SESSION['user_id'];
    $u_name = $_SESSION['fullname'];
    $u_email = $_SESSION['email'];
?>
     <form action="" method="POST" class="contact-form">
      <!-- Left Side Start -->
      <div class="row">
       <div class="col-md-6">
        <!-- First Name Input Field -->
        <div class="form-group">
         <input type="text" name="user-name" placeholder="Your Name" class="form-input" autocomplete="off"
          required="required" value="<?php echo $u_name; ?>" readonly>
         <i class="fa fa-user-o"></i>
        </div>
       </div>
       <!-- Email Address Input Field -->
       <div class="col-md-6">
        <div class="form-group">
         <input type="email" name="email" placeholder="Email Address" class="form-input" autocomplete="off"
          required="required" value="<?php echo $u_email; ?>" readonly>
         <i class="fa fa-envelope-o"></i>
        </div>
       </div>
      </div>
      <!-- Left Side End -->

      <!-- Right Side Start -->
      <div class="row">
       <div class="col-md-12">

        <!-- Comments Textarea Field -->
        <div class="form-group">
         <textarea name="comments" class="form-input" placeholder="Your Comments Here..."></textarea>
         <i class="fa fa-pencil-square-o"></i>
        </div>
        <!-- Post Comment Button -->
        <button type="submit" name="addComments" class="btn-main"> Post Your Comments
         <i class="fa fa-paper-plane-o">
         </i></button>
       </div>
      </div>
      <?php
    if (isset($_POST['addComments']))
    {
        $cmt_desc = mysqli_real_escape_string($dbc, $_POST['comments']);
        $query = "INSERT INTO comment(post_id, user_id,cmt_desc,status,cmt_date
	) VALUES('$postID','$u_id','$cmt_desc',1,NOW())";
        $addComments = mysqli_query($dbc, $query);
        if ($addComments)
        {
            header("Location:single.php?article=" . $postID);
        }
        else
        {
            echo "Not added";
        }
    }
?>
     </form>
     <!-- Form End -->
     <?php
}
else
{
    echo '<div class="alert alert-info"> Please login to comment on posts <strong><a href="admin/index.php">Login</a></strong></div>';
}

?>

    </div>

    <!-- Post New Comment Section End -->

   </div>
   <!-- Insert the Category into the DB -->




   <!-- Blog Right Sidebar -->
   <?php include 'inc/sidebar.php'; ?>
   <!-- Sidebar End -->
  </div>
 </div>
</section>
<!-- ::::::::::: Blog With Right Sidebar End ::::::::: -->


<?php
include 'inc/footer.php';
?>
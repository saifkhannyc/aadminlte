<?php
include 'inc/header.php';
?>


<!-- :::::::::: Page Banner Section Start :::::::: -->
<section class="blog-bg background-img">
 <div class="container">
  <!-- Row Start -->
  <div class="row">
   <div class="col-md-12">
    <h2 class="page-title">Your Search Result</h2>
    <!-- Page Heading Breadcrumb Start -->
    <nav class="page-breadcrumb-item">
     <ol>
      <li><a href="index.html">Home <i class="fa fa-angle-double-right"></i></a></li>
      <!-- Active Breadcrumb -->
      <li class="active">Blog</li>
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
   <!-- Blog Posts Start -->
   <div class="col-md-8">

    <?php
if (isset($_POST['searchContent']))
{
    $data = mysqli_real_escape_string($dbc, $_POST['search']);
    $query = "SELECT * FROM posts WHERE title LIKE '%$data%' OR  description LIKE '%$data%' ORDER BY post_id DESC";
    $allPosts = mysqli_query($dbc, $query);
    $count = mysqli_num_rows($allPosts);
    if ($count <= 0)
    {
        echo '<div class="alert alert-info"> No posts found based on your search query: <strong>' . $data . '</strong></div>';
    }
    else
    {
        while ($row = mysqli_fetch_assoc($allPosts))
        {
            $post_id = $row['post_id'];
            $title = $row['title'];
            $description = $row['description'];
            $image = $row['image'];
            $category_id = $row['category_id'];
            $author_id = $row['author_id'];
            $tags = $row['tags'];
            $status = $row['status'];
            $date_posted = $row['date_posted']; ?>
    <!-- Single Item Blog Post Start -->
    <div class="blog-post">
     <!-- Blog Banner Image -->
     <div class="blog-banner">
      <a href="single.php?article=<?php echo $post_id; ?>">
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
            } ?>
       <!-- Post Category Names -->
       <div class="blog-category-name">
        <?php
            $query = "SELECT* FROM category where cat_id='$category_id'";
            $category_name = mysqli_query($dbc, $query);
            while ($row = mysqli_fetch_array($category_name))
            {
                $cat_id = $row['cat_id'];
                $cat_name = $row['cat_name']; ?>
        <h6><?php echo $cat_name; ?></h6>
        <?php
            } ?>

       </div>
      </a>
     </div>
     <!-- Blog Title and Description -->
     <div class="blog-description">
      <a href="single.php?article=<?php echo $post_id; ?>">
       <h3 class="post-title"><?php echo $title; ?></h3>
      </a>
      <p><?php echo strip_tags(substr($description, 0, 300)); ?>...</p>
      <!-- Blog Info, Date and Author -->
      <div class="row">
       <div class="col-md-8">
        <div class="blog-info">
         <ul>
          <li><i class="fa fa-calendar"></i><?php echo date("dS \of F, Y", strtotime($date_posted)); ?></li>
          <?php
            $query = "SELECT* FROM users where user_id='$author_id'";
            $fullname = mysqli_query($dbc, $query);
            while ($row = mysqli_fetch_array($fullname))
            {
                $user_id = $row['user_id'];
                $name = $row['fullname']; ?>
          <li><i class="fa fa-user"></i>by - <?php echo $name; ?>
          </li>
          <?php
            } ?>

          <li><i class="fa fa-heart"></i>(50)</li>
         </ul>
        </div>
       </div>

       <div class="col-md-4 read-more-btn">
        <a href="single.php?article=<?php echo $post_id; ?>" type="button" class="btn-main" id="readmorebtn">Read More
         <i class="fa fa-angle-double-right"></i></a>
       </div>
      </div>
     </div>
    </div>
    <!-- Single Item Blog Post End -->
    <?php
        }
    }

}
else if (isset($_GET['tags']))
{
    $tag = $_GET['tags'];
    $query = "SELECT * FROM posts WHERE tags LIKE '%$tag%' ORDER BY post_id DESC";
    $allTagPosts = mysqli_query($dbc, $query);
    $count = mysqli_num_rows($allTagPosts);
    if ($count <= 0)
    {
        echo '<div class="alert alert-info"> No posts found based on your tag: <strong>' . $tag . '</strong></div>';
    }
    else
    {
        while ($row = mysqli_fetch_assoc($allTagPosts))
        {
            $post_id = $row['post_id'];
            $title = $row['title'];
            $description = $row['description'];
            $image = $row['image'];
            $category_id = $row['category_id'];
            $author_id = $row['author_id'];
            $tags = $row['tags'];
            $status = $row['status'];
            $date_posted = $row['date_posted']; ?>
    <!-- Single Item Blog Post Start -->
    <div class="blog-post">
     <!-- Blog Banner Image -->
     <div class="blog-banner">
      <a href="single.php?article=<?php echo $post_id; ?>">
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
            } ?>
       <!-- Post Category Names -->
       <div class="blog-category-name">
        <?php
            $query = "SELECT* FROM category where cat_id='$category_id'";
            $category_name = mysqli_query($dbc, $query);
            while ($row = mysqli_fetch_array($category_name))
            {
                $cat_id = $row['cat_id'];
                $cat_name = $row['cat_name']; ?>
        <h6><?php echo $cat_name; ?></h6>
        <?php
            } ?>

       </div>
      </a>
     </div>
     <!-- Blog Title and Description -->
     <div class="blog-description">
      <a href="single.php?article=<?php echo $post_id; ?>">
       <h3 class="post-title"><?php echo $title; ?></h3>
      </a>
      <p><?php echo strip_tags(substr($description, 0, 300)); ?>...</p>
      <!-- Blog Info, Date and Author -->
      <div class="row">
       <div class="col-md-8">
        <div class="blog-info">
         <ul>
          <li><i class="fa fa-calendar"></i><?php echo date("dS \of F, Y", strtotime($date_posted)); ?></li>
          <?php
            $query = "SELECT* FROM users where user_id='$author_id'";
            $fullname = mysqli_query($dbc, $query);
            while ($row = mysqli_fetch_array($fullname))
            {
                $user_id = $row['user_id'];
                $name = $row['fullname']; ?>
          <li><i class="fa fa-user"></i>by - <?php echo $name; ?>
          </li>
          <?php
            } ?>

          <li><i class="fa fa-heart"></i>(50)</li>
         </ul>
        </div>
       </div>

       <div class="col-md-4 read-more-btn">
        <a href="single.php?article=<?php echo $post_id; ?>" type="button" class="btn-main" id="readmorebtn">Read More
         <i class="fa fa-angle-double-right"></i></a>
       </div>
      </div>
     </div>
    </div>
    <!-- Single Item Blog Post End -->
    <?php
        }
    }
}

?>


    <!-- Blog Paginetion Design Start -->

    <!-- Blog Paginetion Design End -->
   </div>



   <!-- Blog Right Sidebar -->
   <?php include 'inc/sidebar.php'; ?>
   <!-- Right Sidebar End -->
  </div>
 </div>
</section>
<!-- ::::::::::: Blog With Right Sidebar End ::::::::: -->


<?php
include 'inc/footer.php';

?>
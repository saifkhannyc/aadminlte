 <div class="col-md-4">

  <!-- Latest News -->
  <div class="widget">
   <h4>Latest News</h4>
   <div class="title-border"></div>

   <!-- Sidebar Latest News Slider Start -->
   <div class="sidebar-latest-news owl-carousel owl-theme">

    <?php 
      $query="SELECT * FROM posts ORDER BY date_posted DESC LIMIT 3";
      $allPosts=mysqli_query($dbc,$query);
      $count=mysqli_num_rows($allPosts);
      if($count<= 0) 
      { 
        echo '<div class="alert alert-info"> No posts found yet.</div>';
      } else
      { 
        while ($row=mysqli_fetch_assoc($allPosts)) 
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

    <!-- Latest News Start -->
    <div class="item">
     <div class="latest-news">
      <!-- Latest News Slider Image -->
      <div class="latest-news-image">
       <a href="single.php?article=<?php echo $post_id; ?>">
        <?php if(!empty($image)){ ?>

        <img src="admin/dist/img/posts/<?php echo $image; ?>" alt="<?php echo $image;?>" class="img-fluid">

        <?php
        } else { 
        ?>
        <img src="admin/dist/img/posts/boxed-bg.png" class="img-fluid">
        <?php
        }
        ?>
       </a>
      </div>
      <!-- Latest News Slider Heading -->
      <h5><a href="single.php?article=<?php echo $post_id; ?>"><?php echo $title; ?></a></h5>
      <!-- Latest News Slider Paragraph -->
      <p><?php echo strip_tags(substr($description,0,150));?></p>
     </div>
    </div>
    <!--  Latest News End -->
    <?php
       }
      }
    ?>

   </div>
   <!-- Sidebar Latest News Slider End -->
  </div>


  <!-- Search Bar Start -->
  <div class="widget">
   <!-- Search Bar -->
   <h4>Blog Search</h4>
   <div class="title-border"></div>
   <div class="search-bar">
    <!-- Search Form Start -->
    <form action="search.php" method="POST">
     <div class="form-group">
      <input type="text" name="search" placeholder="Search Here" autocomplete="off" class="form-input">
      <i class="fa fa-paper-plane-o"></i>
     </div>
     <div class="form-group">
      <input type="submit" name="searchContent" class="btn btn-primary btn-block" value="Search">
     </div>
    </form>
    <!-- Search Form End -->
   </div>
  </div>
  <!-- Search Bar End -->

  <!-- Recent Post -->
  <div class="widget">
   <h4>Recent Posts</h4>
   <div class="title-border"></div>
   <div class="recent-post">
    <?php 
     
    $query="SELECT a.title, date_posted, b.image as 'User_image' FROM posts a INNER JOIN users b on  a.author_id=b.user_id order by date_posted DESC LIMIT 5";
    $readPosts=mysqli_query($dbc, $query);
    while ($row=mysqli_fetch_assoc($readPosts)) {
        $title=$row['title'];
        $date_posted=$row['date_posted'];
        $user_image=$row['User_image']; ?>
    <!-- Recent Post Item Content Start -->
    <div class="recent-post-item">
     <div class="row">
      <!-- Item Image -->
      <div class="col-md-4">
       <?php if(!empty($user_image)){ ?>

       <img src="admin/dist/img/users/<?php echo $user_image; ?>" alt="<?php echo $user_image;?>" class="img-fluid">

       <?php
            } else { 
           ?>
       <img src="admin/dist/img/users/default.png" class="img-fluid">
       <?php
           }
           ?>
      </div>
      <!-- Item Tite -->
      <div class="col-md-8 no-padding">
       <h5><?php echo $title;?></h5>
       <ul>
        <li><i class="fa fa-clock-o"></i><?php echo date("M j, Y", strtotime($date_posted)); ?></li>
        <li><i class="fa fa-comment-o"></i>15</li>
       </ul>
      </div>
     </div>
    </div>
    <!-- Recent Post Item Content End -->
    <?php
    }
    ?>



   </div>
  </div>

  <!-- All Category -->
  <div class="widget">
   <h4>Blog Categories</h4>
   <div class="title-border"></div>
   <!-- Blog Category Start -->
   <div class="blog-categories">
    <ul>
     <?php 
    $query="SELECT a.cat_name, COUNT(DISTINCT(b.post_Id)) as 'Total' FROM category a LEFT JOIN posts b on a.cat_id= b.category_id group by cat_name order by COUNT(DISTINCT(b.post_Id)) DESC";
    $readCategory=mysqli_query($dbc, $query);
    while ($row=mysqli_fetch_assoc($readCategory)) {
        $cat_name  =$row['cat_name'];
        $cat_count =$row['Total']; ?>

     <!-- Category Item -->
     <li>
      <i class="fa fa-check"></i>
      <?php echo $cat_name; ?>

      <span>[<?php echo $cat_count; ?>]</span>

     </li>
     <?php
    }      
     ?>
    </ul>
   </div>
   <!-- Blog Category End -->
  </div>

  <!-- Recent Comments -->
  <div class="widget">
   <h4>Recent Comments</h4>
   <div class="title-border"></div>
   <div class="recent-comments">

    <!-- Recent Comments Item Start -->
    <div class="recent-comments-item">
     <div class="row">
      <!-- Comments Thumbnails -->
      <div class="col-md-4">
       <i class="fa fa-comments-o"></i>
      </div>
      <!-- Comments Content -->
      <div class="col-md-8 no-padding">
       <h5>admin on blog posts</h5>
       <!-- Comments Date -->
       <ul>
        <li>
         <i class="fa fa-clock-o"></i>Dec 15, 2018
        </li>
       </ul>
      </div>
     </div>
    </div>
    <!-- Recent Comments Item End -->

    <!-- Recent Comments Item Start -->
    <div class="recent-comments-item">
     <div class="row">
      <!-- Comments Thumbnails -->
      <div class="col-md-4">
       <i class="fa fa-comments-o"></i>
      </div>
      <!-- Comments Content -->
      <div class="col-md-8 no-padding">
       <h5>admin on blog posts</h5>
       <!-- Comments Date -->
       <ul>
        <li>
         <i class="fa fa-clock-o"></i>Dec 15, 2018
        </li>
       </ul>
      </div>
     </div>
    </div>
    <!-- Recent Comments Item End -->

    <!-- Recent Comments Item Start -->
    <div class="recent-comments-item">
     <div class="row">
      <!-- Comments Thumbnails -->
      <div class="col-md-4">
       <i class="fa fa-comments-o"></i>
      </div>
      <!-- Comments Content -->
      <div class="col-md-8 no-padding">
       <h5>admin on blog posts</h5>
       <!-- Comments Date -->
       <ul>
        <li>
         <i class="fa fa-clock-o"></i>Dec 15, 2018
        </li>
       </ul>
      </div>
     </div>
    </div>
    <!-- Recent Comments Item End -->

   </div>
  </div>

  <!-- Meta Tag -->
  <div class="widget">
   <h4>Tags</h4>
   <div class="title-border"></div>
   <!-- Meta Tag List Start -->
   <div class="meta-tags">
    <span>Business</span>
    <span>Technology</span>
    <span>Corporate</span>
    <span>Web Design</span>
    <span>Development</span>
    <span>Graphic</span>
    <span>Digital Marketing</span>
    <span>SEO</span>
    <span>Social Media</span>
   </div>
   <!-- Meta Tag List End -->
  </div>

 </div>
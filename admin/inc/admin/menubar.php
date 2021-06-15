<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
 <!-- Brand Logo -->
 <a href="index3.html" class="brand-link">
  <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
   style="opacity: .8">
  <span class="brand-text font-weight-light">Blog Site</span>
 </a>

 <!-- Sidebar -->
 <div class="sidebar">
  <!-- Sidebar user panel (optional) -->
  <div class="user-panel mt-3 pb-3 mb-3 d-flex">

   <!-- Display logged in user image -->
   <?php
  $user_id=$_SESSION['user_id'];
  $query = "SELECT * FROM users where user_id='$user_id'";
  $readUser=mysqli_query($dbc,$query);
  while($row=mysqli_fetch_array($readUser)){ 
    $image=$row['image']; ?>
   <div class="image">
    <img src="dist/img/users/<?php echo $image; ?>" class="img-circle elevation-2" alt="User Image">
   </div>
   <?php
  }
  ?>
   <!-- Display loggedin user -->
   <div class="info">
    <a href="#" class="d-block"><?php echo $_SESSION['fullname']; ?></a>
   </div>
  </div>

  <!-- Sidebar Menu -->
  <nav class="mt-2">
   <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
    <li class="nav-item menu-open">
     <a href="dashboard.php" class="nav-link active">
      <i class="nav-icon fas fa-tachometer-alt"></i>
      <p>
       Dashboard
      </p>
     </a>
    </li>
    <!-- Manage Reference Tables- Category/ Sub-Category -->
    <!-- <li class="nav-header">REFERENCE TABLE</li> -->
    <li class="nav-item">
     <a href="#" class="nav-link">
      <i class="fas fa-sitemap"></i>
      <p>
       Category
       <i class="right fas fa-angle-left"></i>
      </p>
     </a>
     <ul class="nav nav-treeview">


      <li class="nav-item">
       <a href="category.php" class="nav-link">
        <i class="fas fa-list"></i>
        <p>Manage All Categories</p>
       </a>
      </li>
     </ul>
    </li>
    <?php
      if($_SESSION['user_role']==1){ ?>
    <li class="nav-item">
     <a href="#" class="nav-link">
      <i class="fas fa-users"></i>
      <p>
       Users
       <i class="right fas fa-angle-left"></i>
      </p>
     </a>
     <ul class="nav nav-treeview">

      <!-- Manage All Users -->
      <li class="nav-item">
       <a href="users.php?do=Manage" class="nav-link">
        <i class="fas fa-user"></i>
        <p>Manage All Users</p>
       </a>
      </li>
      <li class="nav-item">
       <a href="users.php?do=Add" class="nav-link">
        <i class="fas fa-user-plus"></i>
        <p>Add New User</p>
       </a>
      </li>
     </ul>

    </li>



    <?php
      }
    ?>
    <?php
     if($_SESSION['user_role']==2){ ?>
    <li class="nav-item">
     <a href="profile.php" class="nav-link">
      <i class="fas fa-user"></i>
      <p>
       Profile
      </p>
     </a>


    </li>

    <?php } ?>
    <li class="nav-item">
     <a href="logout.php" class="nav-link">
      <i class="fas fa-sign-out-alt"></i>
      <p>
       Logout
      </p>
     </a>


    </li>
   </ul>

  </nav>
  <!-- /.sidebar-menu -->
 </div>
 <!-- /.sidebar -->
</aside>
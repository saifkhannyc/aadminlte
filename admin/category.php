<?php 
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
     <h1 class="m-0">Manage all category</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
     <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
      <li class="breadcrumb-item active">Manage All Category</li>
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
    <!-- Update  Category Start -->
    <div class="col-md-6">
     <?php
        if(isset($_GET['UpdateId'])){
          $update_cat_id=$_GET['UpdateId'];
          $data= "SELECT * FROM category WHERE cat_id= $update_cat_id";
          $readData= mysqli_query($dbc,$data);
          while ($row=mysqli_fetch_assoc($readData)){ 
            $cat_id =$row['cat_id'];
            $cat_name=$row['cat_name'];
            $cat_desc=$row['cat_desc'];
            $parent_id=$row['parent_id'];
            $status=$row['statuses'];
            ?>
     <!-- Edit Block start -->
     <div class="card card-primary">
      <div class="card-header">
       <h3 class="card-title">Edit Category</h3>

       <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
         <i class="fas fa-minus"></i>
        </button>
       </div>
      </div>
      <div class="card-body">
       <form action="" method="POST">
        <!-- Category/ Sub-Category Name -->
        <div class="form-group">
         <label for="cat_name">Category/ Sub-Category Name</label>
         <input type="text" id="catsub" class="form-control" name="cat_name" value="<?php echo $cat_name;?>">
        </div>
        <!-- Category Description -->
        <div class="form-group">
         <label for="cat_desc">Category Description</label>
         <textarea id="cat_desc" class="form-control" rows="4" name="cat_desc"><?php echo $cat_desc;?></textarea>
        </div>
        <!-- Parent Category -->
        <div class="form-group">
         <label for="parent_id">Parent Category[Optional]</label>
         <select id="parent_id" class="form-control custom-select" name="parent_id">
          <option value="0">Select the parent category</option>
          <?php 
           $query="SELECT * FROM category WHERE parent_id=0 order by cat_name ASC";
           $readParent=mysqli_query($dbc, $query);
           while($row=mysqli_fetch_assoc($readParent)){ 
            $parent_cat_id  =$row['cat_id'];
            $parent_cat_name=$row['cat_name'];
            ?>
          <option value="<?php echo $parent_cat_id; ?> " <?php if ( $parent_cat_id==$parent_id) {echo 'selected';} ?>>
           <?php echo $parent_cat_name; ?></option>
          <?php
           }

          ?>
         </select>
        </div>
        <!-- Status -->
        <div class="form-group">
         <label for="status">Status</label>
         <select id="status" class="form-control custom-select" name="status">
          <option value="0">Please select the status</option>
          <option value="1" <?php if($status==1){ echo 'selected';} ?>>Active</option>
          <option value="2" <?php if($status==2){ echo 'selected';} ?>>Inactive</option>
         </select>
        </div>
        <div class="form-group">
         <input type="submit" name="save" value="Save Changes" class="btn btn-primary">
        </div>
       </form>

      </div>
      <!-- /.card-body -->
     </div>
     <!-- Edit block ends -->
     <?php  
          }
        }
      ?>

     <!-- Update Category Info into the Database -->
     <?php 
        if(isset($_POST['save'])) { 
          $cat_name=mysqli_real_escape_string($dbc,$_POST['cat_name']);
          $cat_desc=mysqli_real_escape_string($dbc,$_POST['cat_desc']);
          $parent_id=$_POST['parent_id'];
          $status=$_POST['status'];
          $updateQuery="UPDATE category SET cat_name='$cat_name', cat_desc='$cat_desc',parent_id='$parent_id', statuses='$status' where cat_id='$update_cat_id'";
          
          $UpdateCategoryInfo=mysqli_query($dbc,$updateQuery);
          if($UpdateCategoryInfo) { 
            header("Location:category.php");
          } else{ 
            echo "Not updated";
          }
        }
      
      ?>

     <!-- Add Category Block Starts -->
     <div class="card card-primary">
      <div class="card-header">
       <h3 class="card-title">Add New Category</h3>

       <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
         <i class="fas fa-minus"></i>
        </button>
       </div>
      </div>
      <div class="card-body">
       <form action="" method="POST">
        <!-- Category/ Sub-Category Name -->
        <div class="form-group">
         <label for="cat_name">Category/ Sub-Category Name</label>
         <input type="text" id="catsub" class="form-control" name="cat_name">
        </div>
        <!-- Category Description -->
        <div class="form-group">
         <label for="cat_desc">Category Description</label>
         <textarea id="cat_desc" class="form-control" rows="4" name="cat_desc"></textarea>
        </div>
        <!-- Parent Category -->
        <div class="form-group">
         <label for="parent_id">Parent Category[Optional]</label>
         <select id="parent_id" class="form-control custom-select" name="parent_id">
          <option value="0">Select the parent category</option>
          <?php 
           $query="SELECT * FROM category WHERE parent_id=0 order by cat_name ASC";
           $readParent=mysqli_query($dbc, $query);
           while($row=mysqli_fetch_assoc($readParent)){ 
            $parent_cat_id  =$row['cat_id'];
            $parent_cat_name=$row['cat_name'];
            ?>
          <option value="<?php echo $parent_cat_id; ?>">
           <?php echo $parent_cat_name; ?></option>
          <?php
           }

          ?>
         </select>
        </div>
        <!-- Status -->
        <div class=" form-group">
         <label for="status">Status</label>
         <select id="status" class="form-control custom-select" name="status">
          <option value="0">Please select the status</option>
          <option value="1">Active</option>
          <option value="0">Inactive</option>
         </select>
        </div>
        <div class="form-group">
         <input type="submit" name="add_cat" value="Add New Category" class="btn btn-primary">
        </div>
       </form>

      </div>
      <!-- /.card-body -->
     </div>
     <!-- /.card -->
     <!-- Add Category Block ends -->
    </div>
    <!-- Insert the Category into the DB -->
    <?php 
      if (isset($_POST['add_cat'])){
       $cat_name=mysqli_real_escape_string($dbc,$_POST['cat_name']);
       $cat_desc=mysqli_real_escape_string($dbc,$_POST['cat_desc']);
       $parent_id=mysqli_real_escape_string($dbc,$_POST['parent_id']);
       $status=mysqli_real_escape_string($dbc,$_POST['status']);
       $query="INSERT INTO category (cat_name, cat_desc, parent_id, statuses) VALUES('$cat_name','$cat_desc','$parent_id','$status')";
       $addCategory=mysqli_query($dbc,$query);
       if($addCategory) { 
        header("Location:category.php");
       } else{ 
         echo "Not added";
       }
      }
     ?>


    <!-- Manage all the category -->
    <div class="col-md-6">
     <div class="card">
      <div class="card-header">
       <h3 class="card-title">Manage All category</h3>
      </div>
      <div class="card-body">
       <table class="table table-bordered">
        <thead>
         <tr>
          <th scope="col">#</th>
          <th scope="col">Cat Name</th>
          <th scope="col">Primary/ Sub</th>
          <th scope="col">Status</th>
          <th scope="col">Action</th>
         </tr>
        </thead>
        <tbody>
         <?php
         $query="SELECT * FROM category where parent_id=0 order by cat_name ASC";
         $allcat=mysqli_query($dbc, $query);
         $i=0;
         while($row=mysqli_fetch_assoc($allcat)){
         $cat_id =$row['cat_id'];
         $cat_name=$row['cat_name'];
         $parent_id=$row['parent_id'];
         $status=$row['statuses'];
         $i++;
         ?>
         <tr>
          <th scope="row"><?php echo $i; ?></th>
          <td><?php echo $cat_name; ?></td>
          <td>
           <?php 
              echo '<span class="badge badge-primary">Primary Category</span>'; 
           
    
          ?>


          </td>
          <td>
           <?php 
              if($status==1){
                echo '<span class="badge badge-success">Active</span>'; 
              } else{ 
                echo '<span class="badge badge-danger">Inactive</span>';
              }
            ?>
          </td>
          <td>
           <a href="category.php?UpdateId=<?php echo $cat_id;?>" data-toggle="tooltip" title="Edit"><i
             class="fa fa-edit"></i></a>
           <a href="" data-toggle="modal" data-target="#deleteCategory<?php echo $cat_id;?>" title="Delete"><i
             class="fa fa-trash" style="color:red;"></i></a>
          </td>
          <div class="modal fade" id="deleteCategory<?php echo $cat_id;?>" tabindex="-1"
           aria-labelledby="exampleModalLabel" aria-hidden="true">
           <div class="modal-dialog">
            <div class="modal-content">
             <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Are you confirm to delete this category?</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
              </button>
             </div>
             <div class="modal-body">

              <a href="category.php?catid=<?php echo $cat_id;?>" name="delete" type="submit"
               class="btn btn-danger">Confirm</a>
              <a type="button" class="btn btn-success" data-dismiss="modal">Cancel</a>



             </div>

            </div>
           </div>
          </div>
         </tr>
         <?php 
          $childCatQuery="SELECT * FROM category WHERE parent_id='$cat_id' order by cat_name ASC";
          $childCat=mysqli_query($dbc,$childCatQuery);
          while($row=mysqli_fetch_assoc($childCat)){ 
            $child_cat_id =$row['cat_id'];
            $cat_name =$row['cat_name'];
            $cat_desc =$row['cat_desc'];
            $parent_id=$row['parent_id'];
            $status   =$row['statuses'];
            $i++;
            ?>
         <tr>
          <th scope="row"><?php echo $i; ?></th>
          <td>-- <?php echo $cat_name; ?></td>
          <td>
           <?php 
              echo '<span class="badge badge-dark">Child</span>'; 
           
    
          ?>


          </td>
          <td>
           <?php 
              if($status==1){
                echo '<span class="badge badge-success">Active</span>'; 
              } else{ 
                echo '<span class="badge badge-danger">Inactive</span>';
              }
            ?>
          </td>
          <td>
           <a href="category.php?UpdateId=<?php echo $child_cat_id;?>" data-toggle="tooltip" title="Edit"><i
             class="fa fa-edit"></i></a>
           <a href="" data-toggle="modal" data-target="#deleteSubCategory<?php echo $child_cat_id;?>" title="Delete"><i
             class="fa fa-trash" style="color:red;"></i></a>
           <div class="modal fade" id="deleteSubCategory<?php echo $child_cat_id;?>" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
             <div class="modal-content">
              <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLabel">Are you confirm to delete this sub-category?</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
               </button>
              </div>
              <div class="modal-body">

               <a href="category.php?subid=<?php echo $child_cat_id;?>" name="delete" type="submit"
                class="btn btn-danger">Confirm</a>
               <a type="button" class="btn btn-success" data-dismiss="modal">Cancel</a>



              </div>

             </div>
            </div>
           </div>
          </td>
         </tr>

         <?php  
          }

         }
         ?>
        </tbody>
       </table>
       <!-- Delete Category -->
       <?php 
    
              if (isset($_GET['catid'])){
               $deleteID=$_GET['catid'];
               $query1="DELETE FROM category WHERE parent_id= '$deleteID'";
               $deleteSubCategory= mysqli_query($dbc,$query1);
               $query2="DELETE FROM category WHERE cat_id= '$deleteID'";
               $deleteCategory= mysqli_query($dbc,$query2);
               if ($deleteCategory && $deleteSubCategory){
                header("Location:category.php");
               } else{
                die("Operation Failed." .mysqli_error($dbc));
               }
              }
    
    ?>

       <!-- Delete Sub Category -->
       <?php 
    
              if (isset($_GET['subid'])){
               $subID=$_GET['subid'];
               $query="DELETE FROM category WHERE cat_id= '$subID'";
               $deleteSubCategory= mysqli_query($dbc,$query);
               if ($deleteSubCategory){
                header("Location:category.php");
               } else{
                die("Operation Failed." .mysqli_error($dbc));
               }
              }
    
    ?>
      </div>
     </div>

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
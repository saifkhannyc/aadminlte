<?php
 


 function countUsers($active, $role){ 
  include 'inc/db.php';
  if($active==1 && $role==0){ 
   $query="SELECT * FROM users where user_role=3 AND status=1";
   $queryData=mysqli_query($dbc,$query);
   $countData=mysqli_num_rows($queryData);
   return $countData;
  } else if($active==1 && $role==2) { 
   $query="SELECT * FROM users where user_role=2 AND status=1";
   $queryData=mysqli_query($dbc,$query);
   $countData=mysqli_num_rows($queryData);
   return $countData;
  }
  else if($active==2 && $role==3) { 
   $query="SELECT * FROM users where user_role=3 AND status=2";
   $queryData=mysqli_query($dbc,$query);
   $countData=mysqli_num_rows($queryData);
   return $countData;
  }
 }

 function countCategories($id) { 
  include 'inc/db.php';
  if($id==0) { 
   $query="SELECT * FROM category where parent_id='$id'";
   $queryData=mysqli_query($dbc,$query);
   $countData=mysqli_num_rows($queryData);
   return $countData;
  } else if($id==1) { 
   $query="SELECT * FROM category where parent_id !=0";
   $queryData=mysqli_query($dbc,$query);
   $countData=mysqli_num_rows($queryData);
   return $countData;
  }
 }

 
?>
<?php include '../lib/session.php'; 
    Session::checkSession();
     ?>

<?php
include '../config/config.php';
?>
<?php
include '../lib/Database.php';
?>
<?php
include '../helpers/format.php';
?>
<?php $db=new Database();
 ?>

 <?php  
if (!isset($_GET['delpageid'])or $_GET['delpageid']==NULL) {
  echo "<script>window.location='index.php'</script>";
  //header("Location:catlist.php");
}else
{
  $id=$_GET['delpageid'];
  $delquery="DELETE FROM tbl_page where id='$id'";
  $deldata=$db->delete($delquery);
  if($deldata)
  {
  	echo "<script>alert('Page Deleted Successfully');</script>";
  	echo "<script>window.location='index.php'</script>";
  }
  else
  {
  	echo "<script>alert('Page Not Deleted ');</script>";
  	echo "<script>window.location='index.php'</script>";

  }
}



?>

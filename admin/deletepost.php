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
if (!isset($_GET['delid'])or $_GET['delid']==NULL) {
  echo "<script>window.location='postlist.php'</script>";
  //header("Location:catlist.php");
}else
{
  $id=$_GET['delid'];

  $query="SELECT * FROM tbl_post where id='$id'";
  $getdata=$db->select($query);
  if($getdata)
  {
  	while ($delimg=$getdata->fetch_assoc()) {
  		$dellink=$delimg['image'];
  		unlink($dellink);
  	}
  }
  $delquery="DELETE FROM tbl_post where id='$id'";
  $deldata=$db->delete($delquery);
  if($deldata)
  {
  	echo "<script>alert('Data Deleted Successfully');</script>";
  	echo "<script>window.location='postlist.php'</script>";
  }
  else
  {
  	echo "<script>alert('Data Not Deleted ');</script>";
  	echo "<script>window.location='postlist.php'</script>";

  }
}



?>

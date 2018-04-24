<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php  
if (!isset($_GET['catid'])or $_GET['catid']==NULL) {
  echo "<script>window.location='catlist.php'</script>";
  //header("Location:catlist.php");
}else
{
  $id=$_GET['catid'];
}

?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Category</h2>
              <div class="block copyblock">
<?php 

 if ($_SERVER['REQUEST_METHOD']=='POST') {
           $name=$fm->validation($_POST['name']);
          $name=mysqli_real_escape_string($db->link,$name);
          if(empty($name))
          {
            echo "<span style='color:red'>Field Must Not Be Empty</span>";
          }else
          {
            $query="UPDATE tbl_catagory
                   SET name='$name'
                   where id='$id'";
            $updated_row=$db->update($query);
            if($updated_row)
            {
               echo "<span style='color:green'>Catagory ipdated Successfully</span>";  
            }
            else
            {
              echo "<span style='color:red'>>Catagory Not updated</span>";  
            }
          }
       }
?>
<?php 
$query="SELECT * from tbl_catagory where id='$id' order by id desc";
 $catagory=$db->select($query);
 while($result=$catagory->fetch_assoc()) {
                       
?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="name" value="<?php echo $result['name']; ?>" class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                    <?php } ?>
                </div>
            </div>
        </div>
       <?php include 'inc/footer.php';  ?>

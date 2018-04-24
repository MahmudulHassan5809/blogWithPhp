<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php  
if (!isset($_GET['viewid'])or $_GET['viewid']==NULL) {
  echo "<script>window.location='postlist.php'</script>";
  //header("Location:catlist.php");
}else
{
  $id=$_GET['viewid'];
}

?>

        






        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Post</h2>
               <?php
                 if ($_SERVER['REQUEST_METHOD']=='POST') {
                   
         echo "<script>window.location='postlist.php'</script>";
                  

         
}
 ?>
                 <div class="block"> 
               <?php  
               $query="SELECT * from tbl_post WHERE id='$id' order by id desc";
               $getpost=$db->select($query);
               if($getpost)
               {
                while ($postresult=$getpost->fetch_assoc()) {
                    
                


               ?>

                 <form action="" method="POST" enctype="multipart/form-data">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" readonly="" value="<?php echo $postresult['title'];  ?>" class="medium" />
                            </td>
                        </tr>
                     
                        <tr>
                            <td>
                                <label>Category</label>
                            </td>
                            <td>
                                <select id="select" name="cat">
                              <option>Select Option</option>
                               <?php  
                                    $query="SELECT * FROM tbl_catagory";
                                   $catagory=$db->select($query);
                                   if($catagory)
                                   {
                                    while ($result=$catagory->fetch_assoc()) {
                                        # code...
                                    
                                 ?>
                                    <option 
                                    <?php 
                                       if($postresult['cat']=$result['id']){?>
                                        
                                        selected="selected"
                                      <?php }


                                     ?>

                                    value="<?php echo $result['id']; ?>"><?php echo $result['name']; ?></option>
                                    <?php } }?>
                              
                                </select>
                            </td>
                        </tr>
                   
                    
                        <tr>
                            <td>
                                <label>Image</label>
                            </td>
                            <td>
                            <img src=" <?php echo $postresult['image'];  ?>" height="50px" width="100px"><br>
                              
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body">
                                    
                                <?php echo $postresult['body'];  ?>

                                </textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Tags</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $postresult['tags'];  ?>" readonly="" 
                                class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Author</label>
                            </td>
                            <td>
                                <input type="text" readonly="" value="<?php echo $postresult['author'];  ?>" class="medium" />
                                <input type="text" readonly="" value="<?php echo Session::get('userid');  ?>" class="medium" />
                            </td>
                        </tr>
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Ok" />
                            </td>
                        </tr>
                    </table>
                    </form>
                    <?php } } ?>
                </div>
            </div>
        </div>
        <!-- Load TinyMCE -->
    <script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            setupTinyMCE();
            setDatePicker('date-picker');
            $('input[type="checkbox"]').fancybutton();
            $('input[type="radio"]').fancybutton();
        });
    </script>

        <?php include 'inc/footer.php' ;  ?>

 
<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php  
if (!isset($_GET['pageid'])or $_GET['pageid']==NULL) {
  echo "<script>window.location='index.php'</script>";
  //header("Location:catlist.php");
}else
{
  $id=$_GET['pageid'];
}

?>
<style type="text/css">
    
    .actiondel
    {
        margin-left: 10px;

    }
    .actiondel a
    {
        color: #444;
        cursor: pointer;
        font-size: 20px;
        padding: 2px 10px;
        font-weight: normal;
        background-color: #f0f0f0;
    }
</style>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Pages</h2>
               <?php
                 if ($_SERVER['REQUEST_METHOD']=='POST') {
                   

                   $name=$fm->validation($_POST['name']);
                  
                   $body=$fm->validation($_POST['body']);
               
                  $name=mysqli_real_escape_string($db->link,$name);
                  $body=mysqli_real_escape_string($db->link,$body);
                    
                 

                 if($name==""||$body=="") 
            {
                 echo "<span style=color:red>Field Must Not Be empty.</span>";
            }else {
             $query="UPDATE tbl_page
                   SET 
                   name='$name',
                   body='$body'
                   where id='$id'";
            $updated_row=$db->update($query);
        if ($updated_row) {
         echo "<span>Page Updated Successfully.</span>";
        }else {
         echo "<span class='error'>Page Not Updated  !</span>";
        }

             }
         }
         

 ?>
                 <div class="block"> 
                  <?php   
           $query="SELECT * FROM tbl_page where id='$id'";
           $pages=$db->select($query);
           if ($pages) {
               while ($result=$pages->fetch_assoc()) {
                   ?>              
                 <form action="" method="POST" >
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name="name" value="<?php echo $result['name'];  ?>" class="medium" />
                            </td>
                        </tr>
                     
                        
                    
                     
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce"  name="body">
                                    
                               <?php echo $result['body'];  ?>

                                </textarea>
                            </td>
                        </tr>
                        <tr>
                        
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                                <span class="actiondel"><a  onclick="return confirm('Are You sure');" href="delpage.php?delpageid=<?php echo $result['id'];  ?>">DELETE</a></span>
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

 
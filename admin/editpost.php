<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>

<?php  
if (!isset($_GET['editid'])or $_GET['editid']==NULL) {
  echo "<script>window.location='postlist.php'</script>";
  //header("Location:catlist.php");
}else
{
  $id=$_GET['editid'];
}

?>

        






        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Post</h2>
               <?php
                 if ($_SERVER['REQUEST_METHOD']=='POST') {
                   

                   $title=$fm->validation($_POST['title']);
                    
                   $body=$fm->validation($_POST['body']);
                   $tags=$fm->validation($_POST['tags']);
                   $author=$fm->validation($_POST['author']);
                    $userid=$fm->validation($_POST['userid']);
                  $title=mysqli_real_escape_string($db->link,$title);
                   $cat=mysqli_real_escape_string($db->link,$_POST['cat']);
                    $body=mysqli_real_escape_string($db->link,$body);
                     $tags=mysqli_real_escape_string($db->link,$tags);
                   $author=mysqli_real_escape_string($db->link,$author);
                  $userid=mysqli_real_escape_string($db->link,$userid);

           
             $permited=array('jpg','jpeg','png','gif');
             $file_name=$_FILES['image']['name'];
             $file_size=$_FILES['image']['size'];
             $file_tmp=$_FILES['image']['tmp_name'];

             $div=explode('.', $file_name);
             $file_ext=strtolower(end($div));
            $unique_image=substr(md5(time()), 0,10).'.'.$file_ext;
            $uploaded_image="upload/".$unique_image;
            if($title==""||$cat==""||$body==""||$tags==""||$author=="") 
            {
                 echo "<span style=color:red>Field Must Not Be empty.</span>";
            }
             else{
         
            if(!empty($file_name))
            {
              
            
            if($file_size>1048567)
            {
               echo "<span class='success'>Image Size Should Be less Than 1 MB.</span>";
            }
            if(in_array($file_ext, $permited)===false)
            {
             echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
            }
        else{
         
       
        move_uploaded_file($file_tmp,$uploaded_image);
        $query="UPDATE tbl_post
                set
                cat='$cat',
                title='$title',
                body='$body',
                image='$uploaded_image',
                author='$author',

                tags='$tags',
                userid='$userid'
             WHERE id='$id'   
        ";
        $updated_rows = $db->update($query);
        if ($updated_rows) {
         echo "<span>post Updated Successfully.</span>";
        }else {
         echo "<span class='error'>post Not Updates !</span>";
        }
    }
}else
{
    $query="UPDATE tbl_post
                set
                cat='$cat',
                title='$title',
                body='$body',
               
                author='$author',
                tags='$tags',
                userid='$userid'
             WHERE id='$id'   
        ";
        $updated_rows = $db->update($query);
        if ($updated_rows) {
         echo "<span>post Updated Successfully.</span>";
        }else {
         echo "<span class='error'>post Not Updates !</span>";
        }
}
}

         
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
                                <input type="text" name="title" value="<?php echo $postresult['title'];  ?>" class="medium" />
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
                                <label>Upload Image</label>
                            </td>
                            <td>
                            <img src=" <?php echo $postresult['image'];  ?>" height="50px" width="100px"><br>
                                <input type="file" name="image" />
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
                                <input type="text" value="<?php echo $postresult['tags'];  ?>" name="tags" 
                                class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Author</label>
                            </td>
                            <td>
                                <input type="text" name="author" value="<?php echo $postresult['author'];  ?>" class="medium" />
                                <input type="text" name="userid" value="<?php echo Session::get('userid');  ?>" class="medium" />
                            </td>
                        </tr>
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Save" />
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

 
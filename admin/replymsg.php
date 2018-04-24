<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
if (!isset($_GET['msgid'])or $_GET['msgid']==NULL) {
  echo "<script>window.location='inbox.php'</script>";
  //header("Location:catlist.php");
}else
{
  $id=$_GET['msgid'];
}
?>

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>View Message</h2>
               <?php
                 if ($_SERVER['REQUEST_METHOD']=='POST') {
                    $to=$fm->validation($_POST['toemail']);
                    $from=$fm->validation($_POST['fromemail']); 
                    $subject=$fm->validation($_POST['subject']); 
                    $body=$fm->validation($_POST['body']);
                 $sendmail=mail($to, $subject,  $body,$body) ;
                 if($sendmail)
                 {
                    echo "<span style='color:green'>Mail Send SuccessFully</span>";
                 } 
                 else{
                       echo "<span style='color:red'>Mail Not Send SuccessFully</span>";
                 }   
        
         }
         

 ?>
                 <div class="block">               
                 <form action="" method="POST" enctype="multipart/form-data">
                 <?php
                     $query="SELECT email from tbl_contact where id='$id' ";
                     $msg=$db->select($query);
                     if($msg)
                     {
                            $i=0;
                        while ($result=$msg->fetch_assoc()) {
                            $i++;
                        ?>
                    <table class="form">
                       
                       
                        <tr>
                            <td>
                                <label>To</label>
                            </td>
                            <td>
                                <input type="text" name="toemail" readonly="" value="<?php echo $result['email']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>From</label>
                            </td>
                            <td>
                                <input type="text" name="fromemail" placeholder="Enter Your Email"   class="medium" />
                            </td>
                        </tr>
                       <tr>
                            <td>
                                <label>Subject</label>
                            </td>
                            <td>
                                <input type="text" name="subject"  placeholder="Plz Enter Subject"  class="medium" />
                            </td>
                        </tr>
                        
                    
                     
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Message</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body">


                                </textarea>
                            </td>
                        </tr>
                        <tr>
                        
                        
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Send" />
                            </td>
                        </tr>
                    </table>
                    <?php } } ?>
                    </form>
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

 
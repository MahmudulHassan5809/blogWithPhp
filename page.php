<?php
include 'inc/header.php';
?>

<?php  
if (!isset($_GET['pageid'])or $_GET['pageid']==NULL) {
  echo "<script>window.location='index.php'</script>";
  //header("Location:catlist.php");
}else
{
  $id=$_GET['pageid'];
}

?>

    <?php   
           $query="SELECT * FROM tbl_page where id='$id'";
           $pages=$db->select($query);
           if ($pages) {
               while ($result=$pages->fetch_assoc()) {
                   ?>  
	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
			
				<h2><?php echo $result['name'] ;?></h2>
	
				<?php echo $result['body'];   ?>
				
	</div>


		</div>
		<?php } } else {header("Location:404.php");} ?>
		<?php
           include 'inc/sidebar.php';
		?>
	</div>

	<?php

    include 'inc/footer.php'; 
	?>
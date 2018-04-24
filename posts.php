<?php
include 'inc/header.php';
?>

 <?php 
$db=new Database();
$fm=new Format();

 ?>
 <?php 
if (!isset($_GET['catagory'])|| $_GET['catagory']==NULL) {
	header("Location: 404.php");
}else
{
  $catagory=($_GET['catagory']); 
}

?>
  <?php 
          $query="SELECT * FROM tbl_post where cat='$catagory'";
          $post= $db->select($query);
          if($post)
          {
             while($result=$post->fetch_assoc())
             {



		 ?>
	

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
        <div class="samepost clear">
				<h2><a href="post.php?id=<?php echo $result['id'] ; ?>"><?php echo $result['title']  ?></a></h2>
				<h4><?php echo $fm->formatDate($result['date']);?> By <a href="#"><?php echo $result['author']  ?></a></h4>
				 <a href="#"><img src="admin/upload/post2.png" alt="post image"/></a>
				<p>

					<?php echo $fm->textShort($result['body']);  ?>
				

				</p>
				<div class="readmore clear">
					<a href="post.php?id=<?php echo $result['id'] ; ?>">Read More </a>
				</div>
			</div>

        </div>
      <?php  } }else { header("Location:404.php");} ?>
        </div>
        




        <?php
           include 'inc/sidebar.php';
		?>

    <?php

    include 'inc/footer.php'; 
	?>

<?php
include 'config/config.php';
?>
<?php
include 'lib/Database.php';
?>
<?php
include 'helpers/format.php';
?>
<?php $db=new Database();
      $fm=new Format();
  ?>
     <?php
      //set headers to NOT cache a page
      header("Cache-Control: no-cache, must-revalidate"); //HTTP 1.1
      header("Pragma: no-cache"); //HTTP 1.0
      header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
      // Date in the past
      //or, if you DO want a file to cache, use:
      header("Cache-Control: max-age=2592000"); 
    //30days (60sec * 60min * 24hours * 30days)
    ?>
<!DOCTYPE html>
<php>
<head>
   <?php 
      if(isset($_GET['pageid']))
      {
          $pagetitleid=$_GET['pageid'];

           $query="SELECT * FROM tbl_page where id='$pagetitleid'";
           $pages=$db->select($query);
           if ($pages) {
               while ($result=$pages->fetch_assoc()) {?>
                 <title><?php echo $result['name']; ?>-<?php echo TITLE; ?></title> 
                 
     <?php      } 
  
      }
  }elseif(isset($_GET['id']))
      {
          $postid=$_GET['id'];

           $query="SELECT * FROM tbl_post where id='$postid'";
           $post=$db->select($query);
           if ($post) {
               while ($result=$post->fetch_assoc()) {?>
                 <title><?php echo $result['title']; ?>-<?php echo TITLE; ?></title> 
                 
     <?php      } 
  
      }
  }else{?>
    <title><?php echo $fm->title(); ?>-<?php echo TITLE; ?></title>  
<?php  }?>
	
	<meta name="language" content="English">
	<meta name="description" content="It is a website about education">
   <?php
       if (isset($_GET['id'])) {
         $id=$_GET['id'];
          $query="SELECT * FROM tbl_post where id='$postid'";
           $keyword=$db->select($query);
           if ($keyword) {
             while ($result=$keyword->fetch_assoc()) {?>
             <meta name="keywords" content="<?php echo $result['tags']; ?>">
      <?php }}}else{        ?>
             <meta name="keywords" content="<?php echo KEYWORDS ; ?>">
 <?php     }?>


     
	<meta name="keywords" content="blog,cms blog">
	<meta name="author" content="Mahmudul">
	<link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">	
	<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="style.css">
	<script src="js/jquery.js" type="text/javascript"></script>
	<script src="js/jquery.nivo.slider.js" type="text/javascript"></script>

<script type="text/javascript">
$(window).load(function() {
	$('#slider').nivoSlider({
		effect:'random',
		slices:10,
		animSpeed:500,
		pauseTime:5000,
		startSlide:0, //Set starting Slide (0 index)
		directionNav:false,
		directionNavHide:false, //Only show on hover
		controlNav:false, //1,2,3...
		controlNavThumbs:false, //Use thumbnails for Control Nav
		pauseOnHover:true, //Stop animation while hovering
		manualAdvance:false, //Force manual transitions
		captionOpacity:0.8, //Universal caption opacity
		beforeChange: function(){},
		afterChange: function(){},
		slideshowEnd: function(){} //Triggers after all slides have been shown
	});
});
</script>
</head>

<body>
	<div class="headersection templete clear">
		<a href="#">
			<div class="logo">
			<?php  
              $query="SELECT * FROM title_slogan where id=1";
           $blog_title=$db->select($query);
           if ($blog_title) {
               while ($result=$blog_title->fetch_assoc()) {

			?>
				<img src="admin/<?php echo $result['logo'];   ?>" alt="Logo"/>
				<h2><?php echo $result['title'];   ?></h2>
				<p><?php echo $result['slogan'];   ?></p>

			<?php } }?>
			</div>
		</a>
		<div class="social clear">
			<div class="icon clear">
			<?php   
           $query="SELECT * FROM tbl_social where id=1";
           $socialmedia=$db->select($query);
           if ($socialmedia) {
               while ($result=$socialmedia->fetch_assoc()) {
                   # code...
               

   ?>
				<a href="<?php echo $result['fb'] ;  ?>" target="_blank"><i class="fa fa-facebook"></i></a>
				<a href="<?php echo $result['tw'] ;  ?>" target="_blank"><i class="fa fa-twitter"></i></a>
				<a href="<?php echo $result['ln'] ;  ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
				<a href="<?php echo $result['gp'] ;  ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
				<?php } } ?>
			</div>
			<div class="searchbtn clear">
			<form action="search.php" method="get">
				<input type="text" name="search" placeholder="Search keyword..."/>
				<input type="submit" name="submit" value="Search"/>
			</form>
			</div>
		</div>
	</div>
<div class="navsection templete">
 <?php 
     $path=$_SERVER['SCRIPT_FILENAME'];
     $currentpage =basename($path,'.php');
   ?>
	<ul>
		<li><a
          <?php
              if ($currentpage=='index') { echo 'id="active"';}?>
               href="index.php">Home</a></li>
		
		 <?php   
           $query="SELECT * FROM tbl_page";
           $pages=$db->select($query);
           if ($pages) {
               while ($result=$pages->fetch_assoc()) {
                   ?>
   <li><a 
   <?php
         if(isset($_GET['pageid'])&& $_GET['pageid']==$result['id'])
      {
             echo "id=active";
         }
      ?>
   href="page.php?pageid=<?php echo $result['id'];   ?>"><?php echo $result['name'];   ?></a> </li>
                <?php } } ?>
		<li><a 
           <?php
              if ($currentpage=='contact') {
              	 echo 'id="active"';
              }

              ?>

		href="contact.php">Contact</a></li>
	</ul>
</div>
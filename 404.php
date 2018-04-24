<!DOCTYPE php>
<php>
<head>
	<title>Basic Website</title>
	<link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">
	<link rel="stylesheet" href="style.css">
<?php
include 'inc/header.php';
?>
<?php
include 'inc/slider.php';
?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<div class="notfound">
    				<p><span>404</span> Not Found</p>
    			</div>
	        </div>
		</div>
		<div class="sidebar clear">
			<div class="samesidebar clear">
				<h2>Latest articles</h2>
					<ul>
						<li><a href="#">Category One</a></li>
						<li><a href="#">Category Two</a></li>
						<li><a href="#">Category Three</a></li>
						<li><a href="#">Category Four</a></li>
						<li><a href="#">Category Five</a></li>						
					</ul>
			</div>
			<?php
           include 'inc/sidebar.php';
		?>
			
		</div>
	</div>
<?php

    include 'inc/footer.php'; 
	?>
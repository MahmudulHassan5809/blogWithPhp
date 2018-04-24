<?php include '../lib/session.php'; 
    Session::init();
    Session::checkLogin();
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
      $fm=new Format();
?>


<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
	<?php  
       if ($_SERVER['REQUEST_METHOD']=='POST') {
       	   $email=$fm->validation($_POST['email']);
       	 
       	   $email=mysqli_real_escape_string($db->link,$email);
           if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
           echo "<span style='color:red'>Invalid Email !</span>";;
           } 

       	  else { 
                 $mailquery="SELECT * from tbl_user where email='$email' limit 1";
           $mailcheck=$db->select($mailquery);


            
       	   
       	   if($mailcheck!=false)
       	   {
       	   	    while ($value=$mailcheck->fetch_assoc()) {
                   $userid=$value['id'];
                   $username=$value['username'];
                
             
                 $text=substr($email, 0,3);
                 $rand=rand(1000,99999);
                $newpass="$text$rand";
                $password=md5($newpass);
                $query="UPDATE tbl_user
                   SET password='$password'
                   where id='$userid'";
            $updated_row=$db->update($query);
            $to=$email;
            $from="mahmudul.hassan240@gmail.com";
            $headers.="From: $from\n";
              $headers.= 'MIME-Version: 1.0' . "\r\n" .
    $headers='Content-type: text/html; charset=iso-8859-1' . "\r\n"; 
    $subject="Your Password";
    $message="Tour User Name Is".$username."And Password Is".$newpass."Plz website to login";
      $sendmail=mail($to, $subject, $message, $headers);
             }
             if ($sendmail) {
               echo "<span style='color:green'>Plz check mail</span>";
             }else
             {
              echo "<span style='color:red'>Sorry something error !</span>";
             }
            
       	   }else
       	   {
       	   	echo "<span style='color:red'>Mail Not Exists !</span>";
       	   }
         }
       }
       
     



	?>
		<form action="" method="post">
			<h1>Password Recovery</h1>
			<div>
				<input type="text" placeholder="Enter Valid Email" required="" name="email"/>
			</div>
			
			<div>
				<input type="submit" value="Send Mail" />
			</div>
		</form><!-- form -->
    <div class="button">
      <a href="login.php">Login</a>
    </div>
		<div class="button">
			<a href="#">Training with live project</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</php>
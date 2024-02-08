<?php
	session_start();
	if (isset($_SESSION['myPortfolio'])) {
		$logName = 'logOut';
		$logValue = 'Log Out';
	}else{	
		$logName = 'logIn';
		$logValue = 'Log In';
	}
	if(isset($_POST['logIn'])){
		header('location:Add-Project/signin.php');
	}
	if(isset($_POST['logOut'])){
		$_SESSION['myPortfolio'] = null;
		header('location:/Project-Portfolio');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>About</title>
	<link rel="stylesheet" type="text/css" href="aboutStyle.css">
	<link rel="stylesheet" type="text/css" href="headerStyle.css">
</head>
<body>
	<center>
		<div class="container">
			<?php include 'header.html'; ?>
			<div class="aboutContainer">
				<div class="image"><img src="Ashok_image.jpg"></div>
				<div>
					<div class="col name">ASHOK KUMAR</div>
					<div class="col mobileNo">9785304381</div>
					<div class="col gmailId"><a href="https://google.com/gmail/ashokkhichi010@gmail.com">ashokkhichi010@gmail.com</a></div>
					<div class="col githublink"><a href="https://github.com/ashokkhichi010/">https://github.com/ashokkhichi010/</a></div>
					<form method="post">
						<input type="submit" name="<?php echo $logName; ?>" value="<?php echo $logValue; ?>" />
					</form>
				</div>
			</div>
			<?php include 'footer.html'; ?>
		</div>
	</center>
</body>
</html>
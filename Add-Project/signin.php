<?php
	session_start();
	$connect = mysqli_connect('localhost', 'root', '', 'myportfolio');
	$userError = '';
	if (isset($_POST['signin'])) {
		$userName = $_POST['userName'];
		$password = $_POST['password'];
		$confirmPassword = $_POST['confirmPassword'];

		$selectCommend = "SELECT * FROM `user`";
		$ref = mysqli_query($connect, $selectCommend);
		$userData = mysqli_fetch_assoc($ref);	
		if ($password == $confirmPassword) {
			if ($userName != $userData['username'] || $password != $userData['password']) {
				$userError = '! invalid Username or password';
			}else{
				$_SESSION['myPortfolio'] = 1;
				header('location:/Project-Portfolio');
			}
		}else{
			$userError = '! incorrect password';
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add Project</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<center>
		<form method="post">
			<div id="signin" class="container">
				<input class="col" type="text" name="userName" placeholder="User Name" required />
				<input class="col" type="Password" name="password" placeholder="Password" required />
				<input class="col" type="Password" name="confirmPassword" placeholder="Confirm Password" required />
			<p id="userError"></p>
				<input class="col" type="submit" name="signin" />
				<a href="/Project-Portfolio" class="col cancel-btn" name="cancel">Cancel</a>
			</div>
		</form>
	</center>
	<script type="text/javascript">
		document.getElementById('userError').innerHTML = '<?php echo $userError; ?>';
	</script>
</body>
</html>
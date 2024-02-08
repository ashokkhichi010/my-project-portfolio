<?php 
session_start();
	$_SESSION['pid'] = null;
	$connect = mysqli_connect('localhost','root','','myPortfolio');
	$selectCommend = 'SELECT * FROM `projects`';
	$ref = mysqli_query($connect, $selectCommend);
	$i = 0;
	while($row = mysqli_fetch_array($ref)){
		$pid[$i] = $row['pid'];
		$projectName[$i] = $row['projectname'];
		$projectDescription[$i] = $row['projectdescription'];
		$gitHubLink[$i] = $row['githublink'];
		$i++;
	}
	if (isset($pid)) {
		$projects = count($pid);
	}else{
		$projects = 0;
	}
	$_SESSION['viewPort'] = 'users';
	if (isset($_SESSION['myPortfolio'] )) {
		$_SESSION['viewPort'] = '';
		if (isset($_POST['edit'])) {
			// echo $_POST['edit'];
			$_SESSION['pid'] = $_POST['edit'];
			header('location:Add-Project/');
		}else if (isset($_POST['delete'])) {
			$delete = $_POST['delete'];
			// echo $_POST['delete'];
			$deleteCommend = "delete from `projects` WHERE `pid`='$delete'";
			mysqli_query($connect, $deleteCommend);
			header('location:/Project-Portfolio');
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="headerStyle.css">
	<link rel="stylesheet" type="text/css" href="projectStyle.css">
</head>
<body>
	<center>
		<div class="container">
			<?php include 'header.html'; ?>
			<div class="projectContainer">
			<?php if($projects == 0){
				echo '<h1>Projects Not Fount</h1>';
			}else{
				for ($i = $projects - 1; $i >= 0; $i--) { ?>
				<div class="project">
					<div>
						<h2>
							<a href="<?php echo $projectName[$i]; ?>" target="window" class="project-name">
								<?php echo $projectName[$i]; ?>
							</a>
							<?php 
								if ($_SESSION['viewPort'] == 'users') {
									echo '<a href="'.$gitHubLink[$i].'" class="viewPort"> View Code </a>';
								}else{
									echo '
										<form method="post">
											<button type="submit" class="viewPort" name="edit" value="'.$pid[$i].'">Edit</button>
											<button type="submit" class="viewPort" name="delete" value="'.$pid[$i].'">Remove</button>
										</form>
									';
								}

							?>
						</h2>
					</div>
					<div class="description"><p><?php echo $projectDescription[$i]; ?></p></div>
				</div>
			<?php 
				}	}
				if(isset($_SESSION['myPortfolio'])){
					echo '<a class="add-transaction-btn" href="Add-Project/">+</a>';
				}
			?>
			<?php include 'footer.html'; ?>
			</div>
		</div>
	</center>
</body>
</html>
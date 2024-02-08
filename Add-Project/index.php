<?php 
	session_start();
	if (!isset($_SESSION['myPortfolio'])) {
		header('location:signin.php');
	}else{
		$pid = $_SESSION['pid'];
		$connect = mysqli_connect('localhost', 'root', '', 'myportfolio');
		if (isset($_POST['addProject'])) {
			$projectName = $_POST['projectName'];
			$gitHubLink = $_POST['gitHubLink'];
			$projectDescription = $_POST['projectDescription'];
			// echo $projectName;
			if (isset($pid)) {
				$commend = "UPDATE `projects` set `projectname`='$projectName', `githublink`='$gitHubLink', `projectdescription`='$projectDescription' where `pid`='$pid'";
			}else{
				$commend = "INSERT INTO `projects`(`projectname`,`githublink`,`projectdescription`) VALUES('$projectName','$gitHubLink','$projectDescription')";
			}
			// unset($pid);
			mysqli_query($connect, $commend);
			header('location:/Project-Portfolio');
		}else if (isset($_SESSION['pid'])) {
			// unset($_SESSION['pid']);
			$selectCommend = "SELECT * FROM `projects` WHERE `pid`='$pid'";
			$ref = mysqli_query($connect, $selectCommend);
			$project = mysqli_fetch_assoc($ref);
			$projectName = $project['projectname'];
			$gitHubLink = $project['githublink'];
			$projectDescription = $project['projectdescription'];
		}else{
			$projectName = '';
			$gitHubLink = '';
			$projectDescription = '';
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
            <div id="addProject" class="container">
                <input class="col" type="text" name="projectName" value="<?php echo $projectName; ?>"
                    placeholder="Project Name" required />
                <input class="col" type="text" name="gitHubLink" value="<?php echo $gitHubLink; ?>"
                    placeholder="Git Hub Link" required />
                <textarea class="col" name="projectDescription" placeholder="Project Description" rows="1"
                    cols="59"><?php echo $projectDescription; ?></textarea>
                <input class="col" type="submit" name="addProject" required />
                <a href="/Project-Portfolio" class="col cancel-btn" name="cancel">Cancel</a>
            </div>
        </form>
    </center>
</body>

</html>
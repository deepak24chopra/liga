<?php

include_once 'scripts/core.php';

$url = isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO'], '/')) : [];

$page = "dashboard";
if(!empty($url)) {
	switch ($url[0]) {
		case 'welcome':
			$page = "welcome";
			//$_SESSION['msg'] = "";
			unset($_SESSION['user_id']);
		break;

		case 'dashboard':
			if(empty($_SESSION["user_id"])) {
				header("Location: {$host}/index.php/welcome");
	        	exit;
			}
			$page = "dashboard";
		break;
	}
}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Liga</title>
</head>
<body>
	<?php include_once "views/" . $page . ".php"; ?>
</body>
</html>
<?php unset($_SESSION["msg"]); ?>
<?php //unset($_SESSION["attempts"]); ?>
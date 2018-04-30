<?php

namespace user_module;
include_once 'core.php';

function login($digest="") {
	global $host;
	if($digest != "") {
		$digest = sha1($_POST["password"]);
	}
	presence_of($_POST,"login");

	if($_SESSION["msg"] != "") {
		header("Location: {$host}/index.php/welcome");
        exit;
	}

	$result = find("users","id","email='{$_POST["email"]}' and password='{$digest}'");

	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$_SESSION['user_id'] = $row["id"];
		}
		$_SESSION["msg"] = "@loginsuccess@";
        header("Location: {$host}/index.php/dashboard");
        exit;
	}
	$_SESSION['attempts'] += 1;
	header("Location: {$host}/index.php/welcome");
	exit;

}

//function handler
//which function to call
//value needed
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$func = "\\user_module\\" . $_POST['user_module'];
	$func();
}
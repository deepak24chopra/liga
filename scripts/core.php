<?php

$host = "http://localhost/liga";
//session
if(session_id() == '' || !isset($_SESSION)) {
    // session isn't started
    session_start();
}

if(empty($_SESSION["msg"])) {
	$_SESSION["msg"] = "";
}

if(empty($_SESSION["attempts"])) {
	$_SESSION["attempts"] = 0;
}


function connect() {
	$server = "localhost";
	$user = "root";
	$password = "";
	$db_name = "liga";

	$conn = mysqli_connect($server,$user,$password,$db_name);

	if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
	}
	return $conn;
}

//validation methods
function presence_of($params,$type_request) {
	foreach ($params as $key => $value) {
		if ($value == "") {
			$_SESSION['msg'] = $_SESSION['msg'] . "#" . $type_request . $key . "#";
		}
	}
}

//crud functions
function find($table="",$fields="",$where="", $limit="") {
	$conn = connect();
	$sql = "select {$fields} from {$table} where {$where} {$limit}";
	$result = $conn->query($sql);
	$conn->close();
	return $result;
}

function create($table,$fields,$values) {
	$conn = connect();
	$sql = "insert into {$table} ({$fields}) values ({$values})";
	$result = $conn->query($sql);
	$conn->close();
	return $result;
}

function update($table,$fields,$where) {
	$conn = connect();
	$sql = "update {$table} set {$fields} where {$where}";
	$result = $conn->query($sql);
	$conn->close();
	return $result;
}

function delete($table,$where) {
	$conn = connect();
	$sql = "delete from {$table} where {$where}";
	$result = $conn->query($sql);
	$conn->close();
	return $result;
}
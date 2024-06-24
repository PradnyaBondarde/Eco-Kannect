<?php
session_start();
require_once 'config.php';
$db = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die("database is not connected");

$data = json_decode(file_get_contents('php://input'), true);
$user_id = $_SESSION['userdata']['id'];
$msg = $data['msg'];

$query = "INSERT INTO messages (from_user_id, to_user_id, msg) VALUES ($user_id, $user_id, '$msg')";
mysqli_query($db, $query);
?>
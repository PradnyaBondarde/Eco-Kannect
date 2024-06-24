<?php
require_once 'config.php';
session_start();

function getGroupMessages() {
    global $db;
    $query = "SELECT users.username, group_messages.message, group_messages.created_at FROM group_messages JOIN users ON users.id = group_messages.user_id ORDER BY group_messages.id DESC LIMIT 50";
    $run = mysqli_query($db, $query);
    return mysqli_fetch_all($run, MYSQLI_ASSOC);
}

echo json_encode(getGroupMessages());

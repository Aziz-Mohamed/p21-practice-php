<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$conn = new mysqli('localhost', 'root', 'Mysqlpass#1', 'post_app');
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$user_id = $_SESSION['user_id'];
$post_id = $_GET['id'] ?? null;

if ($post_id) {
    $sql = "DELETE FROM posts WHERE id='$post_id' AND user_id='$user_id'";
    if ($conn->query($sql) === TRUE) {
        header('Location: home.php');
        exit();
    } else {
        echo "Error deleting post: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>
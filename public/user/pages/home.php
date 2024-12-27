<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$conn = new mysqli('localhost', 'root', '', 'post_app');
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$user_id = $_SESSION['user_id'];
$posts = $conn->query("SELECT * FROM posts WHERE user_id='$user_id'");

$conn->close();
?>
<h1>Welcome to Post App</h1>
<a href="logout.php">Logout</a>
<a href="post_form.php">Add New Post</a>
<ul>
    <?php while ($post = $posts->fetch_assoc()): ?>
        <li>
            <strong><?php echo $post['title']; ?></strong>
            <p><?php echo $post['content']; ?></p>
            <a href="post_form.php?id=<?php echo $post['id']; ?>">Edit</a>
            <a href="delete_post.php?id=<?php echo $post['id']; ?>">Delete</a>
        </li>
    <?php endwhile; ?>
</ul>

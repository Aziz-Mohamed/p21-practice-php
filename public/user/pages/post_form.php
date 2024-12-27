<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$conn = new mysqli('localhost', 'root', '', 'post_app');
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$user_id = $_SESSION['user_id'];
$post_id = $_GET['id'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $conn->real_escape_string($_POST['title']);
    $content = $conn->real_escape_string($_POST['content']);

    if ($post_id) {
        $sql = "UPDATE posts SET title='$title', content='$content' WHERE id='$post_id' AND user_id='$user_id'";
    } else {
        $sql = "INSERT INTO posts (title, content, user_id) VALUES ('$title', '$content', '$user_id')";
    }

    if ($conn->query($sql) === TRUE) {
        header('Location: home.php');
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$post = null;
if ($post_id) {
    $result = $conn->query("SELECT * FROM posts WHERE id='$post_id' AND user_id='$user_id'");
    $post = $result->fetch_assoc();
}
$conn->close();
?>
<form method="POST">
    <label>Title:</label><input type="text" name="title" value="<?php echo $post['title'] ?? ''; ?>" required><br>
    <label>Content:</label><textarea name="content" required><?php echo $post['content'] ?? ''; ?></textarea><br>
    <button type="submit"><?php echo $post_id ? 'Update' : 'Add'; ?> Post</button>
</form>

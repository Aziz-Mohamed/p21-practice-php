<?php require_once('../../../private/initialize.php'); ?>

<?php
if (!isset($_SESSION['user_id'])) {
    header('Location: signin.php');
    exit();
}

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

?>


<?php $page_title = 'Post Form Page'; ?>
<?php include(SHARED_PATH . '/user_header.php'); ?>
<form method="POST" action="<?php echo url_for('/user/pages/post_form.php' . ($post_id ? '?id=' . $post_id : '')); ?>" class="mt-7 max-w-lg mx-auto bg-white p-8 rounded-lg shadow-md">
  <div class="mb-4">
    <label class="block text-gray-700 text-sm font-bold mb-2">Title:</label>
    <input type="text" name="title" value="<?php echo $post['title'] ?? ''; ?>" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
  </div>
  <div class="mb-6">
    <label class="block text-gray-700 text-sm font-bold mb-2">Content:</label>
    <textarea name="content" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline h-48"><?php echo $post['content'] ?? ''; ?></textarea>
  </div>
  <div class="flex items-center justify-between">
    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
      <?php echo $post_id ? 'Update' : 'Add'; ?> Post
    </button>
  </div>
</form>

<?php include(SHARED_PATH . '/user_header.php') ?>

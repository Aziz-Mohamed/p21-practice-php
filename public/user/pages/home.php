<?php require_once('../../../private/initialize.php'); ?>

<?php
$user_id = $_SESSION['user_id'];
$posts = $conn->query("SELECT * FROM posts WHERE user_id='$user_id'");
?>


<?php $page_title = 'Home Page'; ?>
<?php include(SHARED_PATH . '/user_header.php'); ?>


<div class="container mx-auto px-4 py-8">
  <h1 class="text-4xl font-bold mb-4">Welcome to Post App</h1>
  <div class="flex justify-between mb-6">
    <a href="signout.php" class="text-blue-500 hover:text-blue-700">Logout</a>
    <a href="post_form.php" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Add New Post</a>
  </div>
  <ul class="space-y-4">
    <?php while ($post = $posts->fetch_assoc()): ?>
      <li class="border p-4 rounded shadow">
        <h2 class="text-2xl font-semibold"><?php echo $post['title']; ?></h2>
        <p class="mt-2"><?php echo $post['content']; ?></p>
        <div class="flex justify-end space-x-4 mt-4">
          <a href="post_form.php?id=<?php echo $post['id']; ?>" class="text-blue-500 hover:text-blue-700">Edit</a>
          <a href="delete_post.php?id=<?php echo $post['id']; ?>" class="text-red-500 hover:text-red-700">Delete</a>
        </div>
      </li>
    <?php endwhile; ?>
  </ul>
</div>


<?php include(SHARED_PATH . '/user_header.php') ?>
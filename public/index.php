<?php require_once('../private/initialize.php'); ?>

<?php $page_title = 'Post App'; ?>
<?php include(SHARED_PATH . '/user_header.php'); ?>

  <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100">
    <h1 class="text-4xl font-bold mb-8">Join us and post</h1>
    <div class="space-y-4">
      <a href="<?php echo url_for( '/user/pages/signup.php') ?> " class="block w-64 py-3 text-center text-white bg-blue-500 rounded-lg hover:bg-blue-600">Sign Up</a>
      <a href="<?php echo url_for( '/user/pages/signin.php') ?>" class="block w-64 py-3 text-center text-white bg-green-500 rounded-lg hover:bg-green-600">Sign In</a>
    </div>
  </div>


  <?php include(SHARED_PATH . '/user_header.php') ?>
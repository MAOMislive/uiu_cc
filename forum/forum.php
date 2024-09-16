<?php
include('../config.php');
$forum_id = $_GET['id'];

// Fetch forum details
$forum_query = "SELECT * FROM forums WHERE forum_id = $forum_id";
$forum_result = mysqli_query($conn, $forum_query);
$forum = mysqli_fetch_assoc($forum_result);

// Fetch forum posts
$post_query = "SELECT * FROM forum_posts WHERE forum_id = $forum_id ORDER BY created_at DESC";
$post_result = mysqli_query($conn, $post_query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $forum['topic'] ?></title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
  body {
    background-color: #EBEBEB;
    font-family: 'Poppins', sans-serif;
    color: #444444;
  }

  .container {
    margin-top: 50px;
    background-color: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }

  h2 {
    color: #F68920;
    font-weight: 700;
  }

  p,
  small {
    color: #444444;
  }

  .form-control {
    border-radius: 6px;
    border: 1px solid #ccc;
  }

  .btn-primary {
    background-color: #F68920;
    border-color: #F68920;
  }

  .btn-primary:hover {
    background-color: #d87817;
    border-color: #d87817;
  }

  .btn-secondary {
    background-color: #444444;
    border-color: #444444;
  }

  .btn-secondary:hover {
    background-color: #333333;
    border-color: #333333;
  }

  .card {
    border: none;
    border-bottom: 1px solid #F68920;
    border-radius: 6px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
  }

  .card-body {
    padding: 20px;
  }

  .comment-section {
    margin-top: 15px;
    padding-left: 15px;
    border-left: 2px solid #F68920;
  }

  .comment-box {
    background-color: #f9f9f9;
    border-radius: 5px;
    padding: 10px;
    margin-bottom: 10px;
  }
  </style>
</head>

<body>
  <div class="container">
    <h2><?= $forum['topic'] ?></h2>
    <p><?= $forum['description'] ?></p>

    <!-- New Post Form -->
    <form action="add_post.php" method="post">
      <input type="hidden" name="forum_id" value="<?= $forum_id ?>">
      <div class="form-group">
        <textarea class="form-control" name="post_text" placeholder="Write your post..." required></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Post</button>
    </form>

    <hr>

    <!-- Displaying Forum Posts -->
    <?php while ($post = mysqli_fetch_assoc($post_result)): ?>
    <div class="card mb-3">
      <div class="card-body">
        <p><?= $post['post_text'] ?></p>
        <small>Posted on <?= $post['created_at'] ?></small>

        <!-- Comments Section -->
        <div class="comment-section mt-3">
          <h6>Comments</h6>
          <?php
            $post_id = $post['post_id'];
            $comment_query = "SELECT * FROM comments WHERE post_id = $post_id";
            $comment_result = mysqli_query($conn, $comment_query);
            ?>
          <?php while ($comment = mysqli_fetch_assoc($comment_result)): ?>
          <div class="comment-box mb-2">
            <p><?= $comment['comment_text'] ?></p>
            <small>Commented on <?= $comment['created_at'] ?></small>
          </div>
          <?php endwhile; ?>

          <!-- Add Comment Form -->
          <form action="add_comment.php" method="post">
            <input type="hidden" name="post_id" value="<?= $post_id ?>">
            <textarea class="form-control mb-2" name="comment_text" placeholder="Add a comment..." required></textarea>
            <button type="submit" class="btn btn-secondary btn-sm">Comment</button>
          </form>
        </div>
      </div>
    </div>
    <?php endwhile; ?>
  </div>
</body>

</html>
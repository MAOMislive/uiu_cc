<?php
include('../config.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $forum_id = $_POST['forum_id'];
  $post_text = $_POST['post_text'];
  $user_id = 1; // Assuming a logged-in user with ID 1

  $query = "INSERT INTO forum_posts (forum_id, user_id, post_text) VALUES ('$forum_id', '$user_id', '$post_text')";
  if (mysqli_query($conn, $query)) {
    header('Location: forum.php?id=' . $forum_id);
  } else {
    echo "Error: " . mysqli_error($conn);
  }
}
?>
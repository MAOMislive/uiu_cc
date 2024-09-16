<?php
include('../config.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post_id = $_POST['post_id'];
    $comment_text = $_POST['comment_text'];
    $user_id = $_SESSION['user_id']; // Use logged-in user ID

    $query = "INSERT INTO comments (post_id, user_id, comment_text) VALUES ('$post_id', '$user_id', '$comment_text')";
    if (mysqli_query($conn, $query)) {
        // Redirect to the same page without an error in the URL
        $referer = $_SERVER['HTTP_REFERER']; // Use the referrer URL
        header("Location: $referer");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
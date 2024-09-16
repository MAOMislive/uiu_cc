<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UIU Coders Forum</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
  * {
    padding: 0;
    margin: 0;
  }

  body {
    background-color: #EBEBEB;
    font-family: 'Poppins';
    display: flex;
    justify-content: flex-start;
    flex-direction: row;
    width: 100vw;
    height: 100vh;
    overflow-x: hidden;
  }

  .container {
    margin-top: 75px;
    margin-left: 570px;
    margin-bottom: 50px;
  }

  .forum-list {
    margin-top: 20px;
  }

  .list-group-item h4 {
    color: #444444;
  }

  .btn-primary {
    background-color: #F68920;
    border-color: #F68920;
  }

  .btn-primary:hover {
    background-color: #d87817;
    border-color: #d87817;
  }

  h4 {
    color: #d87817;
  }
  </style>
</head>

<body>
  <div>
    <?php
    // Include the config file for database connection and start the session
    include('../config.php');

    //Adding navigation bar
    include 'nav-bar.php';

    // Check if the user is logged in, if not, redirect to the login page
    if (empty($_SESSION['user_id'])) {
      header('Location: ../login.php');
      exit;
    }

    // Retrieve all forums from the database
    $query = "SELECT * FROM forums ORDER BY created_at DESC";
    $result = mysqli_query($conn, $query);

    // Retrieve the logged-in user's details
    $user_id = $_SESSION['user_id'];
    $user_query = "SELECT * FROM users WHERE user_id='$user_id'";
    $user_result = mysqli_query($conn, $user_query);
    $user = mysqli_fetch_assoc($user_result);
    ?>
    <div class="container">

      <h1 class="text-center">Coding Forum by UIUCC</h1>

      <!-- "Create New Forum" button -->
      <div class="text-right">
        <a href="create_forum.php" class="btn btn-primary mb-4">Create New Forum</a>
      </div>

      <!-- Forum list -->
      <div class="list-group forum-list" style="margin-bottom: 50px">
        <?php while ($forum = mysqli_fetch_assoc($result)): ?>
        <a href="forum.php?id=<?= $forum['forum_id'] ?>" style=" border-bottom: 2px solid #F68920;"
          class="list-group-item list-group-item-action">
          <h4 style="color: #d87817;"><?= htmlspecialchars($forum['topic']) ?></h4>
          <p><?= htmlspecialchars(substr($forum['description'], 0, 100)) ?>...</p>
          <small>Posted on <?= date("F j, Y, g:i a", strtotime($forum['created_at'])) ?></small>
        </a>
        <?php endwhile; ?>
      </div>
      <br><br><br><br><br>
    </div>
  </div>

</body>

</html>
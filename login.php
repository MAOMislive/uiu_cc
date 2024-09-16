<?php
include('config.php');

// Handle user login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $student_id = $_POST['student_id'];
  $password = $_POST['password'];

  // Retrieve the user by student_id
  $query = "SELECT * FROM users WHERE student_id='$student_id'";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) == 1) {
    $user = mysqli_fetch_assoc($result);

    echo '<script>alert("' . $user['user_id'] . '");</script>';
    // Check if password matches (remove password hashing for simplicity)
    if ($password == $user['password']) { // assuming 'password_hash' is plain text
      // Set session variables
      $_SESSION['user_id'] = $user['user_id'];
      $_SESSION['name'] = $user['name'];

      // Redirect the user to the forum page
      header('Location: forum/index.php');
      exit();
    } else {
      $error_message = "Invalid password. Please try again.";
    }
  } else {
    $error_message = "No account found with that Student ID.";
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
  body {
    background-color: #EBEBEB;
    font-family: "Poppins";
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    width: 100vw;
    height: 100vh;
  }

  .container {
    width: 750px;
    background-color: #fff;
    padding: 2rem;
    margin-top: 50px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }

  h3 {
    color: #F68920;
    font-weight: bold
  }

  label {
    color: #444444;
  }

  .btn-primary {
    background-color: #F68920;
    font-weight: 500;
  }

  .btn-primary:hover {
    background-color: #d87817;
    border-color: #d87817;
  }

  .alert {
    color: #fff;
    background-color: #f44336;
    border-color: #f44336;
  }
  </style>
</head>

<body>
  <div style="left:10%">

  </div>
  <div class="container">
    <h3>Login Now</h3><br>

    <!-- Display error message if there is one -->
    <?php if (!empty($error_message)): ?>
    <div class="alert alert-danger" role="alert">
      <?= $error_message ?>
    </div>
    <?php endif; ?>

    <form action="login.php" method="post">
      <div class="form-group">
        <label for="student_id">Student ID:</label>
        <input type="student_id" class="form-control" id="student_id" name="student_id" required>
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>
      <div style="display: flex; flex-direction: row; gap: 20px; align-items: center">
        <button type="submit" class="btn btn-primary">Let me in</button>
        <div style="display: inline;">Didn't have any account? <a href="signup.php"
            style="color: #d87817; font-weight: 600; outline: none; text-decoration: none">Sign Up</a></div>
      </div>
    </form>
  </div>
</body>

</html>
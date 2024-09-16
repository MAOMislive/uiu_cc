<?php
include('config.php');

// Handle user registration
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $student_id = $_POST['student_id'];
  $name = $_POST['name'];
  $email = $_POST['email'];
  $dept = $_POST['dept'];
  $password = $_POST['password'];

  // Hash the password for security
  // $password_hash = password_hash($password, PASSWORD_DEFAULT);

  // Check if student_id or email already exists
  $query = "SELECT * FROM users WHERE student_id='$student_id' OR email='$email'";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    $existing_user = mysqli_fetch_assoc($result);
    if ($existing_user['student_id'] == $student_id) {
      $error_message = "The Student ID '$student_id' is already registered.";
    } elseif ($existing_user['email'] == $email) {
      $error_message = "The email '$email' is already registered.";
    }
  } else {
    $insert_query = "INSERT INTO users (student_id, name, email, dept, password)
                         VALUES ('$student_id', '$name', '$email', '$dept', '$password')";
    if (mysqli_query($conn, $insert_query)) {
      header('Location: login.php');
      exit();
    } else {
      $error_message = "An unexpected error occurred. Please try again.";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
  * {
    margin: 0;
    padding: 0;
  }

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
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: row;
    padding: 50px;
    justify-content: space-between;
    align-items: center;
  }

  h3 {
    color: #444444;
  }

  label {
    color: #444444;
  }

  input {
    background-color: #F3F3F3;
    background: #F3F3F3;
  }

  .btn-primary {
    font-weight: 500;
    background-color: #F68920;
    border-color: #F68920;
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
  <div class="container">
    <img style="width: 570px; height:300px; object-fit:cover; margin-right: 10px;" src="styles/signup_screen.png"
      alt="">
    <div>
      <div>
        <!-- <img src="styles/uiu_cc_logo.png" alt="" width="250"> -->
        <h3 style="font-weight: bold; color: #F68920">Welcome to UIU Coding Family!</h3>
      </div>
      <h5 style="font-weight: 400">Join us today and start coding your future!</h5>
      <br><br>
      <!-- Display error message if there is one -->
      <?php if (!empty($error_message)): ?>
      <div class="alert alert-danger" role="alert">
        <?= $error_message ?>
      </div>
      <?php endif; ?>

      <form action="signup.php" method="post">
        <div class="form-group">
          <label for="student_id">Student ID:</label>
          <input type="text" class="form-control" id="student_id" name="student_id" required>
        </div>
        <div class="form-group">
          <label for="name">Name:</label>
          <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
          <label for="email">Email:</label>
          <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
          <label for="dept">Department:</label>
          <select class="form-control" id="dept" name="dept" required>
            <option value="">Select Department</option>
            <option value="CSE">Computer Science and Engineering</option>
            <option value="EEE">Electrical and Electronic Engineering</option>
            <option value="BBA">Business Administration</option>
            <option value="CE">Civil Engineering</option>
            <option value="ECO">Economics</option>
          </select>
        </div>
        <div class="form-group">
          <label for="password">Password:</label>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div style="display: flex; flex-direction: row; justify-content: space-between; align-items: center">
          <button type="submit" class="btn btn-primary" style="display: inline">Join Now</button>
          <div style="display: inline;">Already have an account? <a href="login.php"
              style="color: #d87817; font-weight: 600; outline: none; text-decoration: none">Login</a></div>
        </div>
      </form>
    </div>
  </div>
</body>

</html>
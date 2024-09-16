<?php
include('../config.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $topic = $_POST['topic'];
  $description = $_POST['description'];
  $user_id = 1; // Assuming a logged-in user with ID 1

  $query = "INSERT INTO forums (user_id, topic, description) VALUES ('$user_id', '$topic', '$description')";
  if (mysqli_query($conn, $query)) {
    header('Location: index.php');
  } else {
    echo "Error: " . mysqli_error($conn);
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Forum</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
  *,
  p {
    padding: 0;
    margin: 0;
  }

  body {
    background-color: #f4f7f6;
    font-family: 'Poppins', sans-serif;
    background-color: #EBEBEB;
  }

  .container {
    max-width: 600px;
    margin: 50px auto;
    background-color: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }

  h2 {
    font-weight: 700;
    color: #333;
    margin-bottom: 20px;
  }

  label {
    font-weight: 500;
    color: #555;
  }

  .form-control {
    border-radius: 6px;
    border: 1px solid #ccc;
    padding: 10px;
  }

  .btn-primary {
    background-color: #F68920;
    border-color: #007bff;
    padding: 10px 20px;
    border-radius: 6px;
    font-weight: 500;
    border: none;
  }

  .btn-primary:hover {
    background-color: #d87817;
    border-color: #d87817;
  }

  .custom-bg {
    background-color: #e9ecef;
    padding: 20px;
    border-radius: 10px;
  }

  .custom-text {
    color: #333;
  }
  </style>
</head>

<body>

  <div class="container">
    <h2>Create a New Forum</h2>

    <div class="custom-bg">
      <p class="custom-text">Use this form to create a new discussion forum.</p>
    </div>

    <form action="" method="post" class="mt-4">
      <div class="form-group">
        <label for="topic">Topic</label>
        <input type="text" class="form-control" id="topic" name="topic" placeholder="Enter the forum topic" required>
      </div>
      <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" name="description" rows="4" placeholder="Describe your forum"
          required></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Create Forum</button>
    </form>
  </div>

</body>

</html>
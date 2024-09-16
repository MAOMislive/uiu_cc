<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Settings</title>
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
    background-color: #fff;
    padding: 2rem;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);

  }

  h2 {
    color: #444444;
  }

  label {
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

  /* FAQ styles */
  .faq-section {
    margin-top: 50px;
  }

  .faq-section h3 {
    color: #F68920;
    margin-bottom: 20px;
  }

  .faq-item {
    background-color: #f9f9f9;
    padding: 15px;
    margin-bottom: 15px;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }

  .faq-item h5 {
    color: #444444;
    font-weight: bold;
  }

  .faq-item p {
    color: #666;
  }
  </style>
</head>

<body>
  <?php
  // session_start(); // Start the session
  include_once('config.php'); // Include database connection
  
  include_once("nav-bar.php");

  // Check if the user is logged in
  if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to login if not logged in
    exit();
  }

  // Get the logged-in user's ID
  $user_id = $_SESSION['user_id'];

  // Fetch user information from the database
  $query = "SELECT * FROM users WHERE user_id = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("i", $user_id);
  $stmt->execute();
  $result = $stmt->get_result();
  $user = $result->fetch_assoc(); // Fetch user details
  
  // Handle form submission to update user information
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $student_id = $_POST['student_id'];
    $email = $_POST['email'];

    // Handle profile picture upload
    if ($_FILES['dp_url']['name']) {
      $target_dir = "uploads/";
      $target_file = $target_dir . basename($_FILES["dp_url"]["name"]);
      move_uploaded_file($_FILES["dp_url"]["tmp_name"], $target_file);
      $dp_url = $target_file;
    } else {
      $dp_url = $user['dp_url']; // Keep old picture if no new one is uploaded
    }

    // Update user information in the database
    $update_query = "UPDATE users SET name = ?, student_id = ?, email = ?, dp_url = ? WHERE user_id = ?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param("ssssi", $name, $student_id, $email, $dp_url, $user_id);

    if ($update_stmt->execute()) {
      // Update session data if the name is changed
      $_SESSION['name'] = $name;
      echo '<script>alert("Profile updated successfully!");
    window.location.href =\'settings.php\'</script>';
    } else {
      $error_message = "Error updating profile. Please try again.";
    }
  }
  ?>
  <div class="container">
    <h2>Update Your Information</h2>

    <?php if (!empty($error_message)): ?>
    <div class="alert alert-danger" role="alert">
      <?= $error_message ?>
    </div>
    <?php endif; ?>

    <form action="settings.php" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="name">Full Name</label>
        <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($user['name']) ?>"
          required>
      </div>

      <div class="form-group">
        <label for="student_id">Student ID</label>
        <input type="text" class="form-control" id="student_id" name="student_id"
          value="<?= htmlspecialchars($user['student_id']) ?>" required>
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>"
          required>
      </div>

      <div class="form-group">
        <label for="dp_url">Profile Picture</label><br>
        <img src="<?= htmlspecialchars($user['dp_url']) ?>" alt="Profile Picture"
          style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover;"><br><br>
        <input type="file" class="form-control-file" id="dp_url" name="dp_url">
      </div>

      <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>

    <!-- FAQs Section -->
    <div class="faq-section">
      <h3>Frequently Asked Questions (FAQs)</h3>
      <div class="accordion" id="faqAccordion">

        <?php
        // Fetch FAQs from the database
        $faq_query = "SELECT * FROM faqs";
        $faq_result = $conn->query($faq_query);

        if ($faq_result->num_rows > 0): ?>
        <?php while ($faq = $faq_result->fetch_assoc()): ?>
        <div class="card faq-item collapsed" type="button" data-toggle="collapse"
          data-target="#collapse<?= $faq['faq_id'] ?>" aria-expanded="false"
          aria-controls="collapse<?= $faq['faq_id'] ?>">
          <div class="card-header" id="heading<?= $faq['faq_id'] ?>" style="border-bottom:none">
            <h5 class="mb-0">
              <div class="btn btn-link" style="text-align: left; color: black">
                <?= htmlspecialchars($faq['question_text']) ?>
              </div>
            </h5>
          </div>
          <div id="collapse<?= $faq['faq_id'] ?>" class="collapse" aria-labelledby="heading<?= $faq['faq_id'] ?>"
            data-parent="#faqAccordion">
            <div class="card-body" style="text-align: left">
              <?= htmlspecialchars($faq['answer_text']) ?>
            </div>
          </div>
        </div>
        <?php endwhile; ?>
        <?php else: ?>
        <p>No FAQs available at the moment.</p>
        <?php endif; ?>

      </div>
    </div>
  </div>

  <!-- Bootstrap JS and dependencies (jQuery and Popper.js) -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
<?php
// include('config.php'); // Include database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
  header('Location: ../login.php'); // Redirect to login if not logged in
  exit();
}

// Get the logged-in user's ID
$user_id = $_SESSION['user_id'];

// Fetch user information from the database
$query = "SELECT name, student_id, dp_url FROM users WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id); // Bind the user_id to the query
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc(); // Fetch user details

// Check if user data exists
if (!$user) {
  echo "User not found.";
  exit();
}

// Close the statement and connection
// $stmt->close();
// $conn->close();
?>

<style>
* {
  padding: 0;
  margin: 0;
}

body {
  font-family: Poppins;
  width: 100vw;
  height: 100vh;
}

.NavContents {
  width: 250;
  flex-direction: column;
  justify-content: flex-start;
  align-items: flex-start;
  gap: 50px;
  display: inline-flex;
  background-color: #EBEBEB;
  /* width: 200px; */
  height: 100vh;
  padding: 50px;
  border-right: 3px solid #F68920;
  position: fixed;
}

.uiu_c_logo {
  width: 200px;
}

.ProfileInforNavBar {
  flex-direction: column;
  justify-content: flex-start;
  align-items: flex-start;
  gap: 50px;
  display: flex;
}

.ProfileInfo {
  flex-direction: column;
  justify-content: flex-start;
  align-items: flex-start;
  gap: 15px;
  display: flex;
}

.Dp {
  width: 75px;
  height: 75px;
  border-radius: 50%;
}

.UserName {
  color: black;
  font-size: 16px;
  font-weight: 600;
  word-wrap: break-word;
}

.StudentId {
  color: black;
  font-size: 16px;
  font-family: Poppins, sans-serif;
  font-weight: 400;
  line-height: 16.82px;
  word-wrap: break-word;
  opacity: 0.75;
}

.NavBar {
  flex-direction: column;
  justify-content: flex-start;
  align-items: flex-start;
  gap: 20px;
  display: flex;
}

.Nav {
  justify-content: flex-start;
  align-items: center;
  gap: 10px;
  display: inline-flex;
  cursor: pointer;
}

.NavLogo {
  width: 17px;
  height: 17px;
}

.NavTitle {
  font-size: 16px;
  font-weight: 500;
}

.opacity_50 {
  opacity: 0.5;
}

.opacity_50:hover {
  opacity: 0.75;
}
</style>
<?php $first_name = explode(" ", $user['name'])[0]; // Split the name by space and get the first part
?>
<div class="NavContents">
  <img class="uiu_c_logo" src="../styles/uiu_cc_logo.png">
  <div class="ProfileInforNavBar">
    <div class="ProfileInfo">
      <img class="Dp" src="../<?= htmlspecialchars($user['dp_url']) ?>" alt="Profile Picture">
      <div class="UserName"><?= $first_name ?></div>
      <div class="StudentId">ID: <?= htmlspecialchars($user['student_id']) ?></div>
    </div>
    <div class="NavBar">
      <div class="Nav opacity_50">
        <img class="NavLogo" src="../styles/nav-styles/home.png">
        <div class="NavTitle">Home</div>
      </div>
      <!-- <div class="Nav">
        <img class="NavLogo" src="../styles/nav-styles/posts.png" style="opacity:0.25">
        <div class="NavTitle">Posts</div>
      </div> -->
      <div class="Nav ">
        <img class="NavLogo" src="../styles/nav-styles/posts.png" style="">
        <div class="NavTitle">Forum</div>
      </div>
      <div class="Nav opacity_50">
        <img class="NavLogo" src="../styles/nav-styles/competitions.png">
        <div class="NavTitle">Competitions</div>
      </div>
      <div class="Nav opacity_50" id="settings">
        <img class="NavLogo" src="../styles/nav-styles/settings.png">
        <div class="NavTitle">Settings</div>
      </div>
      <div class="Nav opacity_50" id="logout">
        <img class="NavLogo" src="../styles/nav-styles/logout.png">
        <div class="NavTitle">Log Out</div>
      </div>
    </div>
  </div>
</div>
<script>
// Add click event listener to the div
document.getElementById('logout').addEventListener('click', function() {
  window.location.href = '../login.php';
});

document.getElementById('settings').addEventListener('click', function() {
  window.location.href = '../settings.php';
});
</script>
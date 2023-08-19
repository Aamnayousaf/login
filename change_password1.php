<?php
session_start();

// Include database connection
@include 'database.php';

if(isset($_POST['submit'])) {
    $currentPass = md5($_POST['current_password']);
    $newPass = md5($_POST['new_password']);
    $confirmNewPass = md5($_POST['confirm_new_password']);
    $userId = $_SESSION['user_name']; 

    // Check if the current password matches the stored password
    $selectQuery = "SELECT * FROM user WHERE email = '$userId' AND password_hash = '$currentPass'";
    $result = mysqli_query($conn, $selectQuery);

    if(mysqli_num_rows($result) > 0) {
        if($newPass != $confirmNewPass) {
            $error = 'New passwords do not match!';
        } else {
            // Update the password
            $updateQuery = "UPDATE user SET password_hash = '$newPass' WHERE email = '$userId'";
            mysqli_query($conn, $updateQuery);
            $success = 'Password changed successfully!';
        }
    } else {
        $error = 'Incorrect current password!';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Change Password</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
</head>
<body>
   
<div class="form-container">
   <form action="" method="post">
      <h3>Change Password</h3>
      <?php
      if(isset($error)) {
         echo '<span class="error-msg" >'.$error.'</span>';
      } elseif(isset($success)) {
         echo '<span class="success-msg" style="color: red">'.$success.'</span>';
      }
      ?>
      <input type="password" name="current_password" required placeholder="Current Password">
      <input type="password" name="new_password" required placeholder="New Password">
      <input type="password" name="confirm_new_password" required placeholder="Confirm New Password">
      <input type="submit" name="submit" value="Change Password" class="form-btn">
      <p><a href="home.php">Back to Home</a></p>
   </form>
</div>

</body>
</html>

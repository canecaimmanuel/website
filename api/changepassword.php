<?php

include "config.php";

// Allow requests from any origin
header("Access-Control-Allow-Origin: *");
// Allow specific HTTP methods
header("Access-Control-Allow-Methods: POST");
// Allow specific headers
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
  // Handle preflight requests
  exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $data = json_decode(file_get_contents('php://input'), true);

  $password = $data['password'];
  $newPassword = $data['newPassword'];

  // Perform password validation and change password logic here
  // You can compare the entered password with the existing user password from the database

  // Example validation: Check if the entered password matches the user's current password
  $userId = 1; // Assuming the user ID is 1
  $sql = "SELECT password FROM users WHERE id = $userId";
  $result = $conn->query($sql);

  if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    $storedPassword = $row['password'];

    // Verify the entered password against the stored password
    if (password_verify($password, $storedPassword)) {
      // Password matches, update the user info
      $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);

      $updateSql = "UPDATE users SET password = '$newPasswordHash' WHERE id = $userId";

      if ($conn->query($updateSql)) {
        $response = array(
          'success' => true,
          'message' => 'Change password successful.'
        );
        echo json_encode($response);
      } else {
        $response = array(
          'success' => false,
          'message' => 'Failed to update password.'
        );
        echo json_encode($response);
      }
    } else {
      $response = array(
        'success' => false,
        'message' => 'Invalid current password.'
      );
      echo json_encode($response);
    }
  } else {
    $response = array(
      'success' => false,
      'message' => 'User not found.'
    );
    echo json_encode($response);
  }
} else {
  echo "Invalid request! Only POST requests are allowed.";
}
?>

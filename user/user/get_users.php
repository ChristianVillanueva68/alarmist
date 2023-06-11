<?php
// Fetch recipient names from the database based on the input letter
$input = $_POST['input']; // The input letter typed by the user

// Query the database to get recipient names starting with the input letter
$usersQuery = $conn->query("SELECT firstname FROM member_list WHERE firstname LIKE '$input%'");

if ($usersQuery->num_rows > 0) {
  // Display the recipient name suggestions
  while ($user = $usersQuery->fetch_assoc()) {
    echo '<div class="recipient-suggestion">' . $user['firstname'] . '</div>';
  }
} else {
  // No recipient names available
  echo '<div class="no-suggestion">No suggestions available.</div>';
}
?>

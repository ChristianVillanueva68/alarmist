<?php
// Fetch messages for the logged-in user from the database
$userId = $_settings->userdata('id');
$messagesQuery = $conn->query("SELECT * FROM messages_list WHERE user_id = '$userId'");

?>
<div class="messages-container">
  <div class="column">
    <h2>Inbox</h2>

    <div class="message-list">
      <?php
      // Fetch messages for the logged-in user from the database
      $userId = $_settings->userdata('id');
      $messagesQuery = $conn->query("SELECT * FROM messages_list WHERE user_id = '$userId'");

      // Check if any messages are available
      if ($messagesQuery->num_rows > 0) {
          // Display the fetched messages
          while ($message = $messagesQuery->fetch_assoc()) {
              // Display the message details (e.g., sender, subject, date, etc.)
              echo '<div class="message-item">';
              echo '<div class="message-sender">' . $message['sender'] . '</div>';
              echo '<div class="message-content">';
              echo '<div class="message-subject">' . $message['subject'] . '</div>';
              echo '<div class="message-date">' . $message['date'] . '</div>';
              echo '</div>';
              echo '</div>';
          }
      } else {
          echo '<div class="no-message">No messages available.</div>';
      }
      ?>
    </div>
  </div>

  <div class="column">
    <h2>Compose Message</h2>

    <form action="send_message.php" method="POST" class="compose-form">
      <input type="text" name="recipient" placeholder="Recipient" class="compose-recipient" id="recipient-input">
      <div id="recipient-suggestions"></div>

      <input type="text" name="subject" placeholder="Subject" class="compose-subject">
      <textarea name="message" placeholder="Message" class="compose-message"></textarea>
      <button type="submit" class="compose-button">Send Message</button>
    </form>
  </div>
</div>

<!-- Place this code inside the <style> tags or a linked CSS file -->
<style>
  body {
    background-color: #f0f2f5;
  }
  /* Add these styles to the existing CSS */

/* Inbox Styles */
.column {
  display: flex;
  flex-direction: column;
}

.message-list {
  max-height: 300px;
  overflow-y: auto;
}

/* Message Item Styles */
.message-item {
  padding: 10px;
  margin-bottom: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
  background-color: #fff;
}

.message-sender {
  font-weight: bold;
  margin-bottom: 5px;
}

.message-subject {
  font-weight: bold;
  margin-bottom: 5px;
}

.message-date {
  font-size: 12px;
  color: #888;
}

.no-message {
  margin-top: 10px;
  font-style: italic;
  color: #888;
}

/* Compose Message Styles */
.compose-form {
  display: flex;
  flex-direction: column;
}

.compose-recipient,
.compose-subject,
.compose-message {
  padding: 10px;
  margin-bottom: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

.compose-button {
  padding: 10px 20px;
  background-color: #4267B2;
  color: #fff;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

/* Hover effect for recipient suggestions */
.recipient-suggestion:hover {
  background-color: #f0f0f0;
}
/* Add these styles to the existing CSS */

/* Inbox Styles */
.column {
  display: flex;
  flex-direction: column;
}

.message-list {
  max-height: 300px;
  overflow-y: auto;
}

/* Message Item Styles */
.message-item {
  padding: 10px;
  margin-bottom: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
  background-color: #fff;
}

.message-sender {
  font-weight: bold;
  margin-bottom: 5px;
}

.message-subject {
  font-weight: bold;
  margin-bottom: 5px;
}

.message-date {
  font-size: 12px;
  color: #888;
}

.no-message {
  margin-top: 10px;
  font-style: italic;
  color: #888;
}

/* Compose Message Styles */
.compose-form {
  display: flex;
  flex-direction: column;
}

.compose-recipient,
.compose-subject,
.compose-message {
  padding: 10px;
  margin-bottom: 10px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

.compose-button {
  padding: 10px 20px;
  background-color: #4267B2;
  color: #fff;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

/* Hover effect for recipient suggestions */
.recipient-suggestion:hover {
  background-color: #f0f0f0;
}

</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
  $('#recipient-input').keyup(function() {
    var input = $(this).val();
    if (input.length >= 1) {
      $.ajax({
        url: 'get_users.php',
        type: 'POST',
        data: { input: input },
        success: function(response) {
          $('#recipient-suggestions').html(response);
        }
      });
    } else {
      $('#recipient-suggestions').empty();
    }
  });
});
</script>

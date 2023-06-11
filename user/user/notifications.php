<?php
// Assuming the user ID is stored in a session variable named 'userId'
if (isset($_SESSION['userId'])) {
    $userId = $_SESSION['userId'];

    // Query to fetch notifications for likes on user's posts
    $likesQuery = $conn->query("SELECT * FROM like_list WHERE post_author_id = '$userId' AND sender != '$userId' ORDER BY created_at DESC");

    // Query to fetch notifications for comments on user's posts
    $commentsQuery = $conn->query("SELECT * FROM comment_list WHERE post_author_id = '$userId' ORDER BY created_at DESC");

    // Store the notifications in an array
    $notifications = [];

    // Add likes notifications to the array
    if ($likesQuery->num_rows > 0) {
        while ($likeNotification = $likesQuery->fetch_assoc()) {
            $notifications[] = [
                'sender' => $likeNotification['sender'],
                'content' => 'Liked your post',
                'date' => $likeNotification['created_at']
            ];
        }
    }

    // Add comments notifications to the array
    if ($commentsQuery->num_rows > 0) {
        while ($commentNotification = $commentsQuery->fetch_assoc()) {
            $notifications[] = [
                'sender' => $commentNotification['sender'],
                'content' => 'Commented on your post',
                'date' => $commentNotification['created_at']
            ];
        }
    }

    // If no notifications found
    if (empty($notifications)) {
        echo '<div class="no-notification">No notifications available.</div>';
    } else {
        // Display notifications
        echo '<div class="notification-container">';
        echo '<ul class="notification-list">';
        foreach ($notifications as $notification) {
            echo '<li class="notification-item">';
            echo '<div class="notification-sender">' . $notification['sender'] . '</div>';
            echo '<div class="notification-content">' . $notification['content'] . '</div>';
            echo '<div class="notification-date">' . $notification['date'] . '</div>';
            echo '</li>';
        }
        echo '</ul>';
        echo '</div>';
    }
} else {
    echo '<div class="no-notification">User ID not found.</div>';
}
?>

<style>
/* Notification Styles */
.notification-container {
    margin-top: 10px;
}

.notification-list {
    list-style-type: none;
    padding: 0;
    margin: 0;
    max-height: 300px;
    overflow-y: auto;
}

.notification-item {
    display: flex;
    align-items: center;
    border-bottom: 1px solid #ddd;
    padding: 10px;
}

.notification-item:last-child {
    border-bottom: none;
}

.notification-sender {
    font-weight: bold;
    margin-right: 10px;
}

.notification-content {
    flex-grow: 1;
}

.notification-date {
    font-size: 12px;
    color: #888;
}

.no-notification {
    margin-top: 10px;
    font-style: italic;
    color: #888;
}
</style>

<div class="messages-container">
    <div class="column">
        <h2>Inbox</h2>
        <!-- Display messages here -->
    </div>

    <div class="column">
        <h2>Notifications</h2>
        <div class="notification-wrapper">

        </div>
    </div>

    <div class="column">
        <!-- Compose message form here -->
    </div>
</div>

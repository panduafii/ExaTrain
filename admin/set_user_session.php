<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'])) {
    $_SESSION['user_id'] = $_POST['user_id'];
    echo "Session user ID set to: " . $_POST['user_id'];
} else {
    echo "Invalid request";
}
?>

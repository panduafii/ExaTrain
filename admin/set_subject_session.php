<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['subject_id'])) {
    $_SESSION['subject_id'] = $_POST['subject_id'];
    echo "Session subject ID set to: " . $_POST['subject_id'];
} else {
    echo "Invalid request";
}
?>

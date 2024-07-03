<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selected_course_id'])) {
    $_SESSION['subject_id'] = $_POST['selected_course_id'];
    header('Location: adminSoalchart.php');
    exit();
} else {
    echo "Invalid request";
}
?>

<?php
header('Content-Type: application/json');

// Mengambil data JSON yang dikirim oleh JavaScript
$data = json_decode(file_get_contents('php://input'), true);

$answer_id = $data['answer_id'];
$is_correct = $data['is_correct'] ? 1 : 0;
$evaluasi_ai = $data['evaluasi_ai'];  // Menerima data evaluasi AI dari frontend

// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "ExaTrain";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}

// Update kolom is_correct dan evaluasi_ai di tabel answers
$sql = "UPDATE answers SET is_correct = ?, evaluasi_ai = ? WHERE id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param('isi', $is_correct, $evaluasi_ai, $answer_id);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => $stmt->error]);
}

$stmt->close();
$conn->close();
?>

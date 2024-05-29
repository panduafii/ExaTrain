<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
</head>
<body>
    <h1>Quiz</h1>

    <a href="addUser.html">Tambah Pengguna Baru</a>
    <form action="submit.php" method="post">
        <?php
        // Koneksi ke database
        $servername = "localhost";
        $username = "root"; // Ganti dengan username Anda
        $password = "root"; // Ganti dengan password Anda
        $dbname = "ExaTrain";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Koneksi ke database gagal: " . $conn->connect_error);
        }

        // Ambil pertanyaan dari database
        $sql = "SELECT * FROM questions";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Menampilkan pertanyaan
            while ($row = $result->fetch_assoc()) {
                echo "<h2>" . $row['question_text'] . "</h2>";

                // Menampilkan textarea untuk jawaban essay
                echo "<textarea name='essay_answer[]' required></textarea>";
            }

            // Tombol untuk mengirim jawaban
            echo "<button type='submit' name='submit'>Submit Jawaban</button>";
        } else {
            echo "Tidak ada pertanyaan yang ditemukan.";
        }

        $conn->close();
        ?>
    </form>
</body>
</html>

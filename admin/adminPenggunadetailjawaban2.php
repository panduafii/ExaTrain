<?php
session_start();

// Cek apakah session user_id ada
if (!isset($_SESSION['user_id'])) {
    // Jika tidak ada, redirect ke halaman login atau halaman lain yang diinginkan
    header('Location: adminPengguna.php');
    exit;
}

// Cek apakah session subject_id ada
if (!isset($_SESSION['subject_id'])) {
    // Jika tidak ada, redirect ke halaman yang sesuai atau berikan pesan kesalahan
    header('Location: adminPenggunadetailjawaban.php');
    exit;
}

$subject_id = $_SESSION['subject_id'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EXATrain Dashboard - Detail Jawaban Pengguna</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="../CSS/adminPenggunadetailjawaban2.css">
</head>
<body>
    <div class="container">
        <nav class="sidebar">
            <div class="logo">
                <img src="../img/logo1.png" alt="EXATrain Logo">
                <div class="logo-line"></div>
            </div>
            <ul class="sidebar-menu">
                <li class="sidebar-item">
                    <img src="../img/penggunaicon.png" alt="Icon">
                    <span>Edit Pengguna</span>
                </li>
                <li class="sidebar-item">
                    <img src="../img/manajemenicon.png" alt="Icon">
                    <span>Manajemen Soal</span>
                </li>
                <li class="sidebar-item">
                    <img src="../img/statistikicon.png" alt="Icon">
                    <span>Data & Statistik</span>
                </li>
                <li class="sidebar-item">
                    <img src="../img/wallet-2.png" alt="Icon">
                    <span>Pembayaran</span>
                </li>
            </ul>
            <ul class="logout">
                <li class="sidebar-item">
                    <img src="../img/logouticon.png" alt="Icon">
                    <span>Logout</span>
                </li>
            </ul>
        </nav>
        <div class="main-content">
            <header class="header">
                <ul class="header-menu">
                    <li class="menu-icon">
                        <img src="../img/garistiga.png" alt="Menu">
                    </li>
                    <li class="header-right">
                        <div class="notification-icon">
                            <img src="../img/Notifikasi.png" alt="Notification">
                        </div>
                        <div class="user-icon">
                            <img src="../img/adminicon.png" alt="User">
                        </div>
                        <span>Admin</span>
                    </li>
                </ul>
            </header>
            <div class="sub-header">
                <span>Manajemen Soal</span>
            </div>
            <div class="title">
                <h3>Detail Jawaban Pengguna</h3>
            </div>
            <div class="content">
                <div class="question-container">
                    <?php
                    // Koneksi ke database
                    $servername = "localhost";
                    $username = "root";
                    $password = "root";
                    $dbname = "ExaTrain";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("Koneksi ke database gagal: " . $conn->connect_error);
                    }

                    // Query untuk mendapatkan jawaban dan kunci jawaban dari tabel answers dan questions berdasarkan user_id dan subject_id
                    $sql = "SELECT q.id as question_id, q.question_text, q.correct_answer, a.answer, a.id as answer_id
                    FROM answers a
                    INNER JOIN questions q ON a.question_id = q.id
                    WHERE a.user_id = " . $_SESSION['user_id'] . " AND q.subject_id = " . $subject_id;
                    
                    $result = $conn->query($sql);

                    $questions_data = array();

                    if ($result->num_rows > 0) {
                        // Output data dari setiap baris
                        while($row = $result->fetch_assoc()) {
                            $questions_data[] = $row;  // Simpan data untuk digunakan dalam JavaScript

                            echo "<div class='question-card' id='question-".$row['answer_id']."'>";
                            echo "<h4>Soal</h4>";
                            echo "<div class='question-box'>" . $row['question_text'] . "</div>";
                            echo "</div>";
                            echo "<div class='answer-card'>";
                            echo "<h4>Kunci Jawaban</h4>";
                            echo "<div class='answer-box'>" . $row['correct_answer'] . "</div>";
                            echo "</div>";
                            echo "<div class='user-answer-card'>";
                            echo "<h4>Jawaban Pengguna</h4>";
                            echo "<div class='user-answer-box'>" . $row['answer'] . "</div>";
                            echo "</div>";
                            echo "<div class='evaluation-result'>";
                            echo "<h4>Evaluasi</h4>";
                            echo "<div class='evaluation-box' id='evaluation-box-" . $row['answer_id'] . "'></div>";
                            echo "</div>";
                            echo "<div class='simple-evaluation-result'>";
                            echo "<h4>Status boolean</h4>";
                            echo "<div class='simple-evaluation-box' id='simple-evaluation-box-" . $row['answer_id'] . "'></div>";
                            echo "</div>";
                            echo "<div class='raw-evaluation-result'>";
                            echo "<h4>Raw Status boolean</h4>";
                            echo "<div class='raw-evaluation-box' id='raw-evaluation-box-" . $row['answer_id'] . "'></div>";
                            echo "</div>";
                            echo "<hr>";
                        }
                    } else {
                        echo "Tidak ada data yang ditemukan.";
                    }

                    $conn->close();
                    ?>
                </div>
                <div class="pagination">
                    <button class="save-button" onclick="saveEvaluations()">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Mengambil data dari PHP
        const questionsData = <?php echo json_encode($questions_data); ?>;
        console.log('Questions Data:', questionsData); // Debug log

        // Fungsi async untuk meminta AI Groq untuk memberikan jawaban
        async function getGroqChatCompletion(questionText, correctAnswer, userAnswer) {
            const apiKey = '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'; // Ganti dengan API key yang benar
            const endpoint = 'https://api.groq.com/openai/v1/chat/completions'; // Ganti dengan endpoint yang benar jika berbeda

            const requestBody = {
                model: "llama3-70b-8192", // Model yang digunakan
                temperature: 0.8,
                max_tokens: 1024,
                top_p: 1,
                messages: [
                    {
                        "role": "system",
                        "content": "Kamu adalah seorang pemeriksa Essay. Kamu akan diberikan Soal, Kunci Jawaban, dan Jawaban pengguna. Berdasarkan soal dan kunci jawaban, kamu harus menilai jawaban pengguna itu dengan template 'Hasil : benar/salah' lalu berikan penjelasannya dan jawab menggunakan bahasa indonesia"
                    },
                    {
                        "role": "user",
                        "content": `Soal: ${questionText}\nKunci Jawaban: ${correctAnswer}\nJawaban pengguna: ${userAnswer}`
                    }
                ]
            };

            try {
                const response = await fetch(endpoint, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${apiKey}`
                    },
                    body: JSON.stringify(requestBody)
                });

                if (!response.ok) {
                    throw new Error(`Server error: ${response.statusText}`);
                }

                const data = await response.json();
                console.log('Groq Response:', data); // Debug log
                return data;
            } catch (error) {
                console.error('Error in getGroqChatCompletion:', error);
                throw error;
            }
        }

        // Fungsi async untuk meminta evaluasi sederhana (1/0)
        async function getSimpleEvaluation(questionText, correctAnswer, userAnswer) {
            const apiKey = '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'; // Ganti dengan API key yang benar
            const endpoint = 'https://api.groq.com/openai/v1/chat/completions'; // Ganti dengan endpoint yang benar jika berbeda

            const requestBody = {
                model: "llama3-70b-8192", // Model yang digunakan
                temperature: 0.8,
                max_tokens: 1024,
                top_p: 1,
                messages: [
                    {
                        "role": "system",
                        "content": "Kamu adalah seorang pemeriksa Essay. Kamu akan diberikan Soal, Kunci Jawaban, dan Jawaban pengguna. Berdasarkan soal dan kunci jawaban, kamu harus menilai jawaban pengguna itu dengan hanya '1' jika jawaban pengguna benar, atau '0' jika jawaban pengguna salah"
                    },
                    {
                        "role": "user",
                        "content": `Soal: ${questionText}\nKunci Jawaban: ${correctAnswer}\nJawaban pengguna: ${userAnswer}`
                    }
                ]
            };

            try {
                const response = await fetch(endpoint, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${apiKey}`
                    },
                    body: JSON.stringify(requestBody)
                });

                if (!response.ok) {
                    throw new Error(`Server error: ${response.statusText}`);
                }

                const data = await response.json();
                console.log('Simple Evaluation Response:', data); // Debug log
                return data;
            } catch (error) {
                console.error('Error in getSimpleEvaluation:', error);
                throw error;
            }
        }

        // Fungsi untuk menyimpan hasil evaluasi ke database
        async function saveEvaluations() {
            for (const question of questionsData) {
                const { question_text, correct_answer, answer, answer_id } = question;

                try {
                    const simpleResult = await getSimpleEvaluation(question_text, correct_answer, answer);
                    console.log(`Raw result for answer ${answer_id}: ${JSON.stringify(simpleResult)}`); // Debug log

                    // Tampilkan hasil mentah dari evaluasi sederhana
                    const rawEvaluationBox = document.getElementById('raw-evaluation-box-' + answer_id);
                    rawEvaluationBox.innerText = simpleResult.choices[0].message.content.trim();

                    const isCorrect = simpleResult.choices[0].message.content.trim() === '1';

                    // Tampilkan hasil evaluasi sederhana (1/0) di dalam kotak evaluasi sederhana
                    const simpleEvaluationBox = document.getElementById('simple-evaluation-box-' + answer_id);
                    simpleEvaluationBox.innerText = isCorrect ? 'True' : 'False';

                    // Mengirim hasil evaluasi ke server
                    const response = await fetch('save_evaluation.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ answer_id, is_correct: isCorrect ? 1 : 0 })
                    });

                    if (!response.ok) {
                        throw new Error(`Server error: ${response.statusText}`);
                    }

                    const responseData = await response.json();
                    console.log('Save response:', responseData);
                } catch (error) {
                    console.error('Error in saveEvaluations:', error);
                }
            }
        }

        // Menjalankan evaluasi jawaban untuk setiap soal
        document.addEventListener("DOMContentLoaded", async function() {
            for (const question of questionsData) {
                const { question_text, correct_answer, answer, answer_id } = question;
                console.log(`Evaluating: ${answer_id}, ${question_text}, ${correct_answer}, ${answer}`); // Debug log

                try {
                    const result = await getGroqChatCompletion(question_text, correct_answer, answer);
                    const evaluationBox = document.getElementById('evaluation-box-' + answer_id);
                    evaluationBox.innerText = result.choices[0]?.message?.content || 'No result';

                    const simpleResult = await getSimpleEvaluation(question_text, correct_answer, answer);
                    console.log(`Raw result for answer ${answer_id}: ${JSON.stringify(simpleResult)}`); // Debug log

                    // Tampilkan hasil mentah dari evaluasi sederhana
                    const rawEvaluationBox = document.getElementById('raw-evaluation-box-' + answer_id);
                    rawEvaluationBox.innerText = simpleResult.choices[0].message.content.trim();

                    const isCorrect = simpleResult.choices[0].message.content.trim() === '1';

                    // Tampilkan hasil evaluasi sederhana (1/0) di dalam kotak evaluasi sederhana
                    const simpleEvaluationBox = document.getElementById('simple-evaluation-box-' + answer_id);
                    simpleEvaluationBox.innerText = isCorrect ? 'True' : 'False';

                } catch (error) {
                    console.error('Error evaluating answer:', error);
                    const evaluationBox = document.getElementById('evaluation-box-' + answer_id);
                    evaluationBox.innerText = 'Error';
                    evaluationBox.style.color = 'orange';

                    const rawEvaluationBox = document.getElementById('raw-evaluation-box-' + answer_id);
                    rawEvaluationBox.innerText = 'Error';
                    rawEvaluationBox.style.color = 'orange';
                }
            }
        });
    </script>
</body>
</html>
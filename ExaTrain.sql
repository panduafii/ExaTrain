-- Membuat tabel untuk pengguna (users)
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    angkatan YEAR,  -- Kolom baru untuk menyimpan angkatan
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Membuat tabel untuk pembayaran (payments)
CREATE TABLE IF NOT EXISTS payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    payment_status ENUM('paid', 'unpaid') NOT NULL DEFAULT 'unpaid',
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Membuat tabel untuk mata kuliah (subject)
CREATE TABLE IF NOT EXISTS subject (
    id INT AUTO_INCREMENT PRIMARY KEY,
    subject_name VARCHAR(100) NOT NULL
);

-- Membuat tabel untuk pertanyaan (questions)
CREATE TABLE IF NOT EXISTS questions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    question_text TEXT NOT NULL,
    correct_answer TEXT,
    subject_id INT,
    FOREIGN KEY (subject_id) REFERENCES subject(id)
);

-- Membuat tabel untuk jawaban (answers) dengan kolom evaluasi_ai
CREATE TABLE IF NOT EXISTS answers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    subject_id INT,
    question_id INT,
    answer TEXT,
    is_correct BOOLEAN,
    evaluasi_ai TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (subject_id) REFERENCES subject(id),
    FOREIGN KEY (question_id) REFERENCES questions(id)
);

-- Memasukkan data ke tabel subject
INSERT INTO subject (subject_name) VALUES
('Pengembangan Sistem Informasi'),
('Grafika dan Multimedia');

-- Memasukkan pertanyaan untuk mata kuliah Pengembangan Sistem Informasi
INSERT INTO questions (question_text, correct_answer, subject_id) VALUES
('Apa yang dimaksud dengan analisis kebutuhan dalam pengembangan sistem informasi?', 'Analisis kebutuhan adalah proses mengumpulkan dan menganalisis informasi untuk memahami kebutuhan sistem.', 1),
('Jelaskan siklus hidup pengembangan sistem informasi secara singkat.', 'Siklus hidup pengembangan sistem informasi meliputi analisis, desain, implementasi, dan pemeliharaan.', 1),
('Apa perbedaan antara desain database relasional dan non-relasional?', 'Desain database relasional menggunakan tabel untuk mengatur data sedangkan desain non-relasional menggunakan dokumen, grafik, atau metode lainnya.', 1);

-- Memasukkan pertanyaan untuk mata kuliah Grafika dan Multimedia
INSERT INTO questions (question_text, correct_answer, subject_id) VALUES
('Apa definisi dari multimedia?', 'Multimedia adalah kombinasi dari teks, audio, gambar, animasi, video, dan interaktivitas.', 2),
('Jelaskan prinsip-prinsip dasar desain grafis.', 'Prinsip-prinsip dasar desain grafis meliputi keseimbangan, kontras, penekanan, irama, dan kesatuan.', 2),
('Apa perbedaan antara bitmap dan vektor dalam konteks grafika komputer?', 'Bitmap adalah gambar yang terdiri dari piksel individual sedangkan vektor adalah gambar yang terdiri dari garis dan bentuk berdasarkan persamaan matematis.', 2);



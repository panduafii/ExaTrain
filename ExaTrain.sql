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
('Grafika dan Multimedia').
('Sistem Cerdas dan Pendukung Keputusan'),
('Bahasa Indonesia Komunikasi Ilmiah'),
('Bahasa Inggris Teknologi Informasi'),
('Islam Ulil Albab'),
('Matematika Lanjut'),
('Algoritma dan Struktur Data'),
('Fundamen Pengembangan Aplikasi'),
('Rekayasa Perangkat Lunak'),
('Islam Rahmatan lil Alamin'),
('Etika Profesi');

-- Memasukkan pertanyaan untuk mata kuliah Pengembangan Sistem Informasi
INSERT INTO questions (question_text, correct_answer, subject_id) VALUES
('Apa yang dimaksud dengan analisis kebutuhan dalam pengembangan sistem informasi?', 'Analisis kebutuhan adalah proses mengumpulkan dan menganalisis informasi untuk memahami kebutuhan sistem.', 1),
('Jelaskan siklus hidup pengembangan sistem informasi secara singkat.', 'Siklus hidup pengembangan sistem informasi meliputi analisis, desain, implementasi, dan pemeliharaan.', 1),
('Apa perbedaan antara desain database relasional dan non-relasional?', 'Desain database relasional menggunakan tabel untuk mengatur data sedangkan desain non-relasional menggunakan dokumen, grafik, atau metode lainnya.', 1);
('Apa itu DFD?', 'DFD adalah singkatan dari Data Flow Diagram, yang digunakan untuk memodelkan aliran data dalam sistem informasi.', 1),
('Jelaskan peran seorang analis sistem.', 'Seorang analis sistem bertanggung jawab untuk menganalisis kebutuhan bisnis dan merancang solusi teknologi informasi untuk memenuhi kebutuhan tersebut.', 1);

-- Memasukkan pertanyaan untuk mata kuliah Grafika dan Multimedia
INSERT INTO questions (question_text, correct_answer, subject_id) VALUES
('Apa definisi dari multimedia?', 'Multimedia adalah kombinasi dari teks, audio, gambar, animasi, video, dan interaktivitas.', 2),
('Jelaskan prinsip-prinsip dasar desain grafis.', 'Prinsip-prinsip dasar desain grafis meliputi keseimbangan, kontras, penekanan, irama, dan kesatuan.', 2),
('Apa perbedaan antara bitmap dan vektor dalam konteks grafika komputer?', 'Bitmap adalah gambar yang terdiri dari piksel individual sedangkan vektor adalah gambar yang terdiri dari garis dan bentuk berdasarkan persamaan matematis.', 2);
('Apa yang dimaksud dengan rendering dalam grafika komputer?', 'Rendering adalah proses menghasilkan gambar dari model dengan menggunakan program komputer.', 2),
('Jelaskan perbedaan antara animasi 2D dan 3D.', 'Animasi 2D menggunakan gambar dua dimensi yang diputar dengan cepat untuk menciptakan ilusi gerakan, sedangkan animasi 3D menggunakan model tiga dimensi yang dimanipulasi secara digital untuk menciptakan gerakan.', 2);

-- Memasukkan soal untuk mata kuliah Sistem Cerdas dan Pendukung Keputusan
INSERT INTO questions (question_text, correct_answer, subject_id) VALUES
('Apa itu sistem pakar?', 'Sistem pakar adalah sistem komputer yang meniru kemampuan pengambilan keputusan seorang ahli.', 3),
('Jelaskan perbedaan antara supervised dan unsupervised learning.', 'Supervised learning menggunakan data berlabel untuk melatih model, sedangkan unsupervised learning menggunakan data yang tidak berlabel.', 3),
('Apa itu fuzzy logic?', 'Fuzzy logic adalah pendekatan komputasi berdasarkan "derajat kebenaran" daripada logika biner tradisional.', 3),
('Jelaskan konsep algoritma genetika.', 'Algoritma genetika adalah metode optimisasi yang meniru proses seleksi alam.', 3),
('Apa perbedaan antara data mining dan machine learning?', 'Data mining adalah proses menemukan pola dalam data besar, sedangkan machine learning adalah subbidang dari kecerdasan buatan yang berfokus pada pengembangan algoritma yang dapat belajar dari data.', 3);

-- Memasukkan soal untuk mata kuliah Bahasa Indonesia Komunikasi Ilmiah
INSERT INTO questions (question_text, correct_answer, subject_id) VALUES
('Apa yang dimaksud dengan kalimat efektif?', 'Kalimat efektif adalah kalimat yang jelas, tepat, dan mudah dipahami.', 4),
('Jelaskan perbedaan antara ejaan dan tanda baca.', 'Ejaan adalah aturan penulisan huruf dan kata, sedangkan tanda baca adalah simbol yang digunakan untuk memperjelas makna kalimat.', 4),
('Apa itu paragraf deduktif?', 'Paragraf deduktif adalah paragraf yang kalimat utamanya berada di awal paragraf.', 4),
('Jelaskan fungsi dari konjungsi dalam kalimat.', 'Konjungsi adalah kata penghubung yang digunakan untuk menghubungkan kata, frasa, atau kalimat.', 4),
('Apa itu karya ilmiah?', 'Karya ilmiah adalah tulisan yang menyajikan hasil penelitian atau pengkajian yang telah dilakukan.', 4);

-- Memasukkan soal untuk mata kuliah Bahasa Inggris Teknologi Informasi
INSERT INTO questions (question_text, correct_answer, subject_id) VALUES
('What is a computer network?', 'A computer network is a group of interconnected computers that share resources and information.', 5),
('Explain the term "cloud computing".', 'Cloud computing is the delivery of computing services over the internet, allowing for on-demand access to resources.', 5),
('What is the difference between hardware and software?', 'Hardware refers to the physical components of a computer, while software refers to the programs and applications that run on a computer.', 5),
('Define the term "database".', 'A database is an organized collection of data that can be easily accessed, managed, and updated.', 5),
('What is cybersecurity?', 'Cybersecurity is the practice of protecting systems, networks, and programs from digital attacks.', 5);

-- Memasukkan soal untuk mata kuliah Islam Ulil Albab
INSERT INTO questions (question_text, correct_answer, subject_id) VALUES
('Apa itu tauhid?', 'Tauhid adalah konsep keesaan Tuhan dalam Islam.', 6),
('Jelaskan lima rukun Islam.', 'Lima rukun Islam adalah syahadat, shalat, zakat, puasa, dan haji.', 6),
('Apa itu fiqh?', 'Fiqh adalah ilmu yang mempelajari tentang hukum Islam.', 6),
('Jelaskan perbedaan antara Al-Qur\'an dan Hadis.', 'Al-Qur\'an adalah kitab suci umat Islam, sedangkan Hadis adalah kumpulan perkataan dan perbuatan Nabi Muhammad.', 6),
('Apa itu jihad?', 'Jihad adalah usaha sungguh-sungguh dalam mempertahankan dan menyebarkan agama Islam.', 6);

-- Memasukkan soal untuk mata kuliah Matematika Lanjut
INSERT INTO questions (question_text, correct_answer, subject_id) VALUES
('Apa itu bilangan kompleks?', 'Bilangan kompleks adalah bilangan yang terdiri dari bagian nyata dan bagian imajiner.', 7),
('Jelaskan teorema fundamental aljabar.', 'Teorema fundamental aljabar menyatakan bahwa setiap polinomial non-konstan dengan koefisien kompleks memiliki setidaknya satu akar kompleks.', 7),
('Apa itu matriks singular?', 'Matriks singular adalah matriks yang determinannya nol.', 7),
('Jelaskan konsep integral dalam kalkulus.', 'Integral adalah konsep matematika yang mengukur luas di bawah kurva fungsi.', 7),
('Apa itu deret Taylor?', 'Deret Taylor adalah representasi fungsi sebagai jumlah tak terbatas dari turunan fungsi tersebut pada satu titik.', 7);

-- Memasukkan soal untuk mata kuliah Algoritma dan Struktur Data
INSERT INTO questions (question_text, correct_answer, subject_id) VALUES
('Apa perbedaan antara array dan linked list?', 'Array memiliki ukuran tetap dan elemen-elemen disimpan dalam memori secara berurutan, sedangkan linked list memiliki ukuran dinamis dan elemen-elemen disimpan secara tidak berurutan dengan pointer.', 8),
('Jelaskan konsep rekursi.', 'Rekursi adalah teknik pemrograman di mana sebuah fungsi memanggil dirinya sendiri untuk menyelesaikan suatu masalah.', 8),
('Apa itu algoritma pencarian biner?', 'Algoritma pencarian biner adalah algoritma yang mencari elemen dalam array yang telah diurutkan dengan membagi array menjadi dua bagian dan mencari di salah satu bagian tersebut.', 8),
('Apa itu stack dan bagaimana cara kerjanya?', 'Stack adalah struktur data yang mengikuti prinsip LIFO (Last In, First Out) di mana elemen terakhir yang dimasukkan adalah yang pertama kali dikeluarkan.', 8),
('Jelaskan perbedaan antara tree dan graph.', 'Tree adalah struktur data hierarkis dengan satu root dan cabang-cabang, sedangkan graph adalah kumpulan node yang terhubung oleh edge tanpa struktur hierarkis.', 8);

-- Memasukkan soal untuk mata kuliah Fundamen Pengembangan Aplikasi
INSERT INTO questions (question_text, correct_answer, subject_id) VALUES
('Apa itu SDLC?', 'SDLC adalah singkatan dari Software Development Life Cycle yang merupakan proses untuk merencanakan, membuat, menguji, dan menerapkan sistem informasi.', 9),
('Jelaskan perbedaan antara front-end dan back-end development.', 'Front-end development berkaitan dengan antarmuka pengguna sedangkan back-end development berkaitan dengan logika bisnis dan pengelolaan database.', 9),
('Apa yang dimaksud dengan API?', 'API adalah singkatan dari Application Programming Interface yang memungkinkan aplikasi untuk berkomunikasi satu sama lain.', 9),
('Jelaskan konsep MVC.', 'MVC adalah singkatan dari Model-View-Controller, sebuah pola desain yang memisahkan logika aplikasi, antarmuka pengguna, dan pengontrol.', 9),
('Apa itu continuous integration?', 'Continuous integration adalah praktik pengembangan perangkat lunak di mana kode yang dikembangkan secara berkala diintegrasikan ke dalam repositori bersama untuk mendeteksi masalah integrasi sejak dini.', 9);

-- Memasukkan soal untuk mata kuliah Rekayasa Perangkat Lunak
INSERT INTO questions (question_text, correct_answer, subject_id) VALUES
('Apa itu rekayasa perangkat lunak?', 'Rekayasa perangkat lunak adalah disiplin ilmu yang berkaitan dengan desain, pengembangan, dan pemeliharaan perangkat lunak.', 10),
('Jelaskan perbedaan antara waterfall dan agile.', 'Waterfall adalah model pengembangan perangkat lunak yang linear dan berurutan, sedangkan agile adalah pendekatan yang iteratif dan inkremental.', 10),
('Apa itu UML?', 'UML adalah singkatan dari Unified Modeling Language, yang digunakan untuk memvisualisasikan dan mendokumentasikan desain sistem perangkat lunak.', 10),
('Jelaskan konsep pengujian perangkat lunak.', 'Pengujian perangkat lunak adalah proses evaluasi sistem perangkat lunak untuk menemukan bug dan memastikan bahwa perangkat lunak tersebut sesuai dengan spesifikasi yang ditentukan.', 10),
('Apa itu version control?', 'Version control adalah sistem yang mengelola perubahan kode sumber sehingga setiap perubahan dapat dilacak dan dikelola.', 10);

-- Memasukkan soal untuk mata kuliah Islam Rahmatan lil 'Alamin
INSERT INTO questions (question_text, correct_answer, subject_id) VALUES
('Apa makna dari Islam Rahmatan lil \'Alamin?', 'Islam Rahmatan lil \'Alamin berarti Islam sebagai rahmat bagi seluruh alam.', 11),
('Jelaskan konsep keadilan dalam Islam.', 'Keadilan dalam Islam adalah memberikan hak kepada yang berhak dan menempatkan sesuatu pada tempatnya.', 11),
('Apa itu ukhuwah Islamiyah?', 'Ukhuwah Islamiyah adalah persaudaraan dalam Islam.', 11),
('Jelaskan pentingnya akhlak dalam Islam.', 'Akhlak adalah perilaku mulia yang sangat penting dalam kehidupan seorang Muslim.', 11),
('Apa itu maqasid syariah?', 'Maqasid syariah adalah tujuan-tujuan syariah yang meliputi perlindungan agama, jiwa, akal, keturunan, dan harta.', 11);

-- Memasukkan soal untuk mata kuliah Etika Profesi
INSERT INTO questions (question_text, correct_answer, subject_id) VALUES
('Apa itu etika profesi?', 'Etika profesi adalah standar perilaku yang diharapkan dalam suatu profesi.', 12),
('Jelaskan pentingnya kode etik dalam suatu profesi.', 'Kode etik penting untuk memastikan perilaku profesional yang sesuai dan menjaga integritas profesi.', 12),
('Apa perbedaan antara etika dan moral?', 'Etika adalah prinsip yang mengatur perilaku profesional, sedangkan moral adalah prinsip yang mengatur perilaku individu berdasarkan nilai-nilai pribadi.', 12),
('Jelaskan tanggung jawab sosial seorang profesional.', 'Tanggung jawab sosial seorang profesional adalah kontribusi yang diberikan kepada masyarakat melalui profesinya.', 12),
('Apa itu konflik kepentingan dalam profesi?', 'Konflik kepentingan adalah situasi di mana kepentingan pribadi seorang profesional berbenturan dengan kepentingan profesinya.', 12);

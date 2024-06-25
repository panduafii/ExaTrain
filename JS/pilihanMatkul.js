function goBack() {
    window.history.back();
}

document.addEventListener("DOMContentLoaded", () => {
    const yearButtons = document.querySelectorAll(".year-button");
    const coursesContainer = document.querySelector(".courses");
    const menuToggle = document.querySelector(".menu-toggle");
    const menu = document.querySelector(".menu");

    const courses = {
        2023: [
            { id: 1, name: "Matematika Lanjut", img: "img/matlan.png" },
            { id: 2, name: "Algoritma dan Struktur Data", img: "img/asd.png" },
            { id: 3, name: "Fundamen Pengembangan Aplikasi", img: "img/fpa.png" },
            { id: 4, name: "Rekayasa Perangkat Lunak", img: "img/rpl.png" },
        ],
        2022: [
            { id: 1, name: "Pengembangan Sistem Informasi", img: "img/psi.png" },
            { id: 2, name: "Grafika dan Multimedia", img: "img/grafmul.png" },
            { id: 3, name: "Sistem Cerdas dan Pendukung Keputusan", img: "img/scpk.png" },
            { id: 4, name: "Bahasa Indonesia Komunikasi Ilmiah", img: "img/bindo.png" },
            { id: 5, name: "Bahasa Inggris Teknologi Informasi", img: "img/bingris.png" },
            { id: 6, name: "Islam Ulil Albab", img: "img/islam.png" },
            { id: 7, name: "Kewirausahaan Syariah", img: "img/wirus.png" },
        ],
        2021: [
            { id: 13, name: "Islam Rahmatan lil 'Alamin", img: "img/iru.png" },
            { id: 15, name: "Etika Profesi", img: "img/profesi.png" },
        ],
    };

    function displayCourses(year) {
        coursesContainer.innerHTML = "";
        courses[year].forEach((course) => {
            const courseButton = document.createElement("button");
            courseButton.type = 'submit';  // Pastikan ini adalah tipe submit
            courseButton.className = "course-button";
            courseButton.name = "selected_course_id";
            courseButton.value = course.id;
    
            const courseImg = document.createElement("img");
            courseImg.src = course.img;
            courseImg.alt = course.name;
    
            const courseName = document.createElement("span");
            courseName.textContent = course.name;
    
            courseButton.appendChild(courseImg);
            courseButton.appendChild(courseName);
    
            courseButton.addEventListener('click', function() {
                document.getElementById('courseForm').submit(); // Menambahkan pengiriman form saat tombol diklik
            });
    
            coursesContainer.appendChild(courseButton);
        });
    }
    

    yearButtons.forEach((button) => {
        button.addEventListener("click", () => {
            yearButtons.forEach((btn) => btn.classList.remove("active"));
            button.classList.add("active");
            displayCourses(button.id);
        });
    });

    // Initial display
    displayCourses("2022");

    // Handle menu toggle for mobile view
    menuToggle.addEventListener("click", () => {
        menu.classList.toggle("active");
    });
});

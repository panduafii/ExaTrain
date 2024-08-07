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
      { id: 5, name: "Pengembangan Sistem Informasi", img: "img/psi.png" },
      { id: 6, name: "Grafika dan Multimedia", img: "img/grafmul.png" },
      { id: 7, name: "Sistem Cerdas dan Pendukung Keputusan", img: "img/scpk.png" },
      { id: 8, name: "Bahasa Indonesia Komunikasi Ilmiah", img: "img/bindo.png" },
      { id: 9, name: "Bahasa Inggris Teknologi Informasi", img: "img/bingris.png" },
      { id: 10, name: "Islam Ulil Albab", img: "img/islam.png" },
      { id: 11, name: "Kewirausahaan Syariah", img: "img/wirus.png" },
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

      coursesContainer.appendChild(courseButton);

      // Tambahkan event listener untuk setiap tombol mata kuliah
      courseButton.addEventListener("click", () => {
        const selectedCourseId = course.id;

        // Simpan selected_course_id di dalam session
        fetch("pilihanMatkul.php", {
          method: "POST",
          body: new URLSearchParams({
            selected_course_id: selectedCourseId,
          }),
        })
          .then(() => {
            // Redirect ke halaman EvaluasiSoal.php setelah menyimpan session
            window.location.href = "EvaluasiSoal.php";
          })
          .catch((error) => {
            console.error("Error:", error);
          });
      });
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

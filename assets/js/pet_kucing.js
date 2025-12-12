const pet = document.getElementById("pet-kucing");
const petImg = document.getElementById("pet-img");

// posisi awal
let x = 10;
let direction = 1; // 1 = kanan, -1 = kiri

function movePet() {
    const screenWidth = window.innerWidth - 100;

    // gerak kiri-kanan
    x += direction * 1.2;

    // balik arah
    if (x >= screenWidth) direction = -1;
    if (x <= 0) direction = 1;

    pet.style.left = x + "px";

    // ganti gambar sesuai arah
    if (direction === 1) {
        petImg.style.transform = "scaleX(1)";
    } else {
        petImg.style.transform = "scaleX(-1)";
    }

    requestAnimationFrame(movePet);
}

// idle setiap 7 detik
setInterval(() => {
    petImg.src = "assets/img/kucing_idle.gif";
    setTimeout(() => {
        petImg.src = "assets/img/kucing_jalan.gif";
    }, 2000);
}, 7000);

petImg.src = "assets/img/kucing_jalan.gif";
movePet();

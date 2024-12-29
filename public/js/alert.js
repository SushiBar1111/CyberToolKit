document.addEventListener('DOMContentLoaded', () => {
    const popup = document.getElementById('popup-status');
    if (popup) {
        // Waktu tampilan popup (3 detik)
        setTimeout(() => {
            popup.style.opacity = '0'; // Efek fade-out
            setTimeout(() => popup.remove(), 500); // Hapus elemen setelah fade-out
        }, 3000);
    }
});
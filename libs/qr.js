// libs/qr.js

function initQRComponent() {
    const container = document.getElementById('qr-unique-container');
    if(!container) return; // QR page not loaded, do nothing

    const input = document.getElementById('qr-text');
    const btn = document.getElementById('qr-generate');
    const display = document.getElementById('qr-display');

    if(!input || !btn || !display) return;

    // Remove old listeners to prevent duplicates
    btn.replaceWith(btn.cloneNode(true));
    const newBtn = document.getElementById('qr-generate');

    newBtn.addEventListener('click', () => {
        const text = input.value.trim();
        if(!text) return alert('Enter text or URL!');
        display.innerHTML = '';
        new QRCode(display, { text, width:200, height:200 });
    });
}

/* ------------------------
   PAGE ROUTER
------------------------ */
function normalizePage(page) {
    if (!page) return "home.php"; 
    if (!page.includes(".")) page += ".php"; 
    return page;
}

function getPageFromURL() {
    const params = new URLSearchParams(window.location.search);
    return normalizePage(params.get("page"));
}

function loadPage(pageName) {
    pageName = normalizePage(pageName);
    const contentBox = document.getElementById("content-box");
    if (!contentBox) return;

    fetch(`pages/${pageName}`)
        .then(r => {
            if (!r.ok) throw new Error("PHP fetch failed");
            return r.text();
        })
        .then(html => {
            contentBox.innerHTML = html;
            afterPageLoad(pageName);
        })
        .catch(() => {
            const htmlPage = pageName.replace(".php", ".html");
            fetch(`pages/${htmlPage}`)
                .then(r => {
                    if (!r.ok) throw new Error("HTML fetch failed");
                    return r.text();
                })
                .then(html => {
                    contentBox.innerHTML = html;
                    afterPageLoad(htmlPage);
                })
                .catch(() => {
                    contentBox.innerHTML = `<p>❌ Page "${pageName}" not found.</p>`;
                });
        });
}

function afterPageLoad(pageName) {
    if (typeof initUploadForm === "function") initUploadForm();
    if (pageName === "qr.php" && typeof initQRComponent === "function") initQRComponent();
}


/* ------------------------
   NAVIGATION HANDLER
------------------------ */
document.addEventListener("click", e => {
    const link = e.target.closest("a[data-page]");
    if (!link) return;
    e.preventDefault();

    const pageName = normalizePage(link.dataset.page);
    history.pushState(null, "", `?page=${pageName}`);
    loadPage(pageName);
});

/* ------------------------
   INITIAL LOAD
------------------------ */
window.addEventListener("DOMContentLoaded", () => loadPage(getPageFromURL()));

/* ------------------------
   BACK/FORWARD SUPPORT
------------------------ */
window.addEventListener("popstate", () => loadPage(getPageFromURL()));


/* =====================================================
   AUDIO PLAYER
===================================================== */
document.addEventListener("DOMContentLoaded", () => {
    const audioPlayer = document.getElementById("audioPlayer");
    const pauseBtn = document.getElementById("pauseBtn");
    if (!audioPlayer || !pauseBtn) return;

    audioPlayer.play().catch(()=>{}); // ignore autoplay restrictions

    pauseBtn.addEventListener("click", () => {
        if (audioPlayer.paused) {
            audioPlayer.play();
            pauseBtn.textContent = "⏸️";
        } else {
            audioPlayer.pause();
            pauseBtn.textContent = "▶️";
        }
    });
});


/* =====================================================
   HAMBURGER MENU
===================================================== */
document.addEventListener("DOMContentLoaded", () => {
    const burger = document.getElementById("hamburger");
    const navbar = document.getElementById("navbar");
    if (!burger || !navbar) return;

    burger.addEventListener("click", () => navbar.classList.toggle("show"));
    navbar.querySelectorAll("a").forEach(link => link.addEventListener("click", () => navbar.classList.remove("show")));
});


/* =====================================================
   ALBUM COVER HOVER TEXT
===================================================== */
(function () {
    const albumCover = document.querySelector(".album-cover");
    const hoverText = document.getElementById("hover-text");
    if (!albumCover || !hoverText) return;

    let mouseX = 0, mouseY = 0;
    let textX = 0, textY = 0;
    const speed = 0.15;
    const offsetX = 150, offsetY = 400;

    albumCover.addEventListener("mouseenter", e => {
        const bounds = albumCover.getBoundingClientRect();
        mouseX = e.clientX - bounds.left + offsetX;
        mouseY = e.clientY - bounds.top + offsetY;
        textX = mouseX; textY = mouseY;
        hoverText.style.opacity = "1";
    });

    albumCover.addEventListener("mouseleave", () => hoverText.style.opacity = "0");
    albumCover.addEventListener("mousemove", e => {
        const bounds = albumCover.getBoundingClientRect();
        mouseX = e.clientX - bounds.left + offsetX;
        mouseY = e.clientY - bounds.top + offsetY;
    });

    function animate() {
        textX += (mouseX - textX) * speed;
        textY += (mouseY - textY) * speed;
        hoverText.style.left = textX + "px";
        hoverText.style.top = textY + "px";
        requestAnimationFrame(animate);
    }
    animate();
})();


/* =====================================================
   SNOW EFFECT
===================================================== */
function createSnowflake() {
    const container = document.getElementById("snow-container");
    if (!container) return;

    const snowflake = document.createElement("div");
    snowflake.className = "snowflake";
    snowflake.textContent = "❄️";
    snowflake.style.left = Math.random() * window.innerWidth + "px";
    snowflake.style.fontSize = (Math.random()*15+10)+"px";
    snowflake.style.opacity = Math.random();
    const duration = Math.random()*5+2;
    snowflake.style.animationDuration = duration + "s";

    container.appendChild(snowflake);
    setTimeout(()=>snowflake.remove(), duration*1000);
}
setInterval(createSnowflake, 100);


/* =====================================================
   CURSOR PARTICLES
===================================================== */
const particles = ["❄️","🎁","❤️","✨","🎄"];
document.addEventListener("mousemove", e => {
    const particle = document.createElement("div");
    particle.className = "cursor-particle";
    particle.textContent = particles[Math.floor(Math.random()*particles.length)];
    particle.style.left = e.clientX + "px";
    particle.style.top = e.clientY + "px";
    particle.style.fontSize = (Math.random()*6+8) + "px";
    particle.style.transform = `rotate(${Math.random()*360}deg)`;
    document.body.appendChild(particle);
    setTimeout(()=>particle.remove(), 1000);
});


/* =====================================================
   SMOOTH SCROLL
===================================================== */
document.addEventListener("click", e => {
    const anchor = e.target.closest('a[href^="#"]');
    if (!anchor) return;

    const target = document.querySelector(anchor.getAttribute("href"));
    if (!target) return;

    e.preventDefault();
    target.scrollIntoView({ behavior: "smooth" });
});


/* =====================================================
   UPLOAD FORM
===================================================== */
function initUploadForm() {
    const iframe = document.getElementById("upload-target");
    const msgBox = document.getElementById("upload-msg");
    if (!iframe || !msgBox) return;

    iframe.addEventListener("load", () => {
        const doc = iframe.contentDocument || iframe.contentWindow.document;
        msgBox.innerHTML = doc.body.innerHTML;
    });
}
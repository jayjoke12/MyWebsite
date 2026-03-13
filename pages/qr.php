<div id="qr-unique-container" style="
    display:flex; 
    flex-direction:column; 
    align-items:center; 
    text-align:center; 
    max-width:420px; 
    margin:40px auto; 
    padding:30px; 
    border:3px solid #6ac7ff; 
    border-radius:28px; 
    box-shadow:0 0 18px #6ac7ff, 0 0 40px rgba(106,199,255,0.9), inset 0 0 15px rgba(106,199,255,0.5); 
    font-family:'MyFont', sans-serif;
    transition: transform 0.3s ease;
">
  <h2 style="
        margin-bottom:25px; 
        color:#6ac7ff;
        text-shadow: 0 0 18px #6ac7ff;
    ">QR Code Generator</h2>

  <input id="qr-text" type="text" placeholder="Enter text or URL" 
         style="
             padding:12px; 
             width:80%; 
             max-width:260px; 
             font-size:16px; 
             border-radius:28px; 
             border:3px solid #6ac7ff; 
             outline:none; 
             box-shadow: inset 0 0 15px rgba(106,199,255,0.5);
             background:#fff;
             color:#111;
             transition: all 0.25s ease;
             font-family:'MyFont', sans-serif;
         "
         onfocus="this.style.boxShadow='0 0 20px #6ac7ff';"
         onblur="this.style.boxShadow='inset 0 0 15px rgba(106,199,255,0.5)';"
  >

  <button id="qr-generate" 
          style="
              padding:12px 25px; 
              font-size:16px; 
              margin-top:15px;
              cursor:pointer; 
              border:none; 
              border-radius:28px; 
              background:#6ac7ff; 
              color:#111; 
              box-shadow: 0 5px 15px rgba(106,199,255,0.3); 
              transition: transform 0.2s ease, box-shadow 0.2s ease;
              font-family:'MyFont', sans-serif;
          "
          onmouseover="this.style.transform='scale(1.08)'; this.style.boxShadow='0 8px 20px rgba(106,199,255,0.5)';"
          onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='0 5px 15px rgba(106,199,255,0.3)';"
  >
      Generate
  </button>

  <div id="qr-display" style="
        margin-top:25px; 
        display:flex; 
        justify-content:center; 
        align-items:center; 
        width:220px; 
        height:220px; 
        border-radius:28px;
        box-shadow:0 0 18px #6ac7ff, 0 0 40px rgba(106,199,255,0.9), inset 0 0 15px rgba(106,199,255,0.5);
        overflow:hidden;
      ">
    <canvas id="qr-canvas" width="220" height="220" style="
        display:block; 
        width:100%; 
        height:100%; 
        border-radius:28px;
    "></canvas>
  </div>
</div>
<style>
    .hfp {
    display: inline-block;
    position: relative;
    padding: 8px 15px;
    border-radius: 4px;
    transition: all 0.3s ease;
    cursor: pointer;
    background-color: #ffacd5ff;
}

.hfp::after {
    content: '';
    position: absolute;
    width: 0;
    height: 3px;
    bottom: 0;
    left: 0;
    background: white;
    transition: width 0.3s ease;
}

.hfp:hover {
    background-color: #ff69b4;
    color: white;
    text-shadow: 0 0 8px rgba(255,255,255,0.7);
}

.hfp:hover::after {
    width: 100%;
}

.hfp {
  cursor: url('/assets/cursors/pinkhearts/pinkheart_linkselect.cur'), pointer;
  margin: 10px;
}

</style>
<a class="hfp" href="?page=tools" data-page="tools.php">↩</a>
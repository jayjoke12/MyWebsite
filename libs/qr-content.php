<!-- libs/qr-content.php -->
<div id="qr-unique-container" style="text-align:center; margin:30px; padding:20px; background:#f3f3f3; border-radius:20px; box-shadow:0 0 20px rgba(0,0,0,0.2); max-width:400px; margin-left:auto; margin-right:auto;">
  <h2 style="margin-bottom:20px; font-family: Arial, sans-serif;">QR Code Generator</h2>
  <input id="qr-text" type="text" placeholder="Enter text or URL" 
         style="padding:10px; width:80%; max-width:250px; font-size:16px; border-radius:8px; border:1px solid #ccc;">
  <button id="qr-generate" 
          style="padding:10px 20px; font-size:16px; margin-left:10px; cursor:pointer; border:none; border-radius:8px; background:#000; color:#fff;">
      Generate
  </button>
  <div id="qr-display" style="margin-top:20px;"></div>
</div>
<style>
  
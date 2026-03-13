<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Server Status</title>

<style>
  /* Font & basic styling */
  h1, h2, h3, h4, h5, h6, p, a, span, div, button {
    font-family: 'MyFont', sans-serif;
  }

  h1 { text-align: center; }

  /* Back button */
  .hfp {
    display: inline-block;
    position: relative;
    padding: 8px 15px;
    border-radius: 4px;
    transition: all 0.3s ease;
    cursor: url('/assets/cursors/pinkhearts/pinkheart_linkselect.cur'), pointer;
    background-color: #ffacd5ff;
    color: white;
    text-decoration: none;
    margin-bottom: 10px;
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
  .hfp:hover::after { width: 100%; }

  /* Container for all widgets */
  #mc-widgets-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    grid-auto-rows: auto; 
    gap: 20px;
    padding: 20px;
    justify-items: center;
  }

  /* Widget styling */
  #mc-widget {
    width: 100%;
    display: flex;
    flex-direction: column;
    margin: 0;
    border: 3px solid #6ac7ff;
    border-radius: 20px;
    background-color: rgba(255,255,255,0.05);
    backdrop-filter: blur(8px);
    color: #000000ff;
    box-shadow:
      0 0 18px #6ac7ff,
      0 0 40px rgba(106, 199, 255, 0.9),
      inset 0 0 15px rgba(106, 199, 255, 0.5);
    overflow: visible; /* allow content to expand */
    text-align: center;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    word-wrap: break-word; /* handle long words/titles */
  }

  #mc-widget:hover {
    transform: scale(1.02);
    box-shadow:
      0 0 25px #6ac7ff,
      0 0 50px rgba(106, 199, 255, 0.9),
      inset 0 0 20px rgba(106, 199, 255, 0.5);
  }

  #mc-widget-overlay {
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background: url('assets/blocks/dirt.png') repeat;
    background-size: 64px 64px;
    mix-blend-mode: overlay;
    opacity: 0.3;
    pointer-events: none;
    filter: brightness(0.3) blur(1px);
    z-index: 0;
  }

  #mc-widget-content {
    position: relative;
    z-index: 1;
    padding: 15px;
    display: flex;
    flex-direction: column;
    flex-grow: 1;
  }

  #mc-widget h3, #mc-widget h4, #mc-widget p {
    word-wrap: break-word; 
    white-space: normal; /* ensure wrapping for long titles/text */
  }

  #mc-status { font-weight: bold; color: #0f0; }
  #yellow { font-weight: bold; color: #ff9748ff; }
  #mc-status-java { font-weight: bold; color: #f00; }

  #mc-refresh-btn {
    margin-top: auto;
    padding: 8px 16px;
    font-size: 1em;
    background-color: #222;
    color: #ffffffff;
    border: 2px solid #000;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.2s ease;
    font-family: 'MyFont', sans-serif;
  }
  #mc-refresh-btn:hover {
    background-color: #000;
    box-shadow: 0 0 10px rgba(106, 199, 255, 0.6);
  }
  #mc-refresh-btn:active { transform: scale(0.97); }
</style>
</head>
<script src="../libs/priv/status.js"></script>
<body>
<h1>Server Status</h1>
<h4>This page will be laggy and forever will be.</h4>
<a class="hfp" href="?page=tools" data-page="tools.php">↩ Back</a>
<div id="mc-widgets-container">
  <div id="mc-widget">
    <div id="mc-widget-overlay"></div>
    <div id="mc-widget-content">
      <h3>api.tingler.farted.net</h3>
      <p>Status: <span id="mc-status">Online</span></p>
      <p id="yellow">Access to this service is actively restricted due to ongoing issues.</p>
      <button id="mc-refresh-btn">Refresh</button>
    </div>
  </div>
  <div id="mc-widget">
    <div id="mc-widget-overlay"></div>
    <div id="mc-widget-content">
      <h3>priv-api.tingler.farted.net</h3>
      <p>Status: <span id="mc-status">Online</span></p>
      <p id="yellow">Access to this service is actively restricted due to ongoing issues.</p>
      <button id="mc-refresh-btn">Refresh</button>
    </div>
  </div>
    <div id="mc-widget">
    <div id="mc-widget-overlay"></div>
    <div id="mc-widget-content">
      <h3>files.tingler.farted.net (new)</h3>
      <p id="">The new tingler file server!</p>
      <p>Status: <span id="mc-status">Online</span></p>
      <p id="yellow">Access to this service is partly restricted due to ongoing issues but can still be accessed.</p>
      <button id="mc-refresh-btn">Refresh</button>
    </div>
  </div>
  <div id="mc-widget">
    <div id="mc-widget-overlay"></div>
    <div id="mc-widget-content">
      <h3>backend.tingler.farted.net</h3>
      <p>Status: <span id="mc-status">Online</span></p>
      <button id="mc-refresh-btn">Refresh</button>
    </div>
  </div>
  <div id="mc-widget">
    <div id="mc-widget-overlay"></div>
    <div id="mc-widget-content">
      <h3>backend.mc.bedrock.tingler.farted.net (priv)</h3>
      <h4>tingler.farted.net (public)</h4>
      <p>Status: <span id="yellow">Online (Degraded Performance)</span></p>
      <p class="updates"id="yellow">Currently fixing this issue.</p>
      <p>Players: <span id="mc-players">Feature Disabled</span><span id="mc-max"></span></p>
      <button id="mc-refresh-btn">Refresh</button>
    </div>
  </div>
  <div id="mc-widget">
    <div id="mc-widget-overlay"></div>
    <div id="mc-widget-content">
      <h3>backend.mc.java.tingler.farted.net (priv)</h3>
      <h4>tingler.farted.net (public)</h4>
      <p>Status: <span id="mc-status-java">Offline</span></p>
      <p>Players: <span id="mc-players"></span><span id="mc-max"></span></p>
      <button id="mc-refresh-btn">Refresh</button>
    </div>
  </div>
  <div id="mc-widget">
    <div id="mc-widget-overlay"></div>
    <div id="mc-widget-content">
      <h3>backend.mc.tingler.farted.net</h3>
      <h4>tingler.farted.net (public)</h4>
      <p>Status: <span id="mc-status">Online</span></p>
      <button id="mc-refresh-btn">Refresh</button>
    </div>
  </div>
  <div id="mc-widget">
    <div id="mc-widget-overlay"></div>
    <div id="mc-widget-content">
      <h3>backend.apache.tingler.farted.net</h3>
      <p>Status: <span id="mc-status">Online</span></p>
      <button id="mc-refresh-btn">Refresh</button>
    </div>
  </div>
    <div id="mc-widget">
    <div id="mc-widget-overlay"></div>
    <div id="mc-widget-content">
      <h3>backend.mc.bedrock.brodcast.tingler.farted.net</h3>
      <p>Status: <span id="mc-status">Online</span></p>
      <p class="updates"id="yellow">Currently fixing this issue.</p>
      <button id="mc-refresh-btn">Refresh</button>
    </div>
  </div>
      <div id="mc-widget">
    <div id="mc-widget-overlay"></div>
    <div id="mc-widget-content">
      <h3>farted.net</h3>
      <p>Status: wip <span id="mc-status">Loading...</span></p>
      <button id="mc-refresh-btn">Refresh</button>
    </div>
  </div>

</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
  const serverAddress = "tingler.farted.net:19132";

  async function updateMCWidget() {
    try {
      const res = await fetch(`https://api.mcstatus.io/v2/status/bedrock/${serverAddress}`);
      const data = await res.json();

      const statusEl = document.getElementById("mc-status");
      const playersEl = document.getElementById("mc-players");
      const maxEl = document.getElementById("mc-max");
      const motdEl = document.getElementById("mc-motd");
      const versionEl = document.getElementById("mc-version");

      if (!statusEl || !playersEl || !maxEl || !motdEl || !versionEl) return;

      statusEl.innerText = data.online ? "Online" : "Offline";
      playersEl.innerText = data.players?.online ?? 0;
      maxEl.innerText = data.players?.max ?? 0;
      motdEl.innerText = data.motd?.clean ?? "-";
      versionEl.innerText = data.version?.name ?? "-";
    } catch (err) {
      console.error("Error fetching server data:", err);
      const els = ["mc-status","mc-players","mc-max","mc-motd","mc-version"];
      els.forEach(id => {
        const el = document.getElementById(id);
        if(el) el.innerText = "?";
      });
    }
  }

  updateMCWidget();
  setInterval(updateMCWidget, 6000);

  document.addEventListener("click", (e) => {
    if(e.target && e.target.id === "mc-refresh-btn") {
      updateMCWidget();
    }
  });
});
</script>
</body>
</html>

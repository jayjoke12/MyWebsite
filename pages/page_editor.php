<!DOCTYPE html>
<h2>Upload Your Page</h2>

<form id="user-upload-form"
      action="http://tingler.farted.net/upload_user_page.php"
      method="POST"
      enctype="multipart/form-data"
      target="upload-target">

    <input type="file" name="userfile" accept=".html" required>
    <button type="submit" id="upload-btn">Upload Page</button>

</form>

<iframe name="upload-target" id="upload-target" style="display:none;"></iframe>

<div id="upload-msg"></div>

<p style="color: grey; font-size: 12px; margin-top: 20px;">
    If you don't know how to make an HTML page, try using <a href="https://html5-editor.net/" target="_blank">html5-editor</a> 
    or <a href="https://codepen.io/" target="_blank">CodePen</a> to create one, then download it and upload it here.
</p>
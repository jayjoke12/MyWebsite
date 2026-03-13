<?php
include('../libs/header.php');
?>
<?php

$photoDir = __DIR__ . "/photos/";


$photoUrl = "pages/photos/";


$images = array_diff(scandir($photoDir), array('.', '..'));


$images = array_filter($images, function($file) use ($photoDir) {
    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    return in_array($ext, ['jpg','jpeg','png','gif','webp', 'mov']);
});
?>

<style>
  h1, h2, h3, h4, h5, h6, p, a, span, div {
    font-family: MyFont;
  }

  
    #nudes-popup {
        position: fixed;
        top: 130px;
        left: 0;
        width: 300px;
        height: auto;
        opacity: 1;
        transform: translate(-100%, 0) scale(1); 
        transition: transform 0.6s ease-out, opacity 0.6s ease-out;
        z-index: 9999;
        pointer-events: none;
    }

    #nudes-popup.show {
        opacity: 1;
        transform: translate(0, 0) scale(1);
    }

    #nudes-popup.hide {
        opacity: 1;
        transform: translate(-100%, 0) scale(1); 
    }

    #nudes-popup img {
        width: 100%;
        height: auto;
        display: block;
        border-radius: 8px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.3);
    }
    @media (max-width: 980px) {
        .gallery-photo {
            max-width: 150px;
            max-height: 150px;
        }
    }

    #smaller {
        font-size: 12px;
        color: #9e9e9eff;
    }
</style>

<div id="gallery-container">
    <h1>my nudes 😳🌶️</h1>
    <p id="text">my nudes lowkey wildin here</p>
    <p id = "smaller" id="text">(these are photos of my favs, like my CRUSHSSS or people who i admire idkk<br> if you though it was acc nukers get da helly out ya creeps)<br><br><br></p>
    <div id="gallery-photos">
        <?php foreach($images as $img): ?>
            <div class="gallery-frame">
                <img class="gallery-photo" src="<?php echo $photoUrl . $img; ?>" alt="Photo">
            </div>
        <?php endforeach; ?>
    </div>

</div>


<style>


#text {
    color: #9e9e9eff;
}


#gallery-container {
    padding: 20px;
    text-align: center;
}


#gallery-photos {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
}


.gallery-frame {
    display: inline-block;
}


.gallery-photo {
    width: auto;
    height: auto;
    max-width: 350px;
    max-height: 350px;
    object-fit: cover;
    border-radius: 10px;
    border: 3px solid black;
    transition: transform 0.3s ease;
}

.gallery-photo:hover {
    transform: scale(1.05);
}

.gallery-photo:active {
    transform: scale(1.4);
}
.gallery


@media (max-width: 600px) {
    .gallery-photo {
        max-width: 150px;
        max-height: 150px;
    }
}
</style>

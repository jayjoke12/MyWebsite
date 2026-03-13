<?php
$usersDir = __DIR__ . "/users/";

if (!is_dir($usersDir)) {
    echo "<h3>No user pages yet.</h3>";
    exit;
}

$users = scandir($usersDir);
?>

<h2>User Generated Pages</h2>
<ul style="line-height: 1.8;">
<?php
foreach ($users as $userFolder) {
    if ($userFolder === "." || $userFolder === "..") continue;

    $userPath = $usersDir . $userFolder;

    if (is_dir($userPath)) {
        // Look for .html and .php files inside each user folder
        $files = glob("$userPath/*.{html,php}", GLOB_BRACE);

        if (count($files) === 0) continue; // skip empty folders

        echo "<li><strong>" . htmlspecialchars($userFolder) . "</strong><ul>";

        foreach ($files as $file) {
            $filename = basename($file);

            // link compatible with ?page= loader
            $pageParam = "users/$userFolder/$filename";
            $encoded   = urlencode($pageParam);

            echo "<li style='margin-left:20px;'>
                    <a href='?page=$encoded'>
                        " . htmlspecialchars($filename) . "
                    </a>
                  </li>";
        }

        echo "</ul></li>";
    }
}
?>
</ul>

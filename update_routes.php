<?php
$filepath = 'routes/web.php';
$content = file_get_contents($filepath);

if (strpos($content, "Route::get('/chat-negocio'") === false) {
    // Append at the end, before the require auth if possible, or just at the bottom
    $content .= "\nRoute::get('/chat-negocio', function () { return view('chat-negocio'); });\n";
    file_put_contents($filepath, $content);
    echo "ROUTE ADDED\n";
} else {
    echo "ROUTE ALREADY EXISTS\n";
}
?>

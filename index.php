<?php
function checkURLAvailability($url) {
    // Stel een time-out in voor het HTTP-verzoek
    $timeout = 10;

    // Voer het HTTP-verzoek uit om de URL te controleren
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_FAILONERROR, true); // Voeg deze regel toe
    curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    // Controleer de HTTP-statuscode
    if ($httpCode == 200) {
        $message = "Ja RVH KAN IETS!!.";
        $statusClass = "available";
    } else {
        $message = "Nee";
        $statusClass = "unavailable";
    }

    // HTML-output met externe CSS-koppeling
    echo '
    <!DOCTYPE html>
    <html>
    <head>
        <link rel="stylesheet" type="text/css" href="mystyle.css">
    </head>
    <body>
        <div class="' . $statusClass . '">
            <div class="centered">' . $message . '</div>
        </div>
    </body>
    </html>
    ';
}

// URL om te controleren
$url = 'http://hoelangheeftreduxalniksgezegd.nl';

// Functie oproepen om de beschikbaarheid te controleren
checkURLAvailability($url);
?>

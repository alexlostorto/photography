<?php

// PREVENT DIRECT ACCESS
if (basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME'])) {
    // The file is being accessed directly
    http_response_code(403);
    header("Location: /photography/403/");
    exit;
}
// PREVENT DIRECT ACCESS

$name = '';
$description = '';
$privacy = '';
$cover = '';
$url = '';

$views = 0;

$imageExtensions = ['jpg', 'jpeg', 'png', 'gif'];

function sortByDigits($array) {
    usort($array, function($a, $b) {
        // Extract filenames without extensions
        $filenameA = pathinfo($a, PATHINFO_FILENAME);
        $filenameB = pathinfo($b, PATHINFO_FILENAME);

        // Use intval to convert the extracted filenames to integers
        return intval($filenameA) - intval($filenameB);
    });
    return $array;
}

function checkFileExtension($fileName, $allowedExtensions) {
    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);  // Get the file extension from the filename
    $fileExtension = strtolower($fileExtension);  // Convert to lowercase for case-insensitive comparison
    return in_array($fileExtension, $allowedExtensions);  // Check if the file extension is in the list of allowed extensions
}

function loadImages() {
    global $imageExtensions;

    $path  = dirname($_SERVER['SCRIPT_FILENAME']);
    $files = array_diff(scandir($path), array('.', '..'));
    $files = sortByDigits($files);

    for ($i=0; $i<count($files); $i++) {
        if (checkFileExtension($files[$i], $imageExtensions)) {
            echo '<div>
                <img src="' . $files[$i] . '" alt="">
            </div>';
        }
    }
}

function getAlbums() {
    try {
        // Read the JSON file
        $jsonFile = '../../gallery/data.json';
        $data = json_decode(file_get_contents($jsonFile), true);

        return $data['albums'];
    } catch (Exception $e) {
        // Handle server errors with a 500 status code
        http_response_code(500);
        echo "Server Error: An error occurred while reading the JSON file.";
        exit();
    }
}

function findAlbumByID($albums, $ID) {
    foreach ($albums as $album) {
        if ($album['id'] === $ID) {
            return $album;
        }
    }
    return null; // Return null if not found
}

function getViews($ID) {
    $apiEndpoint = 'https://alexlostorto.co.uk/counter/counter.php';

    // Data to be sent in the POST request
    $data = array(
        "increment" => "photography-$ID"
    );

    // Initialize cURL session
    $ch = curl_init($apiEndpoint);

    // Set cURL options for the POST request
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); // JSON-encode the data
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Set request headers (optional)
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json', // Specify the content type
    ));

    // Execute the POST request
    $response = curl_exec($ch);

    // Check for cURL errors
    if (curl_errno($ch)) {
        echo 'cURL error: ' . curl_error($ch);
        // Handle the error as needed
    } else {
        // Decode the JSON response
        $responseData = json_decode($response, true);

        if ($responseData === null) {
            echo 'Error decoding JSON: ' . json_last_error_msg();
            // Handle the error as needed
        } else {
            // Access the response data
            return $responseData;
        }
    }

    // Close cURL session
    curl_close($ch);
}

$album = findAlbumByID(getAlbums(), $albumID);
$views = getViews($albumID)['value'];

if ($album) {
    $name = $album['name'];
    $description = $album['description'];
    $privacy = $album['privacy'];
    $cover = $album['cover'];
    $url = $album['url'];
}

include('../../scripts/components/albumPage.php')

?>
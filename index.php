<?php
// Define the path to your JSON file
$jsonFilePath = 'players.json';

// Check if the JSON file exists
if (file_exists($jsonFilePath)) {
    // Read the existing JSON data from the file
    $jsonFileContents = file_get_contents($jsonFilePath);

    // Decode the JSON data into a PHP associative array
    $data = json_decode($jsonFileContents, true);

    // Check if guildid and room parameters are provided
    if (isset($_GET['guildid']) && isset($_GET['num'])) {
        // Get values from URL parameters (guildid and room)
        $guildId = $_GET['guildid'];
        $room = $_GET['num'];

        // Update the JSON data with the provided values
        $data[$guildId] = $room;

        // Encode the updated data as JSON
        $updatedJson = json_encode($data, JSON_PRETTY_PRINT);

        // Write the updated JSON back to the file
        if (file_put_contents($jsonFilePath, $updatedJson) !== false) {
            echo "Data updated successfully.";
        } else {
            http_response_code(500);
            echo "Error: Unable to write data to the file.";
        }
    } elseif (isset($_GET['lol'])) {
            $room = $_GET['lol'];
            $data[$room] = "0";
            $updatedJson = json_encode($data, JSON_PRETTY_PRINT);

            // Write the updated JSON back to the file
            if (file_put_contents($jsonFilePath, $updatedJson) !== false) {
                echo "Success";
            } else {
                http_response_code(500);
                echo "Error: Unable to write data to the file.";
            }
        }
    } else {
        // Display the current JSON data in raw format
        header('Content-Type: text/plain');
        echo $jsonFileContents;
    }
} else {
    http_response_code(404);
    echo "Error: JSON file not found.";
}
?>

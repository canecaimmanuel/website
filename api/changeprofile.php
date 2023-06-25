<?php

include "config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    // Check if the data array is not empty 
    if (!is_null($data)) {

        $email = isset($data['email']) ? $data['email'] : '';
        $firstname = isset($data['firstname']) ? $data['firstname'] : '';
        $lastname = isset($data['lastname']) ? $data['lastname'] : '';
        $birthdate = isset($data['birthdate']) ? $data['birthdate'] : '';

            $response = array(
                'success' => true,
                'message' => 'Your profile is updated.'
        );

    } else {
        $response = array(
            'success' => false,
            'message' => 'Invalid Input.'
        );
 
    }

    echo json_encode($response);
    
} else {
    echo "Invalid request! Only POST requests are allowed.";
}
?>
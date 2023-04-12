<?php
if (isset($_POST['api_key']) && isset($_POST['api_secret'])) {
    $api_key = $_POST['api_key'];
    $api_secret = $_POST['api_secret'];

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.umbrella.com/auth/v2/token',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/x-www-form-urlencoded',
            'Authorization: Basic ' . base64_encode($api_key . ':' . $api_secret)
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    header('Content-Type: application/json');
    echo $response;
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid request']);
}
?>
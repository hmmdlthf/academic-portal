<?php 

use Firebase\JWT\JWT;

$ROOT = $_SERVER["DOCUMENT_ROOT"];
require_once $ROOT . '/vendor/autoload.php';
require_once $ROOT . '/app/teacher/TeacherService.php';

// Validate the credentials against a database, or other data store.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = test_input($_POST["username"]);
    $password = test_input($_POST["password"]);
    $rememberMe = test_input($_POST['remember_me']);

    echo $username . "<br>";
    echo $password . "<br>";
    echo $rememberMe . "<br>";

    $teacherService = new TeacherService();
    $teacherService->verifyPassword($username, $password);
    $hasValidCredentials = true;
    echo ("correct password <br>");
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($hasValidCredentials) {
    $secretKey  = 'bGS6lzFqvvSQ8ALbOxatm7/Vk7mLQyzqaS34Q4oR1ew=';
    $tokenId    = base64_encode(random_bytes(16));
    $issuedAt   = new DateTimeImmutable();
    $expire     = $issuedAt->modify('+6 minutes')->getTimestamp();      // Add 60 seconds
    $serverName = "localhost:3000";
    $username   = $username;                                           // Retrieved from filtered POST data

    // Create the token as an array
    $data = [
        'iat'  => $issuedAt->getTimestamp(),    // Issued at: time when the token was generated
        'jti'  => $tokenId,                     // Json Token Id: an unique identifier for the token
        'iss'  => $serverName,                  // Issuer
        'nbf'  => $issuedAt->getTimestamp(),    // Not before
        'exp'  => $expire,                      // Expire
        'data' => [                             // Data related to the signer user
            'userName' => $username,            // User name
        ]
    ];

    var_dump($data);

    // Encode the array to a JWT string.
    $jwt = JWT::encode(
        $data,      //Data to be encoded in the JWT
        $secretKey, // The signing key
        'HS512'     // Algorithm used to sign the token, see https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40#section-3
    );
    echo $jwt;
    //$_COOKIE['jwt'] = $jwt;
    $cookie_name = 'jwt';
    $cookie_value = $jwt;
    setcookie($cookie_name, $cookie_value);
}
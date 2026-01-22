<?php
session_start();
require_once "library.php";
header("Content-Type: application/json");

if (!isset($_SESSION['login'])) {
    http_response_code(401);
    echo json_encode([
        'status' => false,
        'message' => 'Unauthorized'
    ]);
    exit;
}

$input = json_decode(file_get_contents("php://input"));
$data = !empty($input) ? $input : $_POST;

$action = $data['action'] ?? '';

switch ($action) {
    case 'create';
        
    break;

    case 'list';

    break;

    default;
    echo json_encode([
        'status' => false,
        'message' => 'Action Tidak Valid'
    ]);
}
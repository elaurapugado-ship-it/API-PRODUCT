<?php

header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD'];
$path = $_GET['path'] ?? 'products';

// sample data (no database)
$products = [
    1 => ["id" => 1, "product" => "Coke", "price" => 20],
    2 => ["id" => 2, "product" => "Bread", "price" => 35],
    3 => ["id" => 3, "product" => "Rice", "price" => 60]
];

switch ($method) {

    // ================= GET =================
    case "GET":

        if ($path == "products" && !isset($_GET['id'])) {
            echo json_encode(array_values($products));
        }

        elseif ($path == "products" && isset($_GET['id'])) {
            $id = $_GET['id'];

            if (isset($products[$id])) {
                echo json_encode($products[$id]);
            } else {
                echo json_encode(["message" => "Product not found"]);
            }
        }

        break;


    // ================= POST =================
    case "POST":

        $data = json_decode(file_get_contents("php://input"), true);

        echo json_encode([
            "message" => "New product created",
            "product" => $data
        ]);

        break;


    // ================= PUT =================
    case "PUT":

        $data = json_decode(file_get_contents("php://input"), true);

        echo json_encode([
            "message" => "Product updated",
            "updated_data" => $data
        ]);

        break;


    // ================= DELETE =================
    case "DELETE":

        $data = json_decode(file_get_contents("php://input"), true);

        echo json_encode([
            "message" => "Product deleted",
            "deleted_id" => $data['id']
        ]);

        break;


    default:
        echo json_encode(["message" => "Invalid request"]);
}

?>
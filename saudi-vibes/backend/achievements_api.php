<?php
require_once "config.php";
header("Content-Type: application/json");
$method = $_SERVER["REQUEST_METHOD"];
if ($method === "GET") {
    $stmt = $pdo->query("SELECT id, title, category, short_description, image_path FROM achievements ORDER BY id ASC");
    $rows = $stmt->fetchAll();
    echo json_encode($rows);
    exit;
}
$input = json_decode(file_get_contents("php://input"), true);
if (!is_array($input)) {
    $input = array();
}
if ($method === "POST") {
    $title = isset($input["title"]) ? trim($input["title"]) : "";
    $category = isset($input["category"]) ? trim($input["category"]) : "";
    $short = isset($input["short_description"]) ? trim($input["short_description"]) : "";
    $image = isset($input["image_path"]) ? trim($input["image_path"]) : "";
    if ($title === "" || $category === "" || $short === "" || $image === "") {
        http_response_code(400);
        echo json_encode(array("error" => "Missing fields."));
        exit;
    }
    $stmt = $pdo->prepare("INSERT INTO achievements (title, category, short_description, image_path, created_at) VALUES (?, ?, ?, ?, NOW())");
    $stmt->execute(array($title, $category, $short, $image));
    echo json_encode(array("id" => $pdo->lastInsertId()));
    exit;
}
if ($method === "PUT" || $method === "PATCH") {
    $id = isset($input["id"]) ? intval($input["id"]) : 0;
    if ($id <= 0) {
        http_response_code(400);
        echo json_encode(array("error" => "Invalid id."));
        exit;
    }
    $title = isset($input["title"]) ? trim($input["title"]) : "";
    $category = isset($input["category"]) ? trim($input["category"]) : "";
    $short = isset($input["short_description"]) ? trim($input["short_description"]) : "";
    $image = isset($input["image_path"]) ? trim($input["image_path"]) : "";
    $stmt = $pdo->prepare("UPDATE achievements SET title = ?, category = ?, short_description = ?, image_path = ? WHERE id = ?");
    $stmt->execute(array($title, $category, $short, $image, $id));
    echo json_encode(array("status" => "updated"));
    exit;
}
if ($method === "DELETE") {
    parse_str(parse_url($_SERVER["REQUEST_URI"], PHP_URL_QUERY), $query);
    $id = isset($query["id"]) ? intval($query["id"]) : 0;
    if ($id <= 0) {
        http_response_code(400);
        echo json_encode(array("error" => "Invalid id."));
        exit;
    }
    $stmt = $pdo->prepare("DELETE FROM achievements WHERE id = ?");
    $stmt->execute(array($id));
    echo json_encode(array("status" => "deleted"));
    exit;
}
http_response_code(405);
echo json_encode(array("error" => "Method not allowed."));
?>

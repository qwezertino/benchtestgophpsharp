<?php
header("Content-Type: application/json; charset=utf-8");

$data = json_decode(file_get_contents(__DIR__ . "/data.json"), true);

$items = array_map(function ($item) {
    return [
        "id" => $item["id"],
        "title" => $item["title"]
    ];
}, $data);

echo json_encode($items);

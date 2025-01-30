<?php

use OpenSwoole\Http\Server;
use OpenSwoole\Http\Request;  // Corrected import
use OpenSwoole\Http\Response; // Corrected import

$server = new Server("0.0.0.0", 8101);

$server->on("Start", function($server) {
    echo "OpenSwoole HTTP Server Started @ 127.0.0.1:8101\n";
});

$server->on('Request', function(Request $request, Response $response)
{
    $response->header("Content-Type", "application/json; charset=utf-8");
    $data = json_decode(file_get_contents(__DIR__ . "/data.json"), true);
    $items = array_map(function ($item) {
        return [
            "id" => $item["id"],
            "title" => $item["title"]
        ];
    }, $data);
    $response->end(json_encode($items));
    //
});

$server->start();

// $server->set([
//     'worker_num' => 4,      // The number of worker processes to start
//     'task_worker_num' => 4,  // The amount of task workers to start
//     'backlog' => 128,       // TCP backlog connection number
// ]);

// Triggered when new worker processes starts
// $server->on("WorkerStart", function($server, $workerId)
// {
//     // ...
// });

// Triggered when the HTTP Server starts, connections are accepted after this callback is executed
// Triggered when the server is shutting down
// $server->on("Shutdown", function($server, $workerId)
// {
//     // ...
// });

// // Triggered when worker processes are being stopped
// $server->on("WorkerStop", function($server, $workerId)
// {
//     // ...
// });

// function generateRandomString($length = 10) {
//     $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
//     $charactersLength = strlen($characters);
//     $randomString = '';
//     for ($i = 0; $i < $length; $i++) {
//         $randomString .= $characters[rand(0, $charactersLength - 1)];
//     }
//     return $randomString;
// }
// // Create an array of 10 elements with random 'id' and 'title'
// $array = [];
// for ($i = 0; $i < 10; $i++) {
//     $array[] = [
//         'id' => rand(1000, 9999), // Random ID between 1000 and 9999
//         'title' => generateRandomString(10) // Random string of length 10
//     ];
// }

// // Convert the array to JSON format
// $jsonData = json_encode($array, JSON_PRETTY_PRINT);

// // Specify the file where you want to save the JSON
// $file = 'data.json';

// // Write the JSON data to the file
// if (file_put_contents($file, $jsonData)) {
//     echo "Data successfully written to $file";
// } else {
//     echo "Failed to write data to $file";
// }
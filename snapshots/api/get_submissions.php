<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/global/php/functions.php");

if ($_SESSION['role']['rights'] >= 1) {
    $admin_access = true;
} else {
    $admin_access = false;
    exit;
}

$test = Database::execSimpleSelect("SELECT * FROM SnapshotSubmissions WHERE `status` = 0 ORDER BY date DESC");


header('Content-Type: application/json');

$id = 0;

foreach($test as $e){
    //print_r($e);
    //print_r($test[$id]);
    $test[$id]['username'] = GetUserFromDatabase($test[$id]['userid'])['name'];
    $id++;
}

Caching::wipeCache("snapshots_api");

echo json_encode($test);
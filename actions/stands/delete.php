<?php

$table = 'stands';
$conn = conn();
$db   = new Database($conn);

$stand = $db->single($table,[
    'id' => $_GET['id']
]);

$db->delete($table,[
    'id' => $_GET['id']
]);

set_flash_msg(['success'=>$table.' berhasil dihapus']);
header('location:'.routeTo('stands/index',['event_id'=>$stand->event_id]));
die();
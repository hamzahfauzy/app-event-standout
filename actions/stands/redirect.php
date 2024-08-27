<?php

$conn = conn();
$db   = new Database($conn);

$stand = $db->single('stands',[
    'pic_id' => $_GET['pic_id']
]);

$transaction = $db->single('transactions', ['stand_id' => $stand->id]);

header('location:'.routeTo('transactions/view',['id'=>$transaction->id]));
die();
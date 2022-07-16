<?php

$conn = conn();
$db   = new Database($conn);

$db->update('transactions',[
    'status' => 'CANCELED'
],[
    'id' => $_GET['id']
]);

set_flash_msg(['success'=>'Pembayaran berhasil di tolak']);
header('location:'.routeTo('transactions/index'));
die();
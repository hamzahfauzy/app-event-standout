<?php

$conn = conn();
$db   = new Database($conn);

$db->update('transactions',[
    'status' => 'PAID'
],[
    'id' => $_GET['id']
]);

set_flash_msg(['success'=>'Pembayaran berhasil di konfirmasi']);
header('location:'.routeTo('transactions/index'));
die();
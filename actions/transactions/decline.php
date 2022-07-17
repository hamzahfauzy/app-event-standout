<?php

$conn = conn();
$db   = new Database($conn);

$db->update('transactions',[
    'status' => 'CANCELED'
],[
    'id' => $_GET['id']
]);

$transaction = $db->single('transactions',[
    'id' => $_GET['id']
]);

$customer = $db->single('customers',['transaction_id'=>$transaction->id]);

$message = "Pembayaran untuk transaksi dengan kode invoice ".$transaction->invoice." telah di tolak";
WaBlast::send($customer->phone, $message);

set_flash_msg(['success'=>'Pembayaran berhasil di tolak']);
header('location:'.routeTo('transactions/index'));
die();
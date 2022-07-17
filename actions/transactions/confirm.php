<?php

$conn = conn();
$db   = new Database($conn);

$db->update('transactions',[
    'status' => 'PAID'
],[
    'id' => $_GET['id']
]);

$transaction = $db->single('transactions',[
    'id' => $_GET['id']
]);

$customer = $db->single('customers',['transaction_id'=>$transaction->id]);

$message = "Pembayaran untuk transaksi dengan kode invoice ".$transaction->invoice." telah di terima";
WaBlast::send($customer->phone, $message);

set_flash_msg(['success'=>'Pembayaran berhasil di konfirmasi']);
header('location:'.routeTo('transactions/index'));
die();
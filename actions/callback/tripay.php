<?php

$conn = conn();
$db   = new Database($conn);
$privateKey = config('TRIPAY_PRIVATE_KEY');
$apiKey = config('TRIPAY_API_KEY');
$tripay = new Tripay($privateKey, $apiKey);
$callback = $tripay->callback();

if($callback->status)
{
    $merchantRef = $callback->reference;
    $transaction = $db->single('transactions',['invoice'=>$merchantRef]);
    if($transaction)
    {
        $db->update('transactions',[
            'status' => $callback->status
        ],[
            'invoice' => $merchantRef
        ]);
        
        $customer = $db->single('customers',['transaction_id'=>$transaction->id]);
        
        $message = "Pembayaran untuk transaksi dengan kode invoice ".$transaction->invoice." telah di terima";
        WaBlast::send($customer->phone, $message);
        
        echo json_encode(['success' => true]);
    }
    else
    {
        echo json_encode(['success' => false]);
    }
}

die();
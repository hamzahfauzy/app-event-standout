<?php

Page::set_title('Event Detail');

$conn = conn();
$db   = new Database($conn);

$stand = $db->single('stands',[
    'id' => $_GET['id']
]);

if(request() == 'POST')
{
    $invoice = 'INV-'.$stand->id.'-'.auth()->user->id.'-'.strtotime('now');
    $db->insert('transactions',[
        'user_id' => auth()->user->id,
        'stand_id' => $stand->id,
        'invoice_code' => $invoice,
        'amount'  => $stand->price,
        'status'  => 'checkout'
    ]);

    header('location:'.routeTo('transactions/index'));
}

return compact('stand');
<?php

$conn = conn();
$db   = new Database($conn);

$user = auth()->user;

if(get_role($user->id)->name == 'user')
{
    $transaction = $db->single('transactions',[
        'id'      => $_GET['id'],
        'user_id' => $user->id,
    ],[
        'id' => 'desc'
    ]);
}
else
{
    $transaction = $db->single('transactions',[
        'id'      => $_GET['id'],
    ],[
        'id' => 'desc'
    ]);
}

$transaction->stand = $db->single('stands',['id' => $transaction->stand_id]);
$transaction->stand->event = $db->single('events',['id' => $transaction->stand->event_id]);

return compact('transaction');
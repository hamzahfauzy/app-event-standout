<?php

$conn = conn();
$db   = new Database($conn);

$user = auth()->user;
$transactions = [];

if(get_role($user->id)->name == 'user')
{
    $transactions = $db->all('transactions',[
        'user_id' => $user->id
    ],[
        'id' => 'desc'
    ]);
}
else
{
    $transactions = $db->all('transactions',[],[
        'id' => 'desc'
    ]);
}

$transactions = array_map(function($transaction) use ($db){
    $transaction->stand = $db->single('stands',['id' => $transaction->stand_id]);
    $transaction->stand->event = $db->single('events',['id' => $transaction->stand->event_id]);
    return $transaction;
}, $transactions);

return compact('transactions');
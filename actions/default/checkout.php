<?php

Page::set_title('Event Detail');

$conn = conn();
$db   = new Database($conn);
$tripay = new Tripay(config('TRIPAY_PRIVATE_KEY'), config('TRIPAY_API_KEY'));

$stand = $db->single('stands',[
    'id' => $_GET['id']
]);

$event = $db->single('events',['id' => $stand->event_id]);

if(request() == 'POST')
{
    $invoice = 'INV-'.$stand->id.'-'.auth()->user->id.'-'.strtotime('now');
    $status  = 'checkout';
    $pg_response = null;
    $checkout_url = null;

    if($_POST['pg_request']['method'] == 'tripay')
    {
        $privateKey = config('TRIPAY_PRIVATE_KEY');
        $merchantCode = config('TRIPAY_MERCHANT_CODE');
        $merchantRef = $invoice;
        
        $signature = hash_hmac('sha256', $merchantCode.$merchantRef.$stand->price, $privateKey);
        $data = [
            'method'            => $_POST['pg_request']['type'],
            'merchant_ref'      => $merchantRef,
            'amount'            => $stand->price,
            'customer_name'     => $_POST['name'],
            'customer_email'    => $_POST['email'],
            'customer_phone'    => $_POST['phone'],
            'callback_url'      => routeTo('callback/tripay'),
            'order_items'       => [
                [
                    'sku'       => $event->name,
                    'name'      => $stand->name,
                    'price'     => $stand->price,
                    'quantity'  => 1
                ]
            ],
            'signature'         => hash_hmac('sha256', $merchantCode.$merchantRef.$stand->price, $privateKey)
        ];

        $response = $tripay->checkout($data);
        if($response['success'] == false)
        {
            set_flash_msg(['error'=>'Checkout gagal']);
            header('location:'.routeTo('default/checkout',['id' => $_GET['id']]));
            die();
        }
        $response_data = $response['data'];
    
        $pg_response = [
            'status' => $response_data['status'],
            'invoice' => $invoice,
            'payment_gateway' => $_POST['pg_request']['method'],
            'payment_reference' => $response_data['reference'],
            'payment_code' => $response_data['pay_code'],
            'checkout_url' => $response_data['checkout_url'],
            'expired_time' => $response_data['expired_time'],
        ];

        $status = $response_data['success'];
        $checkout_url = $response_data['checkout_url'];
    }
    
    $transaction = $db->insert('transactions',[
        'user_id' => auth()->user->id,
        'stand_id' => $stand->id,
        'invoice_code' => $invoice,
        'amount'  => $stand->price,
        'pg_requests' => serialize($_POST['pg_request']),
        'pg_response' => $pg_response ? serialize($pg_response) : null,
        'status'  => $status
    ]);

    $db->insert('customers',[
        'transaction_id' => $transaction->id,
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'phone' => $_POST['phone'],
    ]);

    if($checkout_url == null)
    {
        header('location:'.routeTo('transactions/view',['id' => $transaction->id]));
    }
    else
    {
        header('location:'.$checkout_url);
    }
    die();
}

$channels = $tripay->getChannels();

// print_r($channels);

return compact('stand','channels');
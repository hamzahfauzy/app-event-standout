<?php

Page::set_title('Event Detail');

$conn = conn();
$db   = new Database($conn);

$event = $db->single('events',[
    'id' => $_GET['id']
]);

$stands = $db->all('stands',[
    'event_id' => $event->id
]);

$stands = array_map(function($s) use ($db){
    $s->transaction = $db->single('transactions',['stand_id'=>$s->id]);
    return $s;
}, $stands);

$pic_style = "#rec_style";
foreach($stands as $s)
{
    if($s->transaction) $pic_style .= ", #".$s->pic_id;
}

return compact('event','stands','pic_style');
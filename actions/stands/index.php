<?php

$table = 'stands';
Page::set_title(ucwords($table));
$conn = conn();
$db   = new Database($conn);
$success_msg = get_flash_msg('success');

$data = $db->all($table,[
    'event_id' => $_GET['event_id']
]);

$event = $db->single('events',[
    'id' => $_GET['event_id']
]);

$data = array_map(function($s) use ($db){
    $s->transaction = $db->single('transactions',['stand_id'=>$s->id]);
    return $s;
}, $data);

$pic_style = "#rec_style";
$sold_style = "#sold_style";
foreach($data as $d)
{
    $pic_style .= ", #".$d->pic_id;
    if($d->transaction) $sold_style .= ", #".$d->pic_id;
}

return [
    'datas' => $data,
    'event' => $event,
    'pic_style' => $pic_style,
    'sold_style' => $sold_style,
    'table' => $table,
    'success_msg' => $success_msg
];
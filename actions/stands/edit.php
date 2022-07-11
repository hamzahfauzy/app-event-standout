<?php

$table = 'stands';
Page::set_title('Edit '.ucwords($table));
$conn = conn();
$db   = new Database($conn);
$error_msg = get_flash_msg('error');
$old = get_flash_msg('old');

$data = $db->single($table,[
    'id' => $_GET['id']
]);

$event = $db->single('events',['id' => $data->event_id]);

if(request() == 'POST')
{
    if(isset($_FILES['thumb_file']) && !empty($_FILES['thumb_file']['name']))
    {
        $ext  = pathinfo($_FILES['thumb_file']['name'], PATHINFO_EXTENSION);
        $name = strtotime('now').'.'.$ext;
        $file = 'uploads/thumb_file/'.$name;
        copy($_FILES['thumb_file']['tmp_name'],$file);
        $_POST[$table]['thumb_url'] = $file;
    }

    file_put_contents($event->pic_url, $_POST['new_svg_content']);

    $edit = $db->update($table,$_POST[$table],[
        'id' => $_GET['id']
    ]);

    set_flash_msg(['success'=>$table.' berhasil diupdate']);
    header('location:'.routeTo('stands/index',['event_id'=>$edit->event_id]));
}

$pic_style = $data->pic_id;
$_data = $db->all($table);
foreach($_data as $d)
{
    $pic_style .= ", #".$d->pic_id;
}

return [
    'data' => $data,
    'error_msg' => $error_msg,
    'old' => $old,
    'table' => $table,
    'event' => $event,
    'pic_style' => $pic_style
];
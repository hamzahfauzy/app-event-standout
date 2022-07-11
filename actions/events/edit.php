<?php

$table = 'events';
Page::set_title('Edit '.ucwords($table));
$conn = conn();
$db   = new Database($conn);
$error_msg = get_flash_msg('error');
$old = get_flash_msg('old');

$data = $db->single($table,[
    'id' => $_GET['id']
]);

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
    
    if(isset($_FILES['pic_file']) && !empty($_FILES['pic_file']['name']))
    {
        $ext  = pathinfo($_FILES['pic_file']['name'], PATHINFO_EXTENSION);
        $name = strtotime('now').'.'.$ext;
        $file = 'uploads/pic_file/'.$name;
        copy($_FILES['pic_file']['tmp_name'],$file);
        $_POST[$table]['pic_url'] = $file;
    }

    $edit = $db->update($table,$_POST[$table],[
        'id' => $_GET['id']
    ]);

    set_flash_msg(['success'=>$table.' berhasil diupdate']);
    header('location:'.routeTo('stands/index',['event_id'=>$edit->id]));
}

return [
    'data' => $data,
    'error_msg' => $error_msg,
    'old' => $old,
    'table' => $table
];
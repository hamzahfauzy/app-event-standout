<?php

$table = 'events';
Page::set_title('Add '.ucwords($table));
$error_msg = get_flash_msg('error');
$old = get_flash_msg('old');

if(request() == 'POST')
{
    $conn = conn();
    $db   = new Database($conn);

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

    $insert = $db->insert($table,$_POST[$table]);

    set_flash_msg(['success'=>$table.' berhasil ditambahkan']);
    header('location:'.routeTo('stands/index',['event_id'=>$insert->id]));
}

return compact('table','error_msg','old');
<?php

$table = 'stands';
Page::set_title('Add '.ucwords($table));
$error_msg = get_flash_msg('error');
$old = get_flash_msg('old');

$conn = conn();
$db   = new Database($conn);

$event = $db->single('events',['id' => $_GET['event_id']]);

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

    $insert = $db->insert($table,$_POST[$table]);

    set_flash_msg(['success'=>$table.' berhasil ditambahkan']);
    header('location:'.routeTo('stands/index',['event_id'=>$insert->event_id]));
}

$pic_id = "stand_".md5(strtotime('now'));
$pic_style = $pic_id;
$data = $db->all($table);
foreach($data as $d)
{
    $pic_style .= ", #".$d->pic_id;
}


return compact('table','error_msg','old','event','pic_id','pic_style');
<?php

$table = 'events';
Page::set_title(ucwords($table));
$conn = conn();
$db   = new Database($conn);
$success_msg = get_flash_msg('success');

$data = $db->all($table);

return [
    'datas' => $data,
    'table' => $table,
    'success_msg' => $success_msg
];
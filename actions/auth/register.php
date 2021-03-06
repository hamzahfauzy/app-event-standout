<?php

$success_msg = get_flash_msg('success');
$error_msg = get_flash_msg('error');

if(request() == 'POST')
{
    $conn  = conn();
    $db    = new Database($conn);

    $user = $db->single('users',[
        'username' => $_POST['username'],
    ]);

    if($user)
    {
        set_flash_msg(['error'=>'Registrasi Gagal! Nama Pengguna sudah digunakan']);
        header('location:'.base_url());
        die();
    }

    $user = $db->insert('users', [
        'name' => $_POST['name'],
        'username' => $_POST['username'],
        'password' => md5($_POST['password']),
    ]);

    // assign role to user
    $db->insert('user_roles',[
        'user_id' => $user->id,
        'role_id' => 2 // user
    ]);
    
    Session::set(['user_id'=>$user->id]);
    header('location:'.base_url());
    die();
}

return [
    'success_msg' => $success_msg,
    'error_msg' => $error_msg,
];
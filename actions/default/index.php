<?php

Page::set_title('Dashboard');

$conn = conn();
$db   = new Database($conn);

$events = $db->all('events',[],[
    'id' => 'desc'
]);

return compact('events');
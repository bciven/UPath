<?php

return [


    'driver' => 'smtp',

    'host' => 'smtp.gmail.com',

    'port' => 587,

    'from' => array('address' => 'upathteam@gmail.com', 'name' => 'UPath Team'),

    'encryption' => 'tls',

    'username' => 'upathteam',

    'password' => 'VickyApt2',

    'sendmail' => '/usr/sbin/sendmail -bs',

    'pretend' => false,

];

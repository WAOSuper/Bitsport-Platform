<?php

return [
    'match_status' => [
        'empty' => 0, // revoked
        'confirmed' => 1, // empty score of both users or any one user then make revo or make winner with scored user
        'revoked' => 2, 
        'cancelled' => 3, 
        'completed' => 4, 
        'streamSetUpDone' => 5, // revoked
        'pending' => 6, // make score user  as winner
        'expired' => 7, // revoked
        'ScreenSetUpPassed' => 8,
        'drawMatch' => 9,
    ],

    'match_status_name' => [
        0 => 'Empty',
        1 => 'Confirmed',
        2 => 'Revoked',
        3 => 'Cancelled', 
        4 => 'Completed', 
        5 => 'Stream setup done', 
        6 => 'Pending',
        7 => 'Expired', 
        8 => 'Screen setup passed',
        9 => 'Draw Match',
    ],
]

?>
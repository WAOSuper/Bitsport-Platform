<?php

return [
    'status' => [
        'pending' => 0,
        'confirmed' => 1,
        'rejected' => 2,
        'cancelled' => 3,
        'approval' => 4,
        'completed' => 5,
        'dispute' => 6,

    ],
    'status_name' => [
        0 => 'Pending',
        1 => 'Confirmed',
        2 => 'Rejected',
        3 => 'Cancelled',
        4 => 'Pending Approval',
        5 => 'Completed',
        6 => 'Disputed',
    ],
    'winning' => [
        0 => 'lost',
        1 => 'won',
        2 => 'draw'
    ],
    'experience' => [
        0 => 'good',
        1 => 'neutral',
        2 => 'bad'
    ],
    'skill_rating' => [
        '' => 'Select',
        1 => 'One',
        2 => 'Two',
        3 => 'Three',
        4 => 'Four',
        5 => 'Five'
    ],
    'admin_profit_percentage' => '10',
];

<?php
use App\Student;
use App\Professor;

return [ 
    Student::class => [
        [
            'id' => 1,
            'first_name' => 'sandeep',
            'middle_name' => 'k',
            'last_name' => 'choudary',
            'guardian_name' => 'knr',
            'gender' => 'Male',
            'dob' => '2015-09-06',
            'contact_number' => 8167455196,
           'address' => '7493 Legros Burg Considinefort, NH 24537'
        ],
    ],
    Professor::class => [
        [
            'id' => 1,
            'first_name' => 'himansh',
            'middle_name' => 's',
            'last_name' => 'chou',
            'email' => 'venu1234@gmail.in',
            'gender' => 'Male',
            'dob' => '2016-09-06',
            'phone_number' => 9177373332,
           'address' => 'Chennai, India'
        ],
    ]
];
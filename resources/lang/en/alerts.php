<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Alert Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain alert messages for various scenarios
    | during CRUD operations. You are free to modify these language lines
    | according to your application's requirements.
    |
    */

    'backend' => [
        'roles' => [
            'created' => 'The role was successfully created.',
            'deleted' => 'The role was successfully deleted.',
            'updated' => 'The role was successfully updated.',
        ],

        'users' => [
            'code'=>'The code has already been taken.',
            'national_number'=>'The national number has already been taken.',
            'password_current' => 'The current password field does not match your password',
            'request_send' => 'Your Request Send Successfully',
            'edit_request_delete' => 'Edit Request Deleted Successfully',
            'cant_resend_confirmation' => 'The application is currently set to manually approve users.',
            'confirmation_email' => 'A new confirmation e-mail has been sent to the address on file.',
            'confirmed' => 'The user was successfully confirmed.',
            'created' => 'The user was successfully created.',
            'deleted' => 'The user was successfully deleted.',
            'deleted_permanently' => 'The user was deleted permanently.',
            'restored' => 'The user was successfully restored.',
            'session_cleared' => "The user's session was successfully cleared.",
            'social_deleted' => 'Social Account Successfully Removed',
            'unconfirmed' => 'The user was successfully un-confirmed',
            'updated' => 'The user was successfully updated.',
            'updated_password' => "The user's password was successfully updated.",
        ],
        'student-request' => [
            'forward' => 'Request Forward',

        ],
        'profile' => [
            'updated' => 'Profile successfully updated.',
            'password' => 'Password successfully updated.',
        ],
        'section' => [
            'created' => 'The Section was successfully created.',
            'deleted' => 'The Section was successfully deleted.',
            'updated' => 'The Section was successfully updated.',
        ],
        'procedure-type' => [
            'created' => 'The Type was successfully created.',
            'deleted' => 'The Type was successfully deleted.',
            'updated' => 'The Type was successfully updated.',
        ],
        'posts' => [
            'created' => 'The Post was successfully created.',
            'deleted' => 'The Post was successfully deleted.',
            'updated' => 'The Post was successfully updated.',
        ],
        'hrd' => [
            'created' => 'The hrd was successfully created.',
            'deleted' => 'The hrd was successfully deleted.',
            'updated' => 'The hrd was successfully updated.',
        ],
        'question' => [
            'created' => 'The question was successfully created.',
            'deleted' => 'The question was successfully deleted.',
            'updated' => 'The question was successfully updated.',
        ],

        'group' => [
            'created' => 'The group was successfully created.',
            'deleted' => 'The group was successfully deleted.',
            'updated' => 'The group was successfully updated.',
            'validate_time'=>'The start time must be before the end time'
        ],

        'about' => [
            'updated' => 'The about LAC was successfully updated.',
        ],


    ],

    'frontend' => [
        'contact' => [
            'sent' => 'Your information was successfully sent. We will respond back to the e-mail provided as soon as we can.',
        ],
    ],
];

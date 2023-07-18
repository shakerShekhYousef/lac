<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Menus Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in menu items throughout the system.
    | Regardless where it is placed, a menu item can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'backend' => [
        'access' => [
            'title' => 'Access',
            'lang'=>'languages',

            'roles' => [
                'all' => 'All Roles',
                'create' => 'Create Role',
                'edit' => 'Edit Role',
                'management' => 'Role Management',
                'main' => 'Roles',
            ],
            'requests' => [
                'main' => 'Requests',
                'update' => 'Request for change user\'s information',
                'password' => 'Request for change user\'s password',
                'groups' =>  'Request for change user\'s groups',
            ],
            'chatRequests'=>[
                'main'=>'Chat Requests'
            ],


            'users' => [
                'all' => 'All Users',
                'change-password' => 'Change Password',
                'management'=>'User management',
                'create' => 'Create User',
                'deleted' => 'Deleted Users',
                'edit' => 'Edit User',
                'main' => 'Users',
                'view' => 'View User',
                'profile'=>'User profile',
                'logout'=>'Logout'
            ],
        ],

        'last-news' => [
            'main' => 'Last News',
            'all'=>'All News',
            'create'=>'Create New Post',
        ],

        'sidebar' => [
            'dashboard' => 'Dashboard',
            'general' => 'General',
            'history' => 'History',
            'system' => 'System',
        ],

        'sections' => [
            'main' => 'Sections',
            'all'=>'All Sections',
            'create'=>'Create New Section'
        ],


        'hrd' => [
            'main'=>'HRD',
            'all'=>'All Hrd Content',
            'create'=>'Create New Hrd',
        ],

        'student-requests' => [
            'all' => 'All Requests',
            'types'=>'Procedure Types',
            'main'=>'Student Requests',
        ],

        'chat' => [
            'main'=>'Chat',
            'all'=>'All Rooms',
            'messages'=>'Messages',
            'room'=>'Create New Room'
        ],

        'about' => [
            'main' => 'About LAC',
        ],
        'faq' => [
            'main' => 'FAQ',
        ],
    ],

    'language-picker' => [
        'language' => 'Language',
        /*
         * Add the new language to this array.
         * The key should have the same language code as the folder name.
         * The string should be: 'Language-name-in-your-own-language (Language-name-in-English)'.
         * Be sure to add the new language in alphabetical order.
         */
        'langs' => [
            'ar' => 'Arabic',
            'zh' => 'Chinese Simplified',
            'zh-TW' => 'Chinese Traditional',
            'da' => 'Danish',
            'de' => 'German',
            'el' => 'Greek',
            'en' => 'English',
            'es' => 'Spanish',
            'fa' => 'Persian',
            'fr' => 'French',
            'he' => 'Hebrew',
            'id' => 'Indonesian',
            'it' => 'Italian',
            'ja' => 'Japanese',
            'nl' => 'Dutch',
            'no' => 'Norwegian',
            'pt_BR' => 'Brazilian Portuguese',
            'ru' => 'Russian',
            'sv' => 'Swedish',
            'th' => 'Thai',
            'tr' => 'Turkish',
            'uk' => 'Ukrainian',
        ],
    ],
];

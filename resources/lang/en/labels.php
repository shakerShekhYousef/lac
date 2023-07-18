<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Labels Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in labels throughout the system.
    | Regardless where it is placed, a label can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'general' => [
        'all' => 'All',
        'yes' => 'Yes',
        'no' => 'No',
        'copyright' => 'Copyright',
        'custom' => 'Custom',
        'actions' => 'Actions',
        'active' => 'Active',
        'welcome'=>'Welcome',
        'buttons' => [
            'save' => 'Save',
            'update' => 'Update',
        ],
        'arabic-name' => 'Arabic Name',
        'english-name' => 'English Name',
        'create-date' => 'Creation Date',
        'hide' => 'Hide',
        'inactive' => 'Inactive',
        'none' => 'None',
        'show' => 'Show',
        'toggle_navigation' => 'Toggle Navigation',
        'create_new' => 'Create New',
        'toolbar_btn_groups' => 'Toolbar with button groups',
        'more' => 'More',
    ],

    'backend' => [
        'access' => [
            'roles' => [
                'create' => 'Create Role',
                'edit' => 'Edit Role',
                'management' => 'Role Management',
                'role-information' => 'Role Information',
                'choose' => 'Choose Role',

                'table' => [
                    'number_of_users' => 'Number of Users',
                    'permissions' => 'Permissions',
                    'role' => 'Role',
                    'sort' => 'Sort',
                    'total' => 'role total|roles total',
                ],
            ],
            'chatRequest'=>[
                'requests'=>'Chat Requests',
                'sender'=>'Sender'
            ],
            'students'=>[
                'main'=>'Students',
            ],
            'messages'=>[
                'main'=>'Messages',
            ],
            'activates'=>[
                'main'=>'Reports',
                'student'=>'Student',
                'count_login'=>'Number of times a login',
                'count_messages'=>'Number of messages sent'
            ],
            'users' => [
                'main' => 'Users',
                'active' => 'Active Users',
                'show' => 'Show User',
                'all_permissions' => 'All Permissions',
                'change_password' => 'Change Password',
                'change_password_for' => 'Change Password for :user',
                'create' => 'Create User',
                'deactivated' => 'Deactivated Users',
                'deleted' => 'Deleted Users',
                'edit' => 'Edit User',
                'user-information' => 'User Information',
                'management' => 'User Management',
                'no_permissions' => 'No Permissions',
                'no_roles' => 'No Roles to set.',
                'permissions' => 'Permissions',
                'user_actions' => 'User Actions',
                'add-group' => 'Add To Group',
                'update-group' => 'Update User Group',
                'choose-group' => 'Choose Group',
                'password_change'=>'This user has a request to change the password',

                'table' => [
                    'confirmed' => 'Confirmed',
                    'created' => 'Created',
                    'email' => 'E-mail',
                    'id' => 'ID',
                    'last_updated' => 'Last Updated',
                    'name' => 'Name',
                    'first_name' => 'First Name',
                    'last_name' => 'Last Name',
                    'no_deactivated' => 'No Deactivated Users',
                    'no_deleted' => 'No Deleted Users',
                    'other_permissions' => 'Other Permissions',
                    'permissions' => 'Permissions',
                    'abilities' => 'Abilities',
                    'roles' => 'Roles',
                    'social' => 'Social',
                    'phone' => 'Phone Number',
                    'total_points' => 'Points Owned',
                    'location' => 'Location',
                    'total' => 'user total|users total',
                ],

                'tabs' => [
                    'titles' => [
                        'overview' => 'Overview',
                        'history' => 'History',
                    ],

                    'content' => [
                        'overview' => [
                            'avatar' => 'Avatar',
                            'confirmed' => 'Confirmed',
                            'created_at' => 'Created At',
                            'deleted_at' => 'Deleted At',
                            'email' => 'E-mail',
                            'last_login_at' => 'Last Login At',
                            'last_login_ip' => 'Last Login IP',
                            'last_updated' => 'Last Updated',
                            'name' => 'Name',
                            'first_name' => 'First Name',
                            'last_name' => 'Last Name',
                            'status' => 'Status',
                            'total_points' => 'Total Points',
                            'location' => 'Location',
                            'timezone' => 'Timezone',
                        ],
                    ],
                ],

                'view' => 'View User',
            ],
            'last-news' => [
                'main' => 'last News',
                'create' => 'Create new post',
                'edit' => 'Edit post',
                'show' => 'Show post',
                'post-information' => 'Post information',
                'image' => 'Image',
                'content' => 'Content',
                'arabic-content' => 'Arabic Content',
                'title' => 'Title',
                'arabic-title' => 'Arabic Title',
                'create-date' => 'Creation Date',

            ],
            'edit-requests' => [
                'show' => 'Show Edit Request'
            ],
            'sections' => [
                'main' => 'Sections',
                'management' => 'Sections management',
                'image' => 'Image',
                'arabic-name' => 'Arabic Name',
                'name' => 'Name',
                'create-date' => 'Creation Date',
                'section-information' => 'Section Information',
                'translate' => 'Translate',
                'translate-arabic' => 'Arabic Translate',
                'conversation' => 'Conversation',
                'conversation-arabic' => 'Arabic Conversation',
                'create' => 'Create New Section',
                'edit' => 'Edit Section',
                'show' => 'Show Section'
            ],
            'hrd' => [
                'main' => 'HRD',
                'arabic-name' => 'Arabic Name',
                'name' => 'Name',
                'create-date' => 'Creation Date',
                'hrd-information' => 'HRD information',
                'description' => 'Content',
                'description-arabic' => 'Arabic Content',
                'create' => 'Create New HRD',
                'edit' => 'Edit HRD',
                'show' => 'Show HRD'
            ],
            'procedure-type' => [
                'main' => 'Procedure Types',
                'arabic-name' => 'Arabic Name',
                'name' => 'Name',
                'create-date' => 'Creation Date',
                'type-information' => 'Procedure Type information',
                'create' => 'Create New Type',
                'edit' => 'Edit Type',
                'show' => 'Show Type'
            ],
            'student-request' => [
                'main' => 'Student Requests',
                'student' => 'Student',
                'type' => 'Procedure Type',
                'type_ar'=>'Procedure Type Arabic',
                'reason' => 'Reason',
                'forward_to' => 'Forward To',
                'forward'=>'Has been forward',
                'not_forward'=>'Not forward yet',
                'create-date' => 'Creation Date',
                'show' => 'Show Request'
            ],
            'groups' => [
                'main' => 'Groups',
                'name' => 'Group Name',
                'code' => 'Code',
                'level' => 'Level',
                'days' => 'Days',
                'times' => 'Times',
                'group-information'=>'Group Information',
                'create-date' => 'Creation Date',
                'last-update' => 'Last Update',
                'create' => 'Create New Group',
                'edit' => 'Edit Group',
                'show' => 'Show Group',
                'status' => 'Status'

            ],
            'about' => [
                'main' => 'About LAC',
                'edit' => 'Edit Information',
                'description' => 'Content',
                'description-arabic' => 'Arabic Content',
            ],
            'faq' => [
                'main' => 'FAQ',
                'question'=>'Question',
                'arabic-question'=>'Arabic Question',
                'answer'=>'Answer',
                'create-date' => 'Creation Date',
                'arabic-answer'=>'Arabic Answer',
                'create'=>'Create New Question',
                'edit'=>'Edit Question',
                'show'=>'Show Question',

            ],
        ],
        'locations' => [
            'create' => 'Create Location',
            'view' => 'View Location',
            'edit' => 'Edit Location',
            'management' => 'Location Management',

            'table' => [
                'location' => 'Location',
                'total' => 'Location total|Locations total',
            ],
            'tabs' => [
                'titles' => [
                    'overview' => 'Overview',
                    'history' => 'History',
                ],

                'content' => [
                    'overview' => [
                        'location' => 'Location',
                        'created_at' => 'Created At',
                        'last_updated' => 'Last Updated',
                    ],
                ],
            ],
        ],
        'symptoms' => [
            'create' => 'Create Symptom',
            'view' => 'View Symptom',
            'edit' => 'Edit Symptom',
            'management' => 'Symptoms Management',

            'table' => [
                'name' => 'Symptom Name',
                'ar_name' => 'Symptom Arabic Name',
                'icon' => 'Symptom icon',

                'total' => 'Category total|Categories total',
            ],
            'tabs' => [
                'titles' => [
                    'overview' => 'Overview',
                    'history' => 'History',
                ],

                'content' => [
                    'overview' => [
                        'name' => 'Symptom Name',
                        'ar_name' => 'Symptom Arabic Name',
                        'icon' => 'Symptom icon',
                        'created_at' => 'Created At',
                        'last_updated' => 'Last Updated',
                    ],
                ],
            ],
        ],

        'moods' => [
            'create' => 'Create Mood',
            'view' => 'View Mood',
            'edit' => 'Edit Mood',
            'management' => 'Moods Management',

            'table' => [
                'name' => 'Mood Name',
                'ar_name' => 'Mood Arabic Name',
                'icon' => 'Mood icon',

                'total' => 'Category total|Categories total',
            ],
            'tabs' => [
                'titles' => [
                    'overview' => 'Overview',
                    'history' => 'History',
                ],

                'content' => [
                    'overview' => [
                        'name' => 'Mood Name',
                        'ar_name' => 'Mood Arabic Name',
                        'icon' => 'Mood icon',
                        'created_at' => 'Created At',
                        'last_updated' => 'Last Updated',
                    ],
                ],
            ],
        ],

        'notifications' => [
            'create' => 'Create NotificationListener',
            'view' => 'View NotificationListener',
            'edit' => 'Edit NotificationListener',
            'management' => 'Notifications Management',

            'table' => [
                'title' => 'NotificationListener title',
                'text' => 'NotificationListener text',
                'image' => 'NotificationListener Image',
                'total' => 'NotificationListener total|Notifications total',
            ],
            'tabs' => [
                'titles' => [
                    'overview' => 'Overview',
                    'history' => 'History',
                ],

                'content' => [
                    'overview' => [
                        'title' => 'NotificationListener title',
                        'text' => 'NotificationListener text',
                        'created_at' => 'Created At',
                        'last_updated' => 'Last Updated',
                    ],
                ],
            ],
        ],

        'posts' => [
            'create' => 'Create Post',
            'view' => 'View Post',
            'edit' => 'Edit Post',
            'management' => 'Posts Management',

            'table' => [
                'title' => 'Post title',
                'body' => 'Post body',
                'image' => 'post Image',
                'total' => 'Post total|Posts total',
            ],
            'tabs' => [
                'titles' => [
                    'overview' => 'Overview',
                    'history' => 'History',
                ],

                'content' => [
                    'overview' => [
                        'title' => 'Post title',
                        'body' => 'Post body',
                        'created_at' => 'Created At',
                        'last_updated' => 'Last Updated',
                    ],
                ],
            ],
        ],

        'services' => [
            'create' => 'Create Service',
            'view' => 'View Service',
            'edit' => 'Edit Service',
            'management' => 'Services Management',

            'table' => [
                'title' => 'Service title',
                'body' => 'Service body',
                'image' => 'Service Image',
                'total' => 'Service total|Services total',
            ],
            'tabs' => [
                'titles' => [
                    'overview' => 'Overview',
                    'history' => 'History',
                ],

                'content' => [
                    'overview' => [
                        'title' => 'Post title',
                        'body' => 'Post body',
                        'created_at' => 'Created At',
                        'last_updated' => 'Last Updated',
                    ],
                ],
            ],
        ],

        'appointments' => [
            'create' => 'Create Appointment',
            'view' => 'View Appointment',
            'edit' => 'Edit Appointment',
            'management' => 'Appointments Management',

            'table' => [
                'appointment_date' => 'Appointment date',
                'user_id' => 'Appointment user',
                'email' => 'Appointment user email',
                'phone' => 'Appointment user phone',
                'details' => 'Appointment Details',
                'total' => 'Appointment total|Appointments total',
            ],
            'tabs' => [
                'titles' => [
                    'overview' => 'Overview',
                    'history' => 'History',
                ],

                'content' => [
                    'overview' => [
                        'appointment_date' => 'Appointment date',
                        'user_id' => 'Appointment user',
                        'details' => 'Appointment Details',
                        'created_at' => 'Created At',
                        'last_updated' => 'Last Updated',
                    ],
                ],
            ],
        ],

        'rates' => [
            'create' => 'Create Rate',
            'view' => 'View Rate',
            'edit' => 'Edit Rate',
            'management' => 'Rates Management',

            'table' => [

                'user_id' => ' Username',
                'email' => 'Rate user email',
                'phone' => 'Rate user phone',
                'text' => 'Rate Details',
                'rate' => 'Rate Value',
                'total' => 'Rate total|Rates total',
            ],
            'tabs' => [
                'titles' => [
                    'overview' => 'Overview',
                    'history' => 'History',
                ],

                'content' => [
                    'overview' => [
                        'appointment_date' => 'Appointment date',
                        'user_id' => 'Appointment user',
                        'details' => 'Appointment Details',
                        'created_at' => 'Created At',
                        'last_updated' => 'Last Updated',
                    ],
                ],
            ],
        ],

        'texts' => [
            'create' => 'Create Text',
            'view' => 'View Text',
            'edit' => 'Edit About',
            'management' => ' About/Contact Management',


        ],
        'notes' => [
            'create' => 'Create Note',
            'view' => 'View Note',
            'edit' => 'Edit Note',
            'management' => 'Notes Management',

            'table' => [
                'details' => 'Details ',
                'flow_rate' => 'Flow Rate',
                'temperature' => 'Temperature',
                'pill' => 'Pill',
                'moods' => ' Moods',
                'symptoms' => 'Symptoms',
                'weight' => 'Weight',
                'mucus' => 'Mucus',
                'love' => 'Love ',
                'user_id' => 'Username',
                'calendar_date' => 'Calendar Date',
                'total' => 'Note total|Notes total',
            ],
            'tabs' => [
                'titles' => [
                    'overview' => 'Overview',
                    'history' => 'History',
                ],

                'content' => [
                    'overview' => [
                        'detials' => 'Details ',
                        'flow_rate' => 'Flow Rate',
                        'temperature' => 'Temperature',
                        'pill' => 'Pill',
                        'moods' => ' Moods',
                        'symptoms' => 'Symptoms',
                        'weight' => 'Weight',
                        'love' => 'Love ',
                        'mucus' => 'Mucus',
                        'user_id' => 'Username',
                        'calendar_date' => 'Calendar Date',
                        'created_at' => 'Created At',
                        'last_updated' => 'Last Updated',
                    ],
                ],
            ],
        ],


    ],

    'frontend' => [
        'auth' => [
            'login_box_title' => 'Login',
            'login_button' => 'Login',
            'login_with' => 'Login with :social_media',
            'register_box_title' => 'Register',
            'register_button' => 'Register',
            'remember_me' => 'Remember Me',
        ],

        'contact' => [
            'box_title' => 'Contact Us',
            'button' => 'Send Information',
        ],

        'passwords' => [
            'expired_password_box_title' => 'Your password has expired.',
            'forgot_password' => 'Forgot Your Password?',
            'reset_password_box_title' => 'Reset Password',
            'reset_password_button' => 'Reset Password',
            'update_password_button' => 'Update Password',
            'send_password_reset_link_button' => 'Send Password Reset Link',
        ],

        'user' => [
            'passwords' => [
                'change' => 'Change Password',
            ],

            'profile' => [
                'avatar' => 'Avatar',
                'old_avatar'=>'Old Avatar',
                'created_at' => 'Created At',
                'edit_information' => 'Edit Information',
                'email' => 'E-mail',
                'last_updated' => 'Last Updated',
                'name' => 'Name',
                'first_name' => 'First Name',
                'last_name' => 'Last Name',
                'code' => 'Code',
                'status' => "Status",
                'national' => 'National Number',
                'has-changes' => 'Has Changes',
                'update_information' => 'Update Information',
                'password' => 'Password',
                'image' => 'User Image',
                'current' => 'Current Password',
                'confirm' => 'Confirm Password'
            ],
        ],
    ],
];

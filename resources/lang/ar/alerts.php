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
            'created' => 'لقد تم إضافة الدور الجديد بنجاح.',
            'deleted' => 'لقد تم مسح الدور بنجاح.',
            'updated' => 'تم تعديل الدور بنجاح.',
        ],

        'users' => [
            'code'=>'الكود مأخوذ مسبقاً.',
            'national_number'=>'الرقم الوطني مأخوذ مسبقاً.',
            'password_current'=>'كلمة المرور التي أخلتها لا تتطابق مع مع كلمة مرورك.',
            'request_send'=>'تم ارسال طلبك بنجاح.',
            'edit_request_delete'=>'لقد تم حذف طلب التعديل بنجاح.',
            'cant_resend_confirmation' => 'The application is currently set to manually approve users.',
            'confirmation_email' => 'لقد تم إرسال رسالة تأكيد جديدة إلى عنوان البريد الألكتروني الموجود في الملف الشخصي.',
            'confirmed' => 'The user was successfully confirmed.',
            'created' => 'لقد تم إنشاء المستخدم الجديد بنجاح.',
            'deleted' => 'لقد تم إزالة المستخدم بنجاح.',
            'deleted_permanently' => 'لقد تم حذف المستخدم نهائيا بنجاح.',
            'restored' => 'لقد تمت استعادة المستخدم بنجاح.',
            'session_cleared' => "The user's session was successfully cleared.",
            'social_deleted' => 'Social Account Successfully Removed',
            'unconfirmed' => 'The user was successfully un-confirmed',
            'updated' => 'لقد تم تعديل المستخدم بنجاح.',
            'updated_password' => 'لقد تم تعديل كلمة مرور المستخدم بنجاح.',
        ],
        'student-request'=>[
            'forward'=>'تم تحويل الطلب',
            'success'=>'تمت العملية بنجاح'
        ],
        'profile'=>[
            'updated'=>'.تم تحديث الملف الشخصي بنجاح',
            'password'=>'.تم تحديث كلمة المرور بنجاح',

        ],
        'section' => [
            'created' => 'لقد تم إضافة قسم بنجاح.',
            'updated' => 'لقد تم تعديل القسم بنجاح.',
            'deleted' => 'لقد تم إزالة القسم بنجاح.',
        ],
        'procedure-type' => [
            'created' => 'لقد تم إضافة نوع بنجاح.',
            'updated' => 'لقد تم تعديل النوع بنجاح.',
            'deleted' => 'لقد تم إزالة النوع بنجاح.',
        ],

        'hrd' => [
            'created' => 'لقد تم إضافة hrd بنجاح.',
            'updated' => 'لقد تم تعديل hrd بنجاح.',
            'deleted' => 'لقد تم إزالة hrd بنجاح.',
        ],

        'posts' => [
            'created' => 'لقد تم إضافة الخدمة بنجاح.',
            'updated' => 'لقد تم تعديل الخدمة بنجاح.',
            'deleted' => 'لقد تم إزالة الخدمة بنجاح.',
        ],
        'question' => [
            'created' => 'لقد تم إضافة السؤال بنجاح.',
            'updated' => 'لقد تم تعديل السؤال بنجاح.',
            'deleted' => 'لقد تم إزالة السؤال بنجاح.',
        ],

        'group' => [
            'created' => 'لقد تم إضافة الحاضنة بنجاح.',
            'updated' => 'لقد تم تعديل لحاضنة بنجاح.',
            'deleted' => 'لقد تم إزالة لحاضنة بنجاح.',
            'validate_time'=>'يجب ان يكون وقت البدء قبل وقت الانتهاء.'
        ],
        'about' => [

            'updated' => 'لقد تم تعديل حول لغة العصر بنجاح.',

        ],

        'notifications' => [
            'created' => 'لقد تم إضافة الاشعار بنجاح.',
            'updated' => 'لقد تم تعديل الاشعار بنجاح.',
            'deleted' => 'لقد تم إزالة الاشعار بنجاح.',
        ],
    ],

    'frontend' => [
        'contact' => [
            'sent' => 'Your information was successfully sent. We will respond back to the e-mail provided as soon as we can.',
        ],
    ],
];

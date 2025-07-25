<?php

return [
    'admins' => [
        'create' => [
            'form' => [
                'confirm_password' => 'تاكيد كلمة المرور',
                'email' => 'البريد الالكتروني',
                'general' => 'بيانات عامة',
                'image' => 'الصورة الشخصية',
                'info' => 'البيانات',
                'mobile' => 'الهاتف',
                'name' => 'الاسم',
                'password' => 'كلمة المرور',
                'roles' => 'الادوار',
            ],
            'title' => 'اضافة المدراء',
        ],
        'datatable' => [
            'created_at' => 'تاريخ الآنشاء',
            'date_range' => 'البحث بالتواريخ',
            'email' => 'البريد الالكتروني',
            'image' => 'الصورة الشخصية',
            'mobile' => 'الهاتف',
            'name' => 'الاسم',
            'options' => 'الخيارات',
        ],
        'index' => [
            'title' => 'المدراء',
        ],
        'update' => [
            'form' => [
                'confirm_password' => 'تآكيد كلمة المرور',
                'email' => 'البريد الالكتروني',
                'general' => 'بيانات عامة',
                'image' => 'الصورة الشخصية',
                'mobile' => 'الهاتف',
                'name' => 'الاسم',
                'password' => 'تغير كلمة المرور',
                'roles' => 'الادوار',
            ],
            'title' => 'تعديل المدراء',
        ],
        'validation' => [
            'email' => [
                'required' => 'من فضلك ادخل البريد الالكتروني',
                'unique' => 'هذا البريد تم ادخالة من قبل',
            ],
            'mobile' => [
                'digits_between' => 'من فضلك ادخل ٨ ارقام فقط داخل رقم الهاتف',
                'numeric' => 'يجب ان يتكون رقم الهاتف من ارقام فقط بالانجليزية',
                'required' => 'من فضلك ادخل رقم الهاتف',
                'unique' => 'رقم الهاتف تم ادخالة من قبل',
            ],
            'name' => [
                'required' => 'من فضلك ادخل الاسم الشخصي',
            ],
            'password' => [
                'min' => 'يجب ان يتكون كلمة المرور من كلمة اكبر من ٦ مدخلات : ارقام او احرف',
                'required' => 'من فضلك ادخل كلمة المرور',
                'same' => 'كلمة المرور غير متطابقة مع التآكيد',
            ],
            'roles' => [
                'required' => 'من فضلك اختر ادوار المدير',
            ],
        ],
    ],
    'clients' => [
        'datatable' => [
            'created_at' => 'تاريخ الآنشاء',
            'date_range' => 'البحث بالتواريخ',
            'options' => 'الخيارات',
            'status' => 'الحالة',
            'name' => 'الإسم',
            'phone' => 'رقم الهاتف',
            'email' => 'البريد الإلكتروني',
            'state' => 'المنطقة',
            'cars' => 'عدد السيارات',
            'last_login' => 'أخر ظهور',
            'not_defined' => 'غير معروف',
            'national_ID' => 'الرقم المدني',
            'is_judging' => 'حالة القضاء',
        ],
        'form' => [
            'status' => 'الحالة',
            'restore' => 'إسترجاع',
            'tabs' => [
                'general' => 'بيانات عامة',
                'address' => 'العنوان',
                'attachment' => 'الملفات',
                'phones' => 'أرقام الهاتف',
            ],
            'name' => 'الإسم',
            'email' => 'البريد الإلكتروني',
            'states' => 'المنطقة',
            'password' => 'كلمة المرور',
            'password_confirmation' => 'تأكيد كلمة المرور',
            'phone' => 'رقم الهاتف',
            'national_ID' => 'الرقم المدني',
            'add_other_phone' => 'إضافة رقم أخر',
            'zone' => 'القطعة',
            'street' => 'العنوان',
            'national_id_photo' => 'صورة البطاقة',
            'contract_photo' => 'صورة العقد بعد التوقيع',
            'other_attachments' => 'مرفقات أخري',
            'nationality_id' => 'الجنسية',
            'is_judging' => 'حالة القضاء',
            'phone_code' => 'الكود',
        ],
        'routes' => [
            'create' => 'اضافة المستخدمين',
            'index' => 'المستخدمين',
            'update' => 'تعديل مستخدم',
        ],
        'actions' => [
            'update' => 'تعديل ',
            'delete' => 'حذف ',
            'show' => 'عرض ',
            'send_notification' => 'إرسال إشعار',
            'devices' => 'الأجهزة المسجل بها',
            'case_action' => 'الحالات القضائية',
        ],
        'validation' => [
            'client_id' => [
                'exists' => 'هذا العميل محال للقضاء'
            ],
        ],
    ],
];

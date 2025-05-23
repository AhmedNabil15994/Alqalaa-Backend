<?php

return [
    'case-actions' => [
        'form'  => [
            'description'       => 'التفاصيل',
            'restore'           => 'استرجاع من الحذف',
            'meta_description'  => 'Meta Description',
            'meta_keywords'     => 'Meta Keywords',
            'client_id' => 'العميل',
            'indebtedness' => 'التكاليف',
            'paid' => 'تم دفع التكاليف',
            'type'              => 'في تذيل الصفحة',
            'tabs'  => [
              'general'   => 'بيانات عامة',
              'seo'               => 'SEO',
            ],
        ],
        'routes'    => [
          'create'  => 'اضافة الحالات القضائية',
          'index'   => 'الحالات القضائية',
          'update'  => 'تعديل الحالة القضائية',
        ],
        'datatable' => [
            'created_at'    => 'تاريخ الآنشاء',
            'date_range'    => 'البحث بالتواريخ',
            'options'       => 'الخيارات',
            'status'        => 'الحالة',
            'client' => 'العميل',
            'description' => 'تفاصيل الحالة القضائية',
            'indebtednes' => 'التكلفة',
            'not_added' => 'لا يوجد',
        ],
    ],
];

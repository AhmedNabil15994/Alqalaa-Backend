<?php

namespace Modules\Authorization\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Authorization\Entities\Permission;

class PermissionsSeederTableSeeder extends Seeder
{

    private $permissions = [
        'dashboard_access' => [
            'routes' => '',
            'category' => 'access',
            'title_en' => 'Dashboard access',
            'title_ar' => 'عرض لوحة التحكم',
        ],
        'show_statistics' => [
            'routes' => 'dashboard.chart',
            'category' => 'access',
            'title_en' => 'Show Statistics',
            'title_ar' => 'عرض الإحصائيات',
        ],
        'show_roles' => [
            'routes' => '',
            'category' => 'roles',
            'title_en' => 'Show',
            'title_ar' => 'عرض',
        ],
        'add_roles' => [
            'routes' => '',
            'category' => 'roles',
            'title_en' => 'Add',
            'title_ar' => 'إضافة',
        ],
        'edit_roles' => [
            'routes' => '',
            'category' => 'roles',
            'title_en' => 'Edit',
            'title_ar' => 'تعديل',
        ],
        'delete_roles' => [
            'routes' => '',
            'category' => 'roles',
            'title_en' => 'Delete',
            'title_ar' => 'حذف',
        ],
        'show_admins' => [
            'routes' => '',
            'category' => 'admins',
            'title_en' => 'Show',
            'title_ar' => 'عرض',
        ],
        'add_admins' => [
            'routes' => '',
            'category' => 'admins',
            'title_en' => 'Add',
            'title_ar' => 'إضافة',
        ],
        'edit_admins' => [
            'routes' => '',
            'category' => 'admins',
            'title_en' => 'Edit',
            'title_ar' => 'تعديل',
        ],
        'delete_admins' => [
            'routes' => '',
            'category' => 'admins',
            'title_en' => 'Delete',
            'title_ar' => 'حذف',
        ],
        'show_clients' => [
            'routes' => 'dashboard.clients.create,dashboard.clients.store',
            'category' => 'clients',
            'title_en' => 'Show',
            'title_ar' => 'عرض',
        ],
        'add_clients' => [
            'routes' => 'dashboard.clients.create,dashboard.clients.store',
            'category' => 'clients',
            'title_en' => 'Add',
            'title_ar' => 'إضافة',
        ],
        'edit_clients' => [
            'routes' => 'dashboard.clients.edit,dashboard.clients.update',
            'category' => 'clients',
            'title_en' => 'Edit',
            'title_ar' => 'تعديل',
        ],
        'is_judging_clients' => [
            'routes' => '',
            'category' => 'clients',
            'title_en' => 'edit Judging Status',
            'title_ar' => 'تغيير الحالة القضائية',
        ],
        'active_unactive_clients' => [
            'routes' => '',
            'category' => 'clients',
            'title_en' => 'edit activation Status',
            'title_ar' => 'تفعيل / إلغاء تفعيل',
        ],
        'delete_attachment_clients' => [
            'routes' => '',
            'category' => 'clients',
            'title_en' => 'edit activation Status',
            'title_ar' => 'حذف ملفات العميل',
        ],
        'delete_clients' => [
            'routes' => 'dashboard.clients.deletes,dashboard.clients.destroy',
            'category' => 'clients',
            'title_en' => 'Delete',
            'title_ar' => 'حذف',
        ],
        'send_notifications' => [
            'routes' => '',
            'category' => 'notifications',
            'title_en' => 'Send',
            'title_ar' => 'إرسال',
        ],
        'show_notifications' => [
            'routes' => '',
            'category' => 'notifications',
            'title_en' => 'Show',
            'title_ar' => 'عرض',
        ],
        'add_month_percentages' => [
            'routes' => 'dashboard.month-percentages.create,dashboard.month-percentages.store',
            'category' => 'month_percentages',
            'title_en' => 'Add',
            'title_ar' => 'إضافة',
        ],
        'edit_month_percentages' => [
            'routes' => 'dashboard.month-percentages.edit,dashboard.month-percentages.update',
            'category' => 'month_percentages',
            'title_en' => 'Edit',
            'title_ar' => 'تعديل',
        ],
        'delete_month_percentages' => [
            'routes' => 'dashboard.month-percentages.deletes,dashboard.month-percentages.destroy',
            'category' => 'month_percentages',
            'title_en' => 'Delete',
            'title_ar' => 'حذف',
        ],

        'show_month_percentages' => [
            'routes' => 'dashboard.month-percentages.index,dashboard.month-percentages.datatable,dashboard.month-percentages.show',
            'category' => 'month_percentages',
            'title_en' => 'Show',
            'title_ar' => 'عرض',
        ],

        'show_contract_status' => [
            'routes' => 'dashboard.contract-status.index,dashboard.contract-status.datatable,dashboard.contract-status.show',
            'category' => 'Contract Status',
            'title_en' => 'Show',
            'title_ar' => 'عرض',
        ],
        'add_contract_status' => [
            'routes' => 'dashboard.contract-status.create,dashboard.contract-status.store',
            'category' => 'Contract Status',
            'title_en' => 'Add',
            'title_ar' => 'إضافة',
        ],
        'edit_contract_status' => [
            'routes' => 'dashboard.contract-status.edit,dashboard.contract-status.update',
            'category' => 'Contract Status',
            'title_en' => 'Edit',
            'title_ar' => 'تعديل',
        ],
        'delete_contract_status' => [
            'routes' => 'dashboard.contract-status.deletes,dashboard.contract-status.destroy',
            'category' => 'Contract Status',
            'title_en' => 'Delete',
            'title_ar' => 'حذف',
        ],

        'add_contracts' => [
            'routes' => 'dashboard.contracts.create,dashboard.contracts.store',
            'category' => 'contracts',
            'title_en' => 'Add',
            'title_ar' => 'إضافة',
        ],

        'can_update_contract_status' => [
            'routes' => '',
            'category' => 'contracts',
            'title_en' => 'Can update contract status',
            'title_ar' => 'تعديل حالة العقد',
        ],

        'show_contract_amount' => [
            'routes' => '',
            'category' => 'contracts',
            'title_en' => 'Show contract amount',
            'title_ar' => 'عرض مبلغ العقد',
        ],
        'show_contract_down_payment' => [
            'routes' => '',
            'category' => 'contracts',
            'title_en' => 'Show contract down payment',
            'title_ar' => 'عرض مقدم العقد',
        ],
        'show_contract_paid_amount' => [
            'routes' => '',
            'category' => 'contracts',
            'title_en' => 'Show contract paid amount',
            'title_ar' => 'عرض المسدد من قيمة العقد',
        ],
        'show_contract_profit' => [
            'routes' => '',
            'category' => 'contracts',
            'title_en' => 'Show contract profit',
            'title_ar' => 'عرض الربح',
        ],
        'show_contract_totals' => [
            'routes' => '',
            'category' => 'contracts',
            'title_en' => 'Show contract Totals',
            'title_ar' => 'عرض المجاميع',
        ],
        'show_installment_fees' => [
            'routes' => '',
            'category' => 'contracts',
            'title_en' => 'Show installment fees',
            'title_ar' => 'عرض نسبة العقد',
        ],

        'edit_contracts' => [
            'routes' => 'dashboard.contracts.edit,dashboard.contracts.update',
            'category' => 'contracts',
            'title_en' => 'Edit',
            'title_ar' => 'تعديل',
        ],
        'edit_contract_percentages' => [
            'routes' => '',
            'category' => 'contracts',
            'title_en' => 'Edit Contract percentages',
            'title_ar' => 'تعديل علي النسبه المضافه للعقد',
        ],
        'filter_contract_with_created_employee' => [
            'routes' => '',
            'category' => 'contracts',
            'title_en' => 'Filter Contract with created by',
            'title_ar' => 'البحث بالموظف الذي اضاف الغقد',
        ],
        'delete_contracts' => [
            'routes' => 'dashboard.contracts.deletes,dashboard.contracts.destroy',
            'category' => 'contracts',
            'title_en' => 'Delete',
            'title_ar' => 'حذف',
        ],

        'show_contracts' => [
            'routes' => 'dashboard.contracts.index,dashboard.contracts.datatable,dashboard.contracts.show',
            'category' => 'contracts',
            'title_en' => 'Show',
            'title_ar' => 'عرض',
        ],
        'add_nationalities' => [
            'routes' => 'dashboard.nationalities.create,dashboard.nationalities.store',
            'category' => 'nationalities',
            'title_en' => 'Add',
            'title_ar' => 'إضافة',
        ],
        'edit_nationalities' => [
            'routes' => 'dashboard.nationalities.edit,dashboard.nationalities.update',
            'category' => 'nationalities',
            'title_en' => 'Edit',
            'title_ar' => 'تعديل',
        ],
        'delete_nationalities' => [
            'routes' => 'dashboard.nationalities.deletes,dashboard.nationalities.destroy',
            'category' => 'nationalities',
            'title_en' => 'Delete',
            'title_ar' => 'حذف',
        ],

        'show_nationalities' => [
            'routes' => 'dashboard.nationalities.index,dashboard.nationalities.datatable,dashboard.nationalities.show',
            'category' => 'nationalities',
            'title_en' => 'Show',
            'title_ar' => 'عرض',
        ],

        'add_indebtednes' => [
            'routes' => 'dashboard.indebtednes.create,dashboard.indebtednes.store',
            'category' => 'indebtednes',
            'title_en' => 'Add',
            'title_ar' => 'إضافة',
        ],
        'edit_indebtednes' => [
            'routes' => 'dashboard.indebtednes.edit,dashboard.indebtednes.update',
            'category' => 'indebtednes',
            'title_en' => 'Edit',
            'title_ar' => 'تعديل',
        ],
        'delete_indebtednes' => [
            'routes' => 'dashboard.indebtednes.deletes,dashboard.indebtednes.destroy',
            'category' => 'indebtednes',
            'title_en' => 'Delete',
            'title_ar' => 'حذف',
        ],

        'pay_indebtednes' => [
            'routes' => 'dashboard.indebtednes.cancel,dashboard.indebtednes.pay',
            'category' => 'indebtednes',
            'title_en' => 'Show',
            'title_ar' => 'سداد وإلغاء السداد',
        ],

        'show_indebtednes' => [
            'routes' => 'dashboard.indebtednes.index,dashboard.indebtednes.datatable,dashboard.indebtednes.show',
            'category' => 'indebtednes',
            'title_en' => 'Show',
            'title_ar' => 'عرض',
        ],

        'add_offer_installment' => [
            'routes' => 'dashboard.installments.multi.add-offer',
            'category' => 'installments',
            'title_en' => 'Add Offer',
            'title_ar' => 'إضافة خصم',
        ],

        'cancel_offer_installment' => [
            'routes' => 'dashboard.installments.multi.cancel-offer',
            'category' => 'installments',
            'title_en' => 'Cancel Offer',
            'title_ar' => ' إلغاء خصم',
        ],

        'filter_installment_with_paid_employee' => [
            'routes' => '',
            'category' => 'installments',
            'title_en' => 'Filter installment with Paid by',
            'title_ar' => 'البحث بالموظف الذي سدد القسط',
        ],
        'show_installments' => [
            'routes' => 'dashboard.installments.index,dashboard.installments.datatable,dashboard.installments.show',
            'category' => 'installments',
            'title_en' => 'Show',
            'title_ar' => 'عرض',
        ],

        'show_installments_details' => [
            'routes' => 'd',
            'category' => 'installments',
            'title_en' => 'Show all details',
            'title_ar' => ' عرض كل التفاصيل',
        ],

        'pay_installments' => [
            'routes' => 'dashboard.installments.update',
            'category' => 'installments',
            'title_en' => 'pay installments',
            'title_ar' => 'سداد القسط',
        ],

        'show_installments_totals' => [
            'routes' => 'd',
            'category' => 'installments',
            'title_en' => 'Show Installments Totals',
            'title_ar' => ' عرض المجاميع ',
        ],

        'edit_installments_due_date' => [
            'routes' => 'dashboard.installments.update.due.date',
            'category' => 'installments',
            'title_en' => 'Edit Installments Due Date',
            'title_ar' => 'تعديل تاريخ الإستحقاق',
        ],

        'can_cancel_installments_pay' => [
            'routes' => 'dashboard.installments.payments.cancel,dashboard.installments.cancel',
            'category' => 'installments',
            'title_en' => 'Can cancel Installments payemnt',
            'title_ar' => 'إمكانية إلغاء السداد',
        ],
        
        'add_case_actions' => [
            'routes' => 'dashboard.case-actions.create,dashboard.case-actions.store',
            'category' => 'Case actions',
            'title_en' => 'Add',
            'title_ar' => 'إضافة',
        ],
        'edit_case_actions' => [
            'routes' => 'dashboard.case-actions.edit,dashboard.case-actions.update',
            'category' => 'Case actions',
            'title_en' => 'Edit',
            'title_ar' => 'تعديل',
        ],
        'delete_case_actions' => [
            'routes' => 'dashboard.case-actions.deletes,dashboard.case-actions.destroy',
            'category' => 'Case actions',
            'title_en' => 'Delete',
            'title_ar' => 'حذف',
        ],

        'show_case_actions' => [
            'routes' => 'dashboard.case-actions.index,dashboard.case-actions.datatable,dashboard.case-actions.show',
            'category' => 'Case actions',
            'title_en' => 'Show',
            'title_ar' => 'عرض',
        ],
        'show_instalments_payments_reports' => [
            'routes' => 'dashboard.installments.payments.index,dashboard.installments.payments.datatable,dashboard.installments.payments.export.excel,dashboard.installments.payments.export',
            'category' => 'Instalment Payments Reports',
            'title_en' => 'Show',
            'title_ar' => 'عرض',
        ],

        'add_countries' => [
            'routes' => 'dashboard.countries.create,dashboard.countries.store',
            'category' => 'countries',
            'title_en' => 'Add',
            'title_ar' => 'إضافة',
        ],
        'edit_countries' => [
            'routes' => 'dashboard.countries.edit,dashboard.countries.update',
            'category' => 'countries',
            'title_en' => 'Edit',
            'title_ar' => 'تعديل',
        ],
        'delete_countries' => [
            'routes' => 'dashboard.countries.deletes,dashboard.countries.destroy',
            'category' => 'countries',
            'title_en' => 'Delete',
            'title_ar' => 'حذف',
        ],

        'show_countries' => [
            'routes' => 'dashboard.countries.index,dashboard.countries.datatable,dashboard.countries.show',
            'category' => 'countries',
            'title_en' => 'Show',
            'title_ar' => 'عرض',
        ],
        'add_cities' => [
            'routes' => 'dashboard.cities.create,dashboard.cities.store',
            'category' => 'cities',
            'title_en' => 'Add',
            'title_ar' => 'إضافة',
        ],
        'edit_cities' => [
            'routes' => 'dashboard.cities.edit,dashboard.cities.update',
            'category' => 'cities',
            'title_en' => 'Edit',
            'title_ar' => 'تعديل',
        ],
        'delete_cities' => [
            'routes' => 'dashboard.cities.deletes,dashboard.cities.destroy',
            'category' => 'cities',
            'title_en' => 'Delete',
            'title_ar' => 'حذف',
        ],
        'show_cities' => [
            'routes' => 'dashboard.cities.index,dashboard.cities.datatable,dashboard.cities.show',
            'category' => 'cities',
            'title_en' => 'Show',
            'title_ar' => 'عرض',
        ],

        'add_states' => [
            'routes' => 'dashboard.states.create,dashboard.states.store',
            'category' => 'states',
            'title_en' => 'Add',
            'title_ar' => 'إضافة',
        ],
        'edit_states' => [
            'routes' => 'dashboard.states.edit,dashboard.states.update',
            'category' => 'states',
            'title_en' => 'Edit',
            'title_ar' => 'تعديل',
        ],
        'delete_states' => [
            'routes' => 'dashboard.states.deletes,dashboard.states.destroy',
            'category' => 'states',
            'title_en' => 'Delete',
            'title_ar' => 'حذف',
        ],
        'show_states' => [
            'routes' => 'dashboard.states.index,dashboard.states.datatable,dashboard.states.show',
            'category' => 'states',
            'title_en' => 'Show',
            'title_ar' => 'عرض',
        ],
        'delete_logs' => [
            'routes' => 'dashboard.logs.deletes,dashboard.logs.destroy',
            'category' => 'logs',
            'title_en' => 'Delete',
            'title_ar' => 'حذف',
        ],
        'show_logs' => [
            'routes' => 'dashboard.logs.index,dashboard.logs.datatable,dashboard.logs.show',
            'category' => 'logs',
            'title_en' => 'Show',
            'title_ar' => 'عرض',
        ],
        'show_pages' => [
            'routes' => '',
            'category' => 'pages',
            'title_en' => 'Show',
            'title_ar' => 'عرض',
        ],
        'add_pages' => [
            'routes' => '',
            'category' => 'pages',
            'title_en' => 'Add',
            'title_ar' => 'إضافة',
        ],
        'edit_pages' => [
            'routes' => '',
            'category' => 'pages',
            'title_en' => 'Edit',
            'title_ar' => 'تعديل',
        ],
        'delete_pages' => [
            'routes' => '',
            'category' => 'pages',
            'title_en' => 'Delete',
            'title_ar' => 'حذف',
        ],

        'add_labels' => [
            'routes' => 'dashboard.labels.create,dashboard.labels.store',
            'category' => 'labels',
            'title_en' => 'Add',
            'title_ar' => 'إضافة',
        ],
        'edit_labels' => [
            'routes' => 'dashboard.labels.edit,dashboard.labels.update',
            'category' => 'labels',
            'title_en' => 'Edit',
            'title_ar' => 'تعديل',
        ],
        'delete_labels' => [
            'routes' => 'dashboard.labels.deletes,dashboard.labels.destroy',
            'category' => 'labels',
            'title_en' => 'Delete',
            'title_ar' => 'حذف',
        ],
        'show_labels' => [
            'routes' => 'dashboard.labels.index,dashboard.labels.datatable,dashboard.labels.show',
            'category' => 'labels',
            'title_en' => 'Show',
            'title_ar' => 'عرض',
        ],
        'edit_settings' => [
            'routes' => '',
            'category' => 'settings',
            'title_en' => 'Edit',
            'title_ar' => 'تعديل',
        ],
        'show_settings' => [
            'routes' => '',
            'category' => 'settings',
            'title_en' => 'Show',
            'title_ar' => 'عرض',
        ],
        'delete_devices' => [
            'routes' => 'dashboard.devices.deletes,dashboard.devices.destroy',
            'category' => 'devices',
            'title_en' => 'Delete',
            'title_ar' => 'حذف',
        ],
        'show_devices' => [
            'routes' => 'dashboard.devices.index,dashboard.devices.datatable,dashboard.devices.show',
            'category' => 'devices',
            'title_en' => 'Show',
            'title_ar' => 'عرض',
        ],
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->permissions as $name => $per_data){

            $perm = Permission::updateOrCreate(['name' => $name],[
                'name' => $name,
                'category' => $per_data['category'],
                'guard_name' => 'web',
                'routes' =>$per_data['routes'],
                'display_name' => ['en' => $per_data['title_en'],'ar' => $per_data['title_ar']]
            ]);
            $perm->save();
        }
    }
}

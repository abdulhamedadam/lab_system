<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            // Dashboard and Test route permissions
            [
                'name' => 'view_dashboard',
                'title' => json_encode(['ar' => 'عرض لوحة القيادة', 'en' => 'view dashboard']),
                'guard_name' => 'admin',
            ],

            // Branches permissions
            [
                'name' => 'view_branches',
                'title' => json_encode(['ar' => 'عرض الفروع', 'en' => 'view branches']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'add_branch',
                'title' => json_encode(['ar' => 'اضافة فرع', 'en' => 'add branch']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'edit_branch',
                'title' => json_encode(['ar' => 'تعديل فرع', 'en' => 'edit branch']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'delete_branch',
                'title' => json_encode(['ar' => 'حذف فرع', 'en' => 'delete branch']),
                'guard_name' => 'admin',
            ],

            // Governorates permissions
            [
                'name' => 'view_governorates',
                'title' => json_encode(['ar' => 'عرض المحافظات', 'en' => 'view governorates']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'add_governorate',
                'title' => json_encode(['ar' => 'اضافة محافظة', 'en' => 'add governorate']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'edit_governorate',
                'title' => json_encode(['ar' => 'تعديل محافظة', 'en' => 'edit governorate']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'delete_governorate',
                'title' => json_encode(['ar' => 'حذف محافظة', 'en' => 'delete governorate']),
                'guard_name' => 'admin',
            ],

            // Areas permissions
            [
                'name' => 'view_areas',
                'title' => json_encode(['ar' => 'عرض المناطق', 'en' => 'view areas']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'add_area',
                'title' => json_encode(['ar' => 'اضافة منطقة', 'en' => 'add area']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'edit_area',
                'title' => json_encode(['ar' => 'تعديل منطقة', 'en' => 'edit area']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'delete_area',
                'title' => json_encode(['ar' => 'حذف منطقة', 'en' => 'delete area']),
                'guard_name' => 'admin',
            ],

            // Site Data permissions
            [
                'name' => 'view_site_data',
                'title' => json_encode(['ar' => 'عرض بيانات الموقع', 'en' => 'view site data']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'add_site_data',
                'title' => json_encode(['ar' => 'اضافة بيانات الموقع', 'en' => 'add site data']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'edit_site_data',
                'title' => json_encode(['ar' => 'تعديل بيانات الموقع', 'en' => 'edit site data']),
                'guard_name' => 'admin',
            ],

            // Employees permissions
            [
                'name' => 'view_employees',
                'title' => json_encode(['ar' => 'عرض الموظفين', 'en' => 'view employees']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'add_employee',
                'title' => json_encode(['ar' => 'اضافة موظف', 'en' => 'add employee']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'edit_employee',
                'title' => json_encode(['ar' => 'تعديل موظف', 'en' => 'edit employee']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'delete_employee',
                'title' => json_encode(['ar' => 'حذف موظف', 'en' => 'delete employee']),
                'guard_name' => 'admin',
            ],

            // Clients permissions
            [
                'name' => 'list_clients',
                'title' => json_encode(['ar' => 'عرض العملاء', 'en' => 'list clients']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'create_client',
                'title' => json_encode(['ar' => 'اضافة عميل', 'en' => 'create client']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'update_client',
                'title' => json_encode(['ar' => 'تعديل عميل', 'en' => 'update client']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'delete_client',
                'title' => json_encode(['ar' => 'حذف عميل', 'en' => 'delete client']),
                'guard_name' => 'admin',
            ],

            // Client Companies permissions
            [
                'name' => 'view_client_companies',
                'title' => json_encode(['ar' => 'عرض شركات العميل', 'en' => 'view client companies']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'add_client_company',
                'title' => json_encode(['ar' => 'اضافة شركة عميل', 'en' => 'add client company']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'edit_client_company',
                'title' => json_encode(['ar' => 'تعديل شركة عميل', 'en' => 'edit client company']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'update_client_company',
                'title' => json_encode(['ar' => 'تحديث شركة عميل', 'en' => 'update client company']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'delete_client_company',
                'title' => json_encode(['ar' => 'حذف شركة عميل', 'en' => 'delete client company']),
                'guard_name' => 'admin',
            ],

            // Client Projects permissions
            [
                'name' => 'view_client_projects',
                'title' => json_encode(['ar' => 'عرض مشاريع العميل', 'en' => 'view client projects']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'add_client_project',
                'title' => json_encode(['ar' => 'اضافة مشروع عميل', 'en' => 'add client project']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'edit_client_project',
                'title' => json_encode(['ar' => 'تعديل مشروع عميل', 'en' => 'edit client project']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'update_client_project',
                'title' => json_encode(['ar' => 'تحديث مشروع عميل', 'en' => 'update client project']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'delete_client_project',
                'title' => json_encode(['ar' => 'حذف مشروع عميل', 'en' => 'delete client project']),
                'guard_name' => 'admin',
            ],

            // Company permissions
            [
                'name' => 'list_companies',
                'title' => json_encode(['ar' => 'عرض الشركات', 'en' => 'list companies']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'create_company',
                'title' => json_encode(['ar' => 'اضافة شركة', 'en' => 'create company']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'update_company',
                'title' => json_encode(['ar' => 'تعديل شركة', 'en' => 'update company']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'delete_company',
                'title' => json_encode(['ar' => 'حذف شركة', 'en' => 'delete company']),
                'guard_name' => 'admin',
            ],

            // Company Projects permissions
            [
                'name' => 'view_company_projects',
                'title' => json_encode(['ar' => 'عرض مشاريع الشركة', 'en' => 'view company projects']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'add_company_project',
                'title' => json_encode(['ar' => 'اضافة مشروع شركة', 'en' => 'add company project']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'edit_company_project',
                'title' => json_encode(['ar' => 'تعديل مشروع شركة', 'en' => 'edit company project']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'update_company_project',
                'title' => json_encode(['ar' => 'تحديث مشروع شركة', 'en' => 'update company project']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'delete_company_project',
                'title' => json_encode(['ar' => 'حذف مشروع شركة', 'en' => 'delete company project']),
                'guard_name' => 'admin',
            ],

            // Project permissions
            [
                'name' => 'list_projects',
                'title' => json_encode(['ar' => 'عرض المشاريع', 'en' => 'list projects']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'create_project',
                'title' => json_encode(['ar' => 'اضافة مشروع', 'en' => 'create project']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'update_project',
                'title' => json_encode(['ar' => 'تعديل مشروع', 'en' => 'update project']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'delete_project',
                'title' => json_encode(['ar' => 'حذف مشروع', 'en' => 'delete project']),
                'guard_name' => 'admin',
            ],

            // Masrofat permissions
            [
                'name' => 'list_masrofat',
                'title' => json_encode(['ar' => 'عرض المصروفات', 'en' => 'list expenses']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'create_masrofat',
                'title' => json_encode(['ar' => 'اضافة مصروف', 'en' => 'create expense']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'update_masrofat',
                'title' => json_encode(['ar' => 'تعديل مصروف', 'en' => 'update expense']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'delete_masrofat',
                'title' => json_encode(['ar' => 'حذف مصروف', 'en' => 'delete expense']),
                'guard_name' => 'admin',
            ],

            // Tests permissions
            [
                'name' => 'list_tests',
                'title' => json_encode(['ar' => 'عرض الاختبارات', 'en' => 'list tests']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'create_test',
                'title' => json_encode(['ar' => 'اضافة اختبار', 'en' => 'create test']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'update_test',
                'title' => json_encode(['ar' => 'تعديل اختبار', 'en' => 'update test']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'delete_test',
                'title' => json_encode(['ar' => 'حذف اختبار', 'en' => 'delete test']),
                'guard_name' => 'admin',
            ],

            // Users permissions
            [
                'name' => 'list_users',
                'title' => json_encode(['ar' => 'عرض المستخدمين', 'en' => 'list users']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'create_user',
                'title' => json_encode(['ar' => 'اضافة مستخدم', 'en' => 'create user']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'update_user',
                'title' => json_encode(['ar' => 'تعديل مستخدم', 'en' => 'update user']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'delete_user',
                'title' => json_encode(['ar' => 'حذف مستخدم', 'en' => 'delete user']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'change_user_status',
                'title' => json_encode(['ar' => 'تغيير حالة المستخدم', 'en' => 'change user status']),
                'guard_name' => 'admin',
            ],

            // Users permissions management
            [
                'name' => 'manage_user_permissions',
                'title' => json_encode(['ar' => 'ادارة صلاحيات المستخدم', 'en' => 'manage user permissions']),
                'guard_name' => 'admin',
            ],

        ];

        DB::table('permissions')->insert($permissions);
    }
}


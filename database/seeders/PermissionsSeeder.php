<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'name' => 'list_user',
                'title' => json_encode(['ar' => 'عرض مستخدم', 'en' => 'show user']),
                'guard_name' => 'admin',
            ],[
                'name' => 'add_user',
                'title' => json_encode(['ar' => 'اضافة مستخدم', 'en' => 'add user']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'update_user',
                'title' => json_encode(['ar' => 'تعديل بيانات مستخدم', 'en' => 'update user']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'delete_user',
                'title' => json_encode(['ar' => 'حذف مستخدم', 'en' => 'delete user']),
                'guard_name' => 'admin',
            ],

            [
                'name' => 'list_roles',
                'title' => json_encode(['ar' => 'عرض دور صلاحية', 'en' => 'show roles']),
                'guard_name' => 'admin',
            ], [
                'name' => 'add_roles',
                'title' => json_encode(['ar' => 'اضافة دور صلاحية', 'en' => 'add roles']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'update_roles',
                'title' => json_encode(['ar' => 'تعديل دور صلاحية', 'en' => 'update roles']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'delete_roles',
                'title' => json_encode(['ar' => 'حذف دور صلاحية', 'en' => 'delete roles']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'TrainingCenters',
                'title' => json_encode(['ar' => 'مراكز التدريب', 'en' => 'Training Centers']),
                'guard_name' => 'admin'
            ],
            [
                'name' => 'FinanceService',
                'title' => json_encode(['ar' => 'خدمة التمويل', 'en' => 'Finance Service']),
                'guard_name' => 'admin'
            ],
            [
                'name' => 'SupportingEntity',
                'title' => json_encode(['ar' => 'الجهة الداعمة', 'en' => 'Supporting Entity']),
                'guard_name' => 'admin'
            ],
            [
                'name' => 'enterData',
                'title' => json_encode(['ar' => 'ادخال بيانات', 'en' => 'enter data']),
                'guard_name' => 'admin'
            ],
            [
                'name' => 'delete',
                'title' => json_encode(['ar' => 'حذف', 'en' => 'delete']),
                'guard_name' => 'admin'
            ],
            [
                'name' => 'edit',
                'title' => json_encode(['ar' => 'تعديل', 'en' => 'edit']),
                'guard_name' => 'admin'
            ],


            /********************-------------site ---------------******************** */
            [
                'name' => 'siteData',
                'title' => json_encode(['ar' => 'بيانات الموقع', 'en' => ' Site Data']),
                'guard_name' => 'admin',
            ],


            /********************-------------main_subscriptions ---------------******************** */
            [
                'name' => 'add_main_subscriptions',
                'title' => json_encode(['ar' => 'اضافة الاشتراك الاعادي', 'en' => 'add main_subscriptions']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'update_main_subscriptions',
                'title' => json_encode(['ar' => 'تعديل الاشتراك الاعادي', 'en' => 'update main_subscriptions']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'delete_main_subscriptions',
                'title' => json_encode(['ar' => 'حذف الاشتراك الاعادي', 'en' => 'delete main_subscriptions']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'show_main_subscriptions',
                'title' => json_encode(['ar' => 'عرض الاشتراك الاعادي', 'en' => 'show main_subscriptions']),
                'guard_name' => 'admin',
            ],

            /********************-------------special_subscriptions ---------------******************** */
            [
                'name' => 'add_special_subscriptions',
                'title' => json_encode(['ar' => 'اضافة الاشتراك الخاص', 'en' => 'add special_subscriptions']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'update_special_subscriptions',
                'title' => json_encode(['ar' => 'تعديل الاشتراك الخاص', 'en' => 'update special_subscriptions']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'delete_special_subscriptions',
                'title' => json_encode(['ar' => 'حذف الاشتراك الخاص', 'en' => 'delete special_subscriptions']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'show_special_subscriptions',
                'title' => json_encode(['ar' => 'عرض الاشتراك الخاص', 'en' => 'show special_subscriptions']),
                'guard_name' => 'admin',
            ],

            /********************-------------offers ---------------******************** */
            [
                'name' => 'add_offers',
                'title' => json_encode(['ar' => 'اضافة العروض', 'en' => 'add offers']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'update_offers',
                'title' => json_encode(['ar' => 'تعديل العروض', 'en' => 'update offers']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'delete_offers',
                'title' => json_encode(['ar' => 'حذف العروض', 'en' => 'delete offers']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'show_offers',
                'title' => json_encode(['ar' => 'عرض العروض', 'en' => 'show offers']),
                'guard_name' => 'admin',
            ],

            /********************-------------transportation ---------------******************** */
            [
                'name' => 'add_transportation',
                'title' => json_encode(['ar' => 'اضافة الرحلات', 'en' => 'add transportation']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'update_transportation',
                'title' => json_encode(['ar' => 'تعديل الرحلات', 'en' => 'update transportation']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'delete_transportation',
                'title' => json_encode(['ar' => 'حذف الرحلات', 'en' => 'delete transportation']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'show_transportation',
                'title' => json_encode(['ar' => 'عرض الرحلات', 'en' => 'show transportation']),
                'guard_name' => 'admin',
            ],

            /********************-------------trainers ---------------******************** */
            [
                'name' => 'add_trainers',
                'title' => json_encode(['ar' => 'اضافة المدربين', 'en' => 'add trainers']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'update_trainers',
                'title' => json_encode(['ar' => 'تعديل المدربين', 'en' => 'update trainers']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'delete_trainers',
                'title' => json_encode(['ar' => 'حذف المدربين', 'en' => 'delete trainers']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'show_trainers',
                'title' => json_encode(['ar' => 'عرض المدربين', 'en' => 'show trainers']),
                'guard_name' => 'admin',
            ],

            /********************-------------members ---------------******************** */
            [
                'name' => 'add_members',
                'title' => json_encode(['ar' => 'اضافة الاعضاء', 'en' => 'add members']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'update_members',
                'title' => json_encode(['ar' => 'تعديل الاعضاء', 'en' => 'update members']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'delete_members',
                'title' => json_encode(['ar' => 'حذف الاعضاء', 'en' => 'delete members']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'show_members',
                'title' => json_encode(['ar' => 'عرض الاعضاء', 'en' => 'show members']),
                'guard_name' => 'admin',
            ],

            /********************-------------member_subscriptions ---------------******************** */
            [
                'name' => 'add_member_subscriptions',
                'title' => json_encode(['ar' => 'اضافة اشتراك الاعضاء', 'en' => 'add member_subscriptions']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'update_member_subscriptions',
                'title' => json_encode(['ar' => 'تعديل اشتراك الاعضاء', 'en' => 'update member_subscriptions']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'delete_member_subscriptions',
                'title' => json_encode(['ar' => 'حذف اشتراك الاعضاء', 'en' => 'delete member_subscriptions']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'show_member_subscriptions',
                'title' => json_encode(['ar' => 'عرض اشتراك الاعضاء', 'en' => 'show member_subscriptions']),
                'guard_name' => 'admin',
            ],

            /********************-------------about ---------------******************** */
            [
                'name' => 'add_about',
                'title' => json_encode(['ar' => 'اضافة من نحن', 'en' => 'add about']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'update_about',
                'title' => json_encode(['ar' => 'تعديل من نحن', 'en' => 'update about']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'delete_about',
                'title' => json_encode(['ar' => 'حذف من نحن', 'en' => 'delete about']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'show_about',
                'title' => json_encode(['ar' => 'عرض من نحن', 'en' => 'show about']),
                'guard_name' => 'admin',
            ],



            /********************-------------terms ---------------******************** */

            [
                'name' => 'add_terms',
                'title' => json_encode(['ar' => 'اضافة شروط والاحكام', 'en' => 'add terms']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'update_terms',
                'title' => json_encode(['ar' => 'تعديل شروط والاحكام', 'en' => 'update terms']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'delete_terms',
                'title' => json_encode(['ar' => 'حذف شروط والاحكام', 'en' => 'delete terms']),
                'guard_name' => 'admin',
            ],
            [
                'name' => 'show_terms',
                'title' => json_encode(['ar' => 'عرض شروط والاحكام', 'en' => 'show terms']),
                'guard_name' => 'admin',
            ],[
                'name' => 'show_contacts',
                'title' => json_encode(['ar' => 'عرض الرسائل', 'en' => 'show contacts massege']),
                'guard_name' => 'admin',
            ],

        ];

        DB::table('permissions')->insert($permissions);
    }
}


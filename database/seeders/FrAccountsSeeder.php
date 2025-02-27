<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FrAccountsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('fr_accounts')->insert([
            [
                'name' => json_encode(['en' => 'Cash', 'ar' => 'نقدية']),
                'code' => 1001,
                'level' => 1,
                'account_num' => '1001',
                'account_type' => 'Asset',
                'description' => 'Cash on hand and in banks',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => json_encode(['en' => 'Bank', 'ar' => 'البنك']),
                'code' => 1002,
                'level' => 1,
                'account_num' => '1002',
                'account_type' => 'Asset',
                'description' => 'Bank deposits',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => json_encode(['en' => 'Accounts Receivable', 'ar' => 'حسابات العملاء']),
                'code' => 1101,
                'level' => 1,
                'account_num' => '1101',
                'account_type' => 'Asset',
                'description' => 'Amounts due from customers',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => json_encode(['en' => 'Accounts Payable', 'ar' => 'حسابات الموردين']),
                'code' => 2001,
                'level' => 1,
                'account_num' => '2001',
                'account_type' => 'Liability',
                'description' => 'Amounts owed to suppliers',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => json_encode(['en' => 'Revenue', 'ar' => 'الإيرادات']),
                'code' => 3001,
                'level' => 1,
                'account_num' => '3001',
                'account_type' => 'Revenue',
                'description' => 'Income from business operations',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => json_encode(['en' => 'Expenses', 'ar' => 'المصروفات']),
                'code' => 4001,
                'level' => 1,
                'account_num' => '4001',
                'account_type' => 'Expense',
                'description' => 'Business operation costs',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

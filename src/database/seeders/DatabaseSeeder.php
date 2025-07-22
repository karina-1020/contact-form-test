<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Seeder;
use Database\Seeders\ContactsTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //contactsテーブルにダミーデータを登録（ファクトリを使用）
        $this->call(ContactsTableSeeder::class);
        //categoriesテーブルに5件のダミーデータを登録（シーダーファイル使用）
        $this->call(CategoriesTableSeeder::class);
    }
}

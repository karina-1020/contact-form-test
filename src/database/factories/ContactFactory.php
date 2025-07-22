<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()  //ダミーデータのルールを定義する
    {
        return [
            'category_id' => $this->faker->numberBetween(1, 5), // 外部キー（categories.id）
            'first_name' => $this->faker->firstName, // 名
            'last_name' => $this->faker->lastName,   // 姓
            'gender' => $this->faker->numberBetween(1, 3), // 1:男性, 2:女性, 3:その他
            'email' => $this->faker->unique()->safeEmail,  // 重複なしのメール
            'tel' => $this->faker->numerify('0##########'), // 電話番号（ハイフンなし）
            'address' => $this->faker->address, // 住所
            'building' => $this->faker->secondaryAddress, // 建物名など
            'detail' => $this->faker->realText(50), // お問い合わせ内容（本文）
        ];
    }
    
}


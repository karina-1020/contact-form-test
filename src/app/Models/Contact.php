<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; //ダミーデータをつくるために、ファクトリを使うよ！と宣言
use Illuminate\Database\Eloquent\Model;
use App\Models\Category; //リレーション用

class Contact extends Model
{
    use HasFactory;

    // 一括代入を許可するカラム一覧
    protected $fillable = [
        'last_name',
        'first_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'category_id',
        'detail',
    ];

    //categoryとのリレーション
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
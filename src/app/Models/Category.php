<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Contact; //リレーション用

class Category extends Model
{
    use HasFactory;

    //contactsとのリレーション
    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'description', 'active', 'photo'];

    public function getPagePhotoAttribute(){
        if(Storage::exists($this->attributes['photo'])){
            return Storage::url($this->attributes['photo']);
        }
        return 'https://avatarko.ru/img/kartinka/1/avatarko_anonim.jpg';
    }
}

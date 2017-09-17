<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable =
        [
            'title_ro',
            'title_ru',
            'title_en',
            'meta_description_ro',
            'meta_description_ru',
            'meta_description_en',
            'slug_ro',
            'slug_ru',
            'slug_en',
            'mini_description_ro',
            'mini_description_ru',
            'mini_description_en',
            'description_ro',
            'description_ru',
            'description_en',
            'status',
            'service_ro',
            'service_ru',
            'service_en',
            'image_1',
            'image_2',
            'image_3',
            'image_4',
            'created_at',
            'updated_at',
            'sort',
            'menu'
        ];
}

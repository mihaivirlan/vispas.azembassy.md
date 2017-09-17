<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable =
        ['title_ro',
        'title_ru',
        'title_en',
        'meta_description_ro',
        'meta_description_ru',
        'meta_description_en'
        ];
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $table = 'landing_contents';

    protected $fillable = ['title', 'content', 'section_key'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UrlAlias extends Model
{
    use HasFactory;

    protected $table = 'url_alias';
    protected $fillable = ['pid', 'source', 'alias', 'language'];
}

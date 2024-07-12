<?php

namespace App\Models;

use App\Models\BlockCustom;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Block extends Model
{
    use HasFactory;

    protected $table = 'block';
    protected $fillable = ['bid', 'module', 'delta', 'theme', 'status', 'weight', 'region', 'custom', 'visibility', 'pages', 'title', 'cache', 'css_class'];

    public function blockCopyRight()
    {
        return $this->hasMany(BlockCustom::class, 'bid', 'delta');
    }

}

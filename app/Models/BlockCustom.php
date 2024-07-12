<?php

namespace App\Models;

use App\Models\Block;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlockCustom extends Model
{
    use HasFactory;

    protected $table = 'block_custom';
    protected $fillable = ['bid', 'body', 'info', 'format'];


}

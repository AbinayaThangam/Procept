<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldDataBody extends Model
{
    use HasFactory;

    protected $table = 'field_data_body';
    protected $fillable = [
        'entity_type',
        'bundle',
        'deleted',
        'entity_id',
        'revision_id',
        'language',
        'delta',
        'body_value',
        'body_summary',
        'body_format'
    ];
}

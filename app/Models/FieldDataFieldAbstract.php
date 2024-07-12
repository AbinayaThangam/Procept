<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldDataFieldAbstract extends Model
{
    use HasFactory;
    protected $table = 'filed_data_field_abstract';
    protected $fillable = [
        'entity_type',
        'bundle',
        'deleted',
        'entity_id',
        'revision_id',
        'language',
        'delta',
        'field_abstract_value',
        'field_abstract_format'
    ];
}

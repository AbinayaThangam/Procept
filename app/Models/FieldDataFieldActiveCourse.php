<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldDataFieldActiveCourse extends Model
{
    use HasFactory;
    protected $table = 'field_data_field_active_course';

    protected $fillable = [
        'entity_type',
        'bundle',
        'deleted',
        'entity_id',
        'revision_id'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldDataFieldCourseType extends Model
{
    use HasFactory;
    protected $table = 'field_data_field_course_type';
    protected $fillable = [
        'entity_id',
        'bundle',
        'deleted',
        'entity_id',
        'revision_id',
        'language',
        'delta',
        'field_course_type_tid'
    ];
}

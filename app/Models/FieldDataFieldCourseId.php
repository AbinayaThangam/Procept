<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldDataFieldCourseId extends Model
{
    use HasFactory;
    protected $table='field_data_field_course_id';
    protected $fillable = ['entity_type','bundle','deleted','entity_id','revision_id','language','delta','field_course_id_value','field_course_id_format'];

}

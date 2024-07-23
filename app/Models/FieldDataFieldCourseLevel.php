<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldDataFieldCourseLevel extends Model
{
    use HasFactory;
    protected $table='field_data_field_course_level';
    protected $fillable =['entity_type','bundle','deleted','entity_id','revision_id','language','delta','field_course_level_tid'];

}

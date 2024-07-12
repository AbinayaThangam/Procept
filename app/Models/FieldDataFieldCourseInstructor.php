<?php

namespace App\Models;

use App\Models\Node;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FieldDataFieldCourseInstructor extends Model
{
    use HasFactory;
    protected $table='field_data_field_course_instructor';
    protected $fillable =['entity_type','bundle','deleted','entity_id','revision_id','language','delta','field_course_instructor_target_id'];

    public function fieldCourseInstructorNode()
    {
        return $this->belongsTo(Node::class, 'field_course_instructor_target_id', 'nid');
    }
}

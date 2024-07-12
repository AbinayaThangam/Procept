<?php

namespace App\Models;

use App\Models\Node;
use App\Models\UrlAlias;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FieldDataFieldCourse extends Model
{
    use HasFactory;
    protected $table='field_data_field_course';
    protected $fillable = ['entity_type','bundle','deleted','entity_id','revision_id','language','delta','field_course_target_id'];
    public function fieldDataFieldCourseNode()
    {
        return $this->belongsTo(Node::class, 'field_course_target_id','nid');
    }

}

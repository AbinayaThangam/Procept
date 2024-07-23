<?php

namespace App\Models;


use App\Models\FieldDataBody;
use Illuminate\Database\Eloquent\Model;
use App\Models\FieldDataFieldTestimonialImage;
use App\Models\FieldDataFieldTestimonialPosition;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FieldDataFieldCourseTarget extends Model
{
    use HasFactory;
    protected $table='field_data_field_course_target';
    protected $fillable =['entity_type','bundle','deleted','entity_id','revision_id','language','delta','field_course_target_target_id'];
    public function FieldDataBodyCourse()
    {
        return $this->belongsTo(FieldDataBody::class, 'entity_id','entity_id');
    }
    public function FieldDataFieldTestimonialPositionNode()
    {
        return $this->belongsTo(FieldDataFieldTestimonialPosition::class, 'entity_id','entity_id');
    }
    public function FieldDataFieldTestimonialImage()
    {
        return $this->belongsTo(FieldDataFieldTestimonialImage::class, 'entity_id','entity_id');
    }
}

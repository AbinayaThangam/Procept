<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldDataFieldTestimonialPosition extends Model
{
    use HasFactory;
    protected $table = 'field_data_field_testimonial_position';
    protected $fillable = ['entity_type', 'bundle', 'deleted', 'entity_id', 'revision_id', 'language', 'delta', 'field_testimonial_position_value','field_testimonial_position_format'];

}

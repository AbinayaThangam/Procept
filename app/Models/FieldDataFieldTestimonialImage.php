<?php

namespace App\Models;

use App\Models\FileManaged;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FieldDataFieldTestimonialImage extends Model
{
    use HasFactory;
    protected $table = 'field_data_field_testimonial_image';
    protected $fillable = ['entity_type', 'bundle', 'deleted', 'entity_id', 'revision_id', 'language', 'delta', 'field_testimonial_image_fid','field_testimonial_image_alt','field_testimonial_image_title','field_testimonial_image_width','field_testimonial_image_height'];
    public function FileManagedTestimonialImage()
    {
        return $this->belongsTo(FileManaged::class, 'field_testimonial_image_fid','fid');
    }
}

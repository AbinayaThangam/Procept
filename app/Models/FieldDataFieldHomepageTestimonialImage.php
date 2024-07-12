<?php

namespace App\Models;

use App\Models\FileManaged;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldDataFieldHomepageTestimonialImage extends Model
{
    use HasFactory;
    protected $table='field_data_field_homepage_testimonial_image';
    protected $fillable = ['entity_type','bundle','deleted','entity_id','revision_id','language','delta','field_homepage_testimonial_image_fid','field_homepage_testimonial_image_alt','field_homepage_testimonial_image_title','field_homepage_testimonial_image_width','field_homepage_testimonial_image_height'];

    public function fileManagedHomepageTestimonialImage()
    {
        return $this->belongsTo(FileManaged::class, 'field_homepage_testimonial_image_fid','fid');
    }

}

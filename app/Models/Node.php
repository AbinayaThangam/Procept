<?php

namespace App\Models;

use App\Models\FieldDataBody;
use App\Models\FieldDataFieldCourse;
use App\Models\FieldDataFieldResale;

use App\Models\FieldDataFieldSpeaker;
use Illuminate\Database\Eloquent\Model;
use App\Models\FieldDataFieldInstructor1;
use App\Models\FieldDataFieldInstructor2;
use App\Models\FieldDataFieldInstructor3;
use App\Models\FieldDataFieldInstructor4;
use App\Models\FieldDataFieldInstructor5;
use App\Models\FieldDataFieldInstructor6;
use App\Models\FieldDataFieldInstructor7;
use App\Models\FieldDataFieldInstructor8;
use App\Models\FieldDataFieldInstructor9;
use App\Models\FieldDataFieldInstructor10;
use App\Models\FieldDataFieldCourseInstructor;
use App\Models\FieldDataFieldHomepageTestimonialImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Node extends Model
{
    use HasFactory;
    protected $table = 'node';
    protected $fillable = ['nid', 'vid', 'type', 'language','title','uid','status','created','changed','comment','promote','sticky','tnid','translate','uuid'];

    public function fieldDataFieldCourseNodeDetails()
    {
        return $this->belongsTo(FieldDataFieldCourse::class, 'nid','entity_id');
    }

    public function fieldDataFieldResaleNode()
    {
        return $this->belongsTo(FieldDataFieldResale::class, 'nid','entity_id');
    }
    public function fieldDataBody()
    {
        return $this->belongsTo(FieldDataBody::class, 'nid','entity_id');
    }
    public function fieldDataFieldHomepageTestimonialImage()
    {
        return $this->belongsTo(FieldDataFieldHomepageTestimonialImage::class, 'nid','entity_id');
    }

    public function fieldDataFieldSpeaker()
    {
        return $this->belongsTo(FieldDataFieldSpeaker::class, 'nid','entity_id');
    }
    public function fieldDataFieldInstructor1()
    {
        return $this->belongsTo(FieldDataFieldInstructor1::class, 'nid','entity_id');
    }
    public function fieldDataFieldInstructor2()
    {
        return $this->belongsTo(FieldDataFieldInstructor2::class, 'nid','entity_id');
    }
    public function fieldDataFieldInstructor3()
    {
        return $this->belongsTo(FieldDataFieldInstructor3::class, 'nid','entity_id');
    }
    public function fieldDataFieldInstructor4()
    {
        return $this->belongsTo(FieldDataFieldInstructor4::class, 'nid','entity_id');
    }
    public function fieldDataFieldInstructor5()
    {
        return $this->belongsTo(FieldDataFieldInstructor5::class, 'nid','entity_id');
    }
    public function fieldDataFieldInstructor6()
    {
        return $this->belongsTo(FieldDataFieldInstructor6::class, 'nid','entity_id');
    }
    public function fieldDataFieldInstructor7()
    {
        return $this->belongsTo(FieldDataFieldInstructor7::class, 'nid','entity_id');
    }
    public function fieldDataFieldInstructor8()
    {
        return $this->belongsTo(FieldDataFieldInstructor8::class, 'nid','entity_id');
    }
    public function fieldDataFieldInstructor9()
    {
        return $this->belongsTo(FieldDataFieldInstructor9::class, 'nid','entity_id');
    }
    public function fieldDataFieldInstructor10()
    {
        return $this->belongsTo(FieldDataFieldInstructor10::class, 'nid','entity_id');
    }
    public function fieldDataFieldCourseInstructor()
    {
        return $this->belongsTo(FieldDataFieldCourseInstructor::class, 'nid','entity_id');
    }

}


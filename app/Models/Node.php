<?php

namespace App\Models;

use App\Models\FieldDataBody;
use App\Models\FieldDataFieldCourse;
use App\Models\FieldDataFieldResale;

use App\Models\FieldDataFieldSpeaker;
use App\Models\FieldDataFieldCourseId;
use App\Models\FieldDataFieldDuration;
use Illuminate\Database\Eloquent\Model;
use App\Models\FieldDataFieldInstructorOne;
use App\Models\FieldDataFieldInstructorSix;
use App\Models\FieldDataFieldInstructorTen;
use App\Models\FieldDataFieldInstructorTwo;
use App\Models\FieldDataFieldInstructorFive;
use App\Models\FieldDataFieldInstructorFour;
use App\Models\FieldDataFieldInstructorNine;
use App\Models\FieldDataFieldInstructorEight;
use App\Models\FieldDataFieldInstructorSeven;
use App\Models\FieldDataFieldInstructorThree;
use App\Models\FieldDataFieldCourseInstructor;
use App\Models\FieldDataFieldSessionLocLocation;
use App\Models\FieldDataFieldHomepageTestimonialImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Node extends Model
{
    use HasFactory;
    protected $table = 'node';
    protected $fillable = ['nid', 'vid', 'type', 'language', 'title', 'uid', 'status', 'created', 'changed', 'comment', 'promote', 'sticky', 'tnid', 'translate', 'uuid'];

    public function fieldDataFieldCourseNodeDetails()
    {
        return $this->belongsTo(FieldDataFieldCourse::class, 'nid', 'entity_id');
    }

    public function fieldDataFieldResaleNode()
    {
        return $this->belongsTo(FieldDataFieldResale::class, 'nid', 'entity_id');
    }
    public function fieldDataBody()
    {
        return $this->belongsTo(FieldDataBody::class, 'nid', 'entity_id');
    }
    public function fieldDataFieldHomepageTestimonialImage()
    {
        return $this->belongsTo(FieldDataFieldHomepageTestimonialImage::class, 'nid', 'entity_id');
    }

    public function fieldDataFieldSpeaker()
    {
        return $this->belongsTo(FieldDataFieldSpeaker::class, 'nid', 'entity_id');
    }
    public function fieldDataFieldInstructor1()
    {
        return $this->belongsTo(FieldDataFieldInstructorOne::class, 'nid', 'entity_id');
    }
    public function fieldDataFieldInstructor2()
    {
        return $this->belongsTo(FieldDataFieldInstructorTwo::class, 'nid', 'entity_id');
    }
    public function fieldDataFieldInstructor3()
    {
        return $this->belongsTo(FieldDataFieldInstructorThree::class, 'nid', 'entity_id');
    }
    public function fieldDataFieldInstructor4()
    {
        return $this->belongsTo(FieldDataFieldInstructorFour::class, 'nid', 'entity_id');
    }
    public function fieldDataFieldInstructor5()
    {
        return $this->belongsTo(FieldDataFieldInstructorFive::class, 'nid', 'entity_id');
    }
    public function fieldDataFieldInstructor6()
    {
        return $this->belongsTo(FieldDataFieldInstructorSix::class, 'nid', 'entity_id');
    }
    public function fieldDataFieldInstructor7()
    {
        return $this->belongsTo(FieldDataFieldInstructorSeven::class, 'nid', 'entity_id');
    }
    public function fieldDataFieldInstructor8()
    {
        return $this->belongsTo(FieldDataFieldInstructorEight::class, 'nid', 'entity_id');
    }
    public function fieldDataFieldInstructor9()
    {
        return $this->belongsTo(FieldDataFieldInstructorNine::class, 'nid', 'entity_id');
    }
    public function fieldDataFieldInstructor10()
    {
        return $this->belongsTo(FieldDataFieldInstructorTen::class, 'nid', 'entity_id');
    }
    public function fieldDataFieldCourseInstructor()
    {
        return $this->belongsTo(FieldDataFieldCourseInstructor::class, 'nid', 'entity_id');
    }
    public function fieldDataFieldCourseId()
    {
        return $this->belongsTo(FieldDataFieldCourseId::class, 'nid', 'entity_id');
    }
    public function fieldDataFieldDuration()
    {
        return $this->belongsTo(FieldDataFieldDuration::class, 'nid', 'entity_id');
    }
    public function FieldDataFieldSessionLocLocation()
    {
        return $this->belongsTo(FieldDataFieldSessionLocLocation::class,'nid','entity_id');
    }
}


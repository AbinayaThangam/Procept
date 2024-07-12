<?php

namespace App\Models;

use App\Models\Node;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FieldDataFieldInstructor10 extends Model
{
    use HasFactory;

    protected $table='field_data_field_instructor10';
    protected $fillable = ['entity_type','bundle','deleted','entity_id','revision_id','language','delta','field_instructor10_target_id'];
    public function fieldDataFieldInstructorNode10()
    {
        return $this->belongsTo(Node::class, 'field_instructor10_target_id','nid');
    }
}

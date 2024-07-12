<?php

namespace App\Models;

use App\Models\Node;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FieldDataFieldInstructor4 extends Model
{
    use HasFactory;

    protected $table='field_data_field_instructor4';
    protected $fillable = ['entity_type','bundle','deleted','entity_id','revision_id','language','delta','field_instructor4_target_id'];
    public function fieldDataFieldInstructorNode4()
    {
        return $this->belongsTo(Node::class, 'field_instructor4_target_id','nid');
    }
}

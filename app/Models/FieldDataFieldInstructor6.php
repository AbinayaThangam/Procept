<?php

namespace App\Models;

use App\Models\Node;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FieldDataFieldInstructor6 extends Model
{
    use HasFactory;

    protected $table='field_data_field_instructor6';
    protected $fillable = ['entity_type','bundle','deleted','entity_id','revision_id','language','delta','field_instructor6_target_id'];
    public function fieldDataFieldInstructorNode6()
    {
        return $this->belongsTo(Node::class, 'field_instructor6_target_id','nid');
    }
}

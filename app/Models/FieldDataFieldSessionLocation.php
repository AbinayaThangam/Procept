<?php

namespace App\Models;

use App\Models\Node;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FieldDataFieldSessionLocation extends Model
{
    use HasFactory;
    protected $table = 'field_data_field_session_location';
    protected $fillable = ['entity_type', 'bundle', 'deleted', 'entity_id', 'revision_id', 'language', 'delta', 'field_session_location_target_id'];

    public function FieldDataFieldSessionLocationNode()
    {
        return $this->belongsTo(Node::class, 'field_session_location_target_id', 'nid');
    }
}

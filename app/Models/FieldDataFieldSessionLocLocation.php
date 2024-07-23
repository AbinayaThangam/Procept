<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldDataFieldSessionLocLocation extends Model
{
    use HasFactory;
    protected $table = 'field_data_field_session_loc_location';
    protected $fillable = ['entity_type', 'bundle', 'deleted', 'entity_id', 'revision_id', 'language', 'delta', 'field_session_loc_location_value', 'field_session_loc_location_revision_id'];

}

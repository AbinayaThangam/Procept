<?php

namespace App\Models;

use App\Constants\AppConstants;
use App\Models\FieldDataFieldOnline;
use Illuminate\Database\Eloquent\Model;
use App\Models\FieldDataFieldSessionLocation;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FieldDataFieldSessionLocLocation extends Model
{
    use HasFactory;
    protected $table = 'field_data_field_session_loc_location';
    protected $fillable = ['entity_type', 'bundle', 'deleted', 'entity_id', 'revision_id', 'language', 'delta', 'field_session_loc_location_value', 'field_session_loc_location_revision_id'];
    public function fieldDataFieldOnline()
    {
        return $this->belongsTo(FieldDataFieldOnline::class,'field_session_loc_location_value','entity_id');
    }
    public function fieldDataFieldSessionLocation()
    {
        return $this->belongsTo(FieldDataFieldSessionLocation::class,'field_session_loc_location_value','entity_id');
    }

}

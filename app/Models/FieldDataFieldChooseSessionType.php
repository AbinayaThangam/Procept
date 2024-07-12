<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldDataFieldChooseSessionType extends Model
{
    use HasFactory;
    protected $table='field_data_field_choose_session_type';
    protected $fillable = ['entity_type','bundle','deleted','entity_id','revision_id','language','delta','field_choose_session_type_value'];
}

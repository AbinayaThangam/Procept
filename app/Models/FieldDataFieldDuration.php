<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldDataFieldDuration extends Model
{
    use HasFactory;
    protected $table='field_data_field_duration';
    protected $fillable =['entity_type','bundle','deleted','entity_id','revision_id','language','delta','field_duration_value','field_duration_format'];

}

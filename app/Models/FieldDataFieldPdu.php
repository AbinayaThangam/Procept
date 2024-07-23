<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldDataFieldPdu extends Model
{
    use HasFactory;
    protected $table='field_data_field_pdu';
    protected $fillable = ['entity_type','bundle','deleted','entity_id','revision_id','language','delta','field_pdu_value','field_pdu_format'];
}

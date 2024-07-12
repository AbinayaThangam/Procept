<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FieldDataFieldStartDate1 extends Model
{
    use HasFactory;

    protected $table='field_data_field_start_date1';
    protected $fillable = ['entity_type','bundle','deleted','entity_id','revision_id','language','delta','field_start_date1_value'];

}



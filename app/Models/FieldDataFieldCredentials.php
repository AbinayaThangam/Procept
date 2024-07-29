<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldDataFieldCredentials extends Model
{
    use HasFactory;
    protected $table='field_data_field_credentials';
    protected $fillable =['entity_type','bundle','deleted','entity_id','revision_id','language','delta','field_credentials_value','field_credentials_format'];
}

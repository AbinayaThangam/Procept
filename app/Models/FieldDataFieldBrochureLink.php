<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldDataFieldBrochureLink extends Model
{
    use HasFactory;
    protected $table='field_data_field_brochure_link';
    protected $fillable = ['entity_type','bundle','deleted','entity_id','revision_id','language','delta','field_brochure_link_value','field_brochure_link_format'];
}

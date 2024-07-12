<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldDataFieldMedia extends Model
{
    use HasFactory;
    protected $table='field_data_field_media';
    protected $fillable = ['entity_type','bundle','deleted','entity_id','revision_id','language','delta','field_media_fid','field_media_title','field_media_data'];
}

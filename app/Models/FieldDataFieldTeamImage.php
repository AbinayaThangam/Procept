<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldDataFieldTeamImage extends Model
{
    use HasFactory;
    protected $table='field_data_field_team_image';
    protected $fillable =['entity_type','bundle','deleted','entity_id','revision_id','language','delta','field_team_image_fid','field_team_image_alt','field_team_image_title','field_team_image_width','field_team_image_height'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldDataFieldTeamSummary extends Model
{
    use HasFactory;
    protected $table='field_data_field_team_summary';
    protected $fillable =['entity_type','bundle','deleted','entity_id','revision_id','language','delta','field_team_summary_value','field_team_summary_format'];
}

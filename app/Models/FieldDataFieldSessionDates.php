<?php

namespace App\Models;

use App\Models\FieldDataFieldCourse;
use App\Models\FieldDataFieldResale;
use App\Models\FieldDataFieldStartDateOne;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldDataFieldSessionDates extends Model
{
    use HasFactory;

    protected $table = 'field_data_field_session_dates';
    protected $fillable = ['entity_type', 'bundle', 'deleted', 'entity_id', 'revision_id', 'language', 'delta', 'field_session_dates_value', 'field_session_dates_value2'];


}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldDataFieldIfYesEventbriteLink extends Model
{
    use HasFactory;

    protected $table='field_data_field_if_yes_eventbrite_link';
    protected $fillable = ['entity_type','bundle','deleted','entity_id','revision_id','language','delta','field_if_yes_eventbrite_link_value','field_if_yes_eventbrite_link_format'];
}

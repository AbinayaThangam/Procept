<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eventdate extends Model
{
    use HasFactory;
    protected $table = 'field_data_field_event_date';
    protected $fillable = [
        'entity_type',
        'bundle',
        'deleted',
        'entity_id',
        'language',
        'delta',
        'field_event_date_value',
        'field_event_date_value2'
    ];
}

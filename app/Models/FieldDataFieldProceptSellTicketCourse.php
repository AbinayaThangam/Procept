<?php

namespace App\Models;

use App\Models\FieldDataFieldIfYesEventbriteLink;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldDataFieldProceptSellTicketCourse extends Model
{
    use HasFactory;
    protected $table='field_data_field_procept_sell_ticket_course';
    protected $fillable = ['entity_type','bundle','deleted','entity_id','revision_id','language','delta','field_procept_sell_ticket_course_value'];
    public function fieldDataFieldIfYesEventbriteLinkResale()
    {
        return $this->belongsTo(FieldDataFieldIfYesEventbriteLink::class, 'entity_id','entity_id');
    }
}

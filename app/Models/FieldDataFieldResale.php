<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\FieldDataFieldProceptSellTicketCourse;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FieldDataFieldResale extends Model
{
    use HasFactory;
    protected $table='field_data_field_resale';
    protected $fillable = ['entity_type','bundle','deleted','entity_id','revision_id','language','delta','field_resale_value','field_resale_revision_id'];

    public function fieldDataFieldProceptSellTicketCourse()
    {
        return $this->belongsTo(FieldDataFieldProceptSellTicketCourse::class, 'field_resale_value','entity_id')->where('field_procept_sell_ticket_course_value','yes');
    }

}

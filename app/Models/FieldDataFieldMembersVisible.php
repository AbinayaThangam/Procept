<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldDataFieldMembersVisible extends Model
{
    use HasFactory;
    protected $table='field_data_field_members_visible';
    protected $fillable = ['entity_type','bundle','deleted','entity_id','revision_id','language','delta','field_members_visible_value'];

}

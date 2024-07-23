<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxonomyTermData extends Model
{
    use HasFactory;
    protected $table='taxonomy_term_data';
    protected $fillable =['tid','vid','name','description','format','weight','uuid'];

}

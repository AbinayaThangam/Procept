<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxonomyVocabulary extends Model
{
    use HasFactory;
    protected $table='taxonomy_vocabulary';
    protected $fillable =['vid','name','machine_name','description','hierarchy','module','weight'];

}

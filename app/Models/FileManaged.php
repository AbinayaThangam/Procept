<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FileManaged extends Model
{
    use HasFactory;
    protected $table='file_managed';
    protected $fillable = ['fid','uid','filename','uri','filemime','filesize','status','timestamp','type','uuid'];
}

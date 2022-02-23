<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sub_categories extends Model
{
    use HasFactory;

    protected $table = 'Sub_categories';
    
    protected $fillable =[
        'categories_type',
        'name',
        'image',
        'slug',
        'status',
     ];
}

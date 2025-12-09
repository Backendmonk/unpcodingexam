<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Model_question extends Model
{
    use HasFactory;

    protected $table = 'tb_question';
    protected $fillable = [
        'grade',
        'q',
        'items',
        'correct',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Simulate extends Model
{
  use HasFactory;

  public $fillable = [
    'id',
    'initial_value',
    'rate',
    'months',
    'result',
  ];
}

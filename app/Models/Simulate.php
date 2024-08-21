<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Simulate extends Model
{
  use HasFactory;

  public $fillable = [
    'id',
    'user_id',
    'initial_value',
    'rate',
    'months',
    'result',
    'final_value',
  ];

  public function user(): HasOne
  {
    return $this->hasOne(User::class);
  }
}

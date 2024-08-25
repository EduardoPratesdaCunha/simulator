<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
  use HasFactory, Notifiable, UsesUuid;

  protected $fillable = [
    'id',
    'name',
    'email',
    'password',
    'cpf',
  ];

  protected $guarded = ['id'];

  protected $keyType = "string";

  public $incrementing = false;

  protected $hidden = [
    'password',
    'remember_token',
  ];

  protected function casts(): array
  {
    return [
      'email_verified_at' => 'datetime',
      'password' => 'hashed',
    ];
  }

  public function simulates(): HasMany
  {
    return $this->hasMany(Simulate::class);
  }
}

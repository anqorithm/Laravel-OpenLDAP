<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use LdapRecord\Laravel\Auth\AuthenticatesWithLdap;
use LdapRecord\Laravel\Auth\HasLdapUser;
use LdapRecord\Laravel\Auth\LdapAuthenticatable;

class User extends Authenticatable implements LdapAuthenticatable
{
  use HasFactory, Notifiable, HasFactory, Notifiable, AuthenticatesWithLdap, HasLdapUser;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'name',
    'email',
    'password',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * Get the attributes that should be cast.
   *
   * @return array<string, string>
   */
  protected function casts(): array
  {
    return [
      'email_verified_at' => 'datetime',
      'password' => 'hashed',
    ];
  }

  public function getLdapDomainColumn(): string
  {
    return 'ldap_domain';
  }

  public function getLdapDomain(): ?string
  {
    return $this->domain;
  }

  public function setLdapDomain(?string $domain): void
  {
    $this->domain = $domain;
  }

  public function getLdapGuidColumn(): string
  {
    return 'guid';
  }

  public function getLdapGuid(): ?string
  {
    return $this->guid;
  }

  public function setLdapGuid(?string $guid): void
  {
    $this->guid = $guid;
  }
}

<?php

namespace App\Ldap;

use LdapRecord\Models\Model;
use LdapRecord\Models\Concerns\CanAuthenticate;
use Illuminate\Contracts\Auth\Authenticatable;
use LdapRecord\Laravel\Auth\LdapAuthenticatable;

class User extends Model implements Authenticatable,  LdapAuthenticatable
{
  use CanAuthenticate;

  public static array $objectClasses = ['...'];

  protected string $guidKey = 'uuid';

  public function getAuthIdentifier()
  {
    return $this->guidKey;
  }

  public function getLdapDomainColumn(): string
  {
    return 'ldap_host';
  }

  public function getLdapDomain(): ?string
  {
    return $this->ldap_host;
  }

  public function setLdapDomain(?string $domain): void
  {
    $this->ldap_host = $domain;
    $this->save();
  }

  public function getLdapGuidColumn(): string
  {
    return 'guid';
  }

  public function getLdapGuid(): ?string
  {
    return $this->ldap_guid;
  }

  public function setLdapGuid(?string $guid): void
  {
    $this->ldap_guid= $guid;
    $this->save();
  }
}



<?php

namespace redaelfillali\LaravelSecureModel;

use Illuminate\Database\Eloquent\Model;
use Stevebauman\Purify\Facades\Purify;

class SecureModel extends Model
{
  protected array $sanitizeAttributes = [];

  public function getAttribute($key)
  {
    $value = parent::getAttribute($key);

    if (in_array($key, $this->sanitizeAttributes) && is_string($value)) {
      return Purify::clean($value);
    }

    return $value;
  }

  public function setAttribute($key, $value)
  {
    if (in_array($key, $this->sanitizeAttributes) && is_string($value)) {
      $value = Purify::clean($value);
    }

    return parent::setAttribute($key, $value);
  }
}

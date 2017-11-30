<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    public function mobileFormat($mobile) {
      $output = substr($mobile, 0, 3) . '-' . substr($mobile, 3, 3) . '-' . substr($mobile, 6);
      return $output;
    }
}

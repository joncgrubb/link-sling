<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Message extends Model
{
    public function sender() {
      return $this->belongsTo('App\User', 'sender_id');
    }

    public function mobileFormat($mobile) {
      $output = substr($mobile, 0, 3) . '-' . substr($mobile, 3, 3) . '-' . substr($mobile, 6);
      return $output;
    }
}

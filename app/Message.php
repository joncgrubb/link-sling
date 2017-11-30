<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Message extends Model
{
    public function sender() {
      return $this->belongsTo('App\User', 'sender_id');
    }

    public function dateFormat() {
      $sent = Carbon::parse($this->sent_at);
      $time = '';
      if ($sent->hour > 11) {
        $time = $sent->hour - 12 . ':' . sprintf('%02d', $sent->minute) . ' pm';
      }
      else {
        $time = $sent->hour . ':' . sprintf('%02d', $sent->minute) . ' am';
      }
      $pretty = $sent->month . '/' . $sent->day . '/' . $sent->year . ' ' . $time;
      return $pretty;
    }

    public function mobileFormat($mobile) {
      $output = substr($mobile, 0, 3) . '-' . substr($mobile, 3, 3) . '-' . substr($mobile, 6);
      return $output;
    }
}

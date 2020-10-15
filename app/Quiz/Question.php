<?php

namespace App\Quiz;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public function quiz() {
        return $this->belongsTo("App\Quiz");
    }
}

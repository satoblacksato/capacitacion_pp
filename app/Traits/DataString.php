<?php

namespace App\Traits;

trait DataString{
    public function inlineObject(){
        return $this->name.' tiene como email '.$this->email;
    }
}
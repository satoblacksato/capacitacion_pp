<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Str;

class PhrasesBlock implements Rule
{
    private $phrases=['tarde','libro','ahora'];
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $validator=true;
        foreach ($this->phrases as $item){
            if(strpos(Str::lower($value),$item)){
                $validator=false;
                break;
            }
        }
        return $validator;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'El campo descripcion no debe contener '.implode(',',$this->phrases);
    }
}

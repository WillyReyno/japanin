<?php

namespace App\Services;

use Illuminate\Validation\Validator;

class FormDateValidation extends Validator {

    public function validateEndAfter($attribute, $value, $parameters) {
        $start_date = $this->getValue($parameters[0]);
        return (strtotime($value) > strtotime($start_date));
    }

}
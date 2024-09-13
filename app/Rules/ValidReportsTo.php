<?php

namespace App\Rules;

use Closure;
use App\Models\Position;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidReportsTo implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $reportsToEmptyCount = Position::whereNull('reports_to_id')->count(); 
         
        if($reportsToEmptyCount > 0 ) { 
            $exist = DB::table('positions')->where('id', $value)->exists(); 
            if(!$exist ){
                  $fail('Invalid Position To Report'); 
            }
        }
    }
}

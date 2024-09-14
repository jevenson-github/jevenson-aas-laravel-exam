<?php

namespace App\Rules;

use Closure;
use App\Models\Position;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidReportsTo implements ValidationRule
{
    private $id;

    public function __construct ($id = null) {
        $this->id = $id;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    

      // Create specific rule for storing positions or custom rule 
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $reportsToEmptyCount = Position::whereNull('reports_to_id')->count(); 
         

        // Will not update for same name position and reports_to 
        if ($this->id == $value && $this->id != NULL) {
            $fail('Reports to must not be the same as the position.');
        }
       
        // Check for first null value 
        if($reportsToEmptyCount > 0) { 
            $exist = DB::table('positions')->where('id', $value)->exists();

            if(!$exist){
                $fail('Invalid Position To Report'); 
            }
        }
    }
  
    // Error message 
    public function message()
    {
        return 'The validation error message.';
    }
}

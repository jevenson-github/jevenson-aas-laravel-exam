<?php

namespace App\Http\Controllers;

use App\Models\Position; 
use Illuminate\Http\Request;
use App\Rules\ValidReportsTo;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator; 



class PositionController extends Controller
{
    
     
public function index(){ 

    // Fetch details for dropdown from positions table 
    $positionsReportsToValues = DB::table('positions')->select('position_name','id')->get(); 
    
    
    // Fetch all values in table positons 
     $positionsList = DB::table('positions as p1')
                           ->leftjoin('positions as p2' , 'p1.reports_to_id' , '=' , 'p2.id' )
                           ->select('p1.position_name as position_name' , 'p2.position_name as reports_to')
                           ->get(); 
   

   $data['reports_to_values']  = $positionsReportsToValues; 
   $data['positions_list']     = $positionsList; 

    return response()->json($data , 201) ;   
    
}

    public function store(Request $request){ 
          
        $positionValidation = Validator::make($request->all(), [
             
             'position_name' => 'required|string|max:255|unique:positions' , 
             'reports_to_id' =>  [new ValidReportsTo] 
        ]);    
   

        // Check if validation fails 
        if( $positionValidation->fails() ){
              $data['error'] = $positionValidation->messages();
              $data['status'] = 422; 
              return response()->json($data,422) ;          
        }   
                
        // Proceed with creating new position 
        
        $positionInsert = Position::create([
            'position_name' => $request->position_name , 
            'reports_to_id'=> $request->reports_to_id
        ]); 
      

         if($positionInsert){ 
            $data['message'] = "Position Created Successfuly ."; 
            $data['status'] = 201;  
            return response()->json($data, 201);
         }
       
    }
}

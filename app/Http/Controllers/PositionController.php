<?php

namespace App\Http\Controllers;

use App\Models\Position; 
use Illuminate\Http\Request;
use App\Rules\ValidReportsTo;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\PositionResource;
use Illuminate\Support\Facades\Validator; 
use App\Http\Requests\StorePositionRequest;



class PositionController extends Controller
{
    
     
public function index(){ 

    // Fetch details for dropdown from positions table 
    //$positionsReportsToValues = DB::table('positions')->select('position_name','id')->get(); 
    
    
    // Fetch all values in table positions 
    //  $positionsList = DB::table('positions as p1')
    //                        ->leftjoin('positions as p2' , 'p1.reports_to_id' , '=' , 'p2.id' )
    //                        ->select('p1.position_name as position_name' , 'p2.position_name as reports_to', 'p1.id as position_id')
    //                        ->get(); 

   
    //$data['reports_to_values']  = $positionsReportsToValues; 
    //$data['positions_list']     = PositionResource::collection($positionsList); 


    // Load Positions with reports_to relationship
    $positionsList = Position::with(['reports_to'])->get();
    return PositionResource::collection($positionsList) ;   
    
}   

    public function store(StorePositionRequest $request){ 
          
        // $positionValidation = Validator::make($request->all(), [
             
        //      'position_name' => 'required|string|max:255|unique:positions' , 
        //      'reports_to_id' =>  [new ValidReportsTo] 
        // ]);    
   

        // // Check if validation fails 
        // if( $positionValidation->fails() ){
        //       $data['error'] = $positionValidation->messages();
        //       $data['status'] = 422; 
        //       return response()->json($data,422) ;          
        // }   
                
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
     

    public function show(Position $position){ 

            // $positionDetails = DB::table('positions as p1')
            //                     ->leftjoin('positions as p2' , 'p1.reports_to_id' , '=' , 'p2.id' )
            //                     ->select('p1.position_name as position_name' , 
            //                       DB::raw('COALESCE(p2.position_name, "") as reports_to'))
            //                     ->where('p1.id' , '=' , $position->id)
            //                     ->get(); 

            // $data['positions_details'] = $positionDetails ; 
            // $data['status'] = 201;  
            //  return response()->json($data, 201);       
            
        return new PositionResource($position);
    } 


    public function destroy(Position $position) {  

            $msg = $position->delete()
                ? "Position Deleted Successfuly."
                : "Unable to delete position";

            return response()->json([
                'message' => $msg,
            ]);

            // if($position->id){ 

            //     $deletePositions = DB::table('positions')->where('id' , '=' , $position->id)->delete();  
            //     $data['message'] = "Position Deleted Successfuly. "; 
            //     $data['status'] = 200;   

            //     return response()->json($data,200); 

            // }else {  

            //     $data['message'] = "Oops , Something went wrong in deleting positions ."; 
            //     $data['status'] = 500;   

            //     return response()->json($data, 500);

            // }
    } 

    public function update(Request $request , Position $position ){ 

        // $position->update([])

             if($position->id ){  
                   
                 $positionValidation = Validator::make($request->all(), [
                'position_name' => 'required|string|max:255|unique:positions' , 
                'reports_to_id' =>  [new ValidReportsTo] 
                 ]);  
              

                    if($positionValidation->fails()){ 

                        $data['error'] = $positionValidation->messages();
                        $data['status'] = 422;
                        return response()->json($data,422) ;   


                    } else {  

                                $position  = DB::table('positions')
                                            ->where('id', $position->id )
                                            ->update(['position_name' => $request->position_name , 'reports_to_id' => $request->reports_to_id]);  

                                 if($position){ 

                                    $data['messasge'] = "Position Successfuly Updated"; 
                                    $data['status'] = 200; 
                                    return response()->json($data,200) ;  

                                 }else {
                                    $data['message'] = "Oops , Something went wrong in updating positions ."; 
                                    $data['status'] = 500;   
                                    return response()->json($data,500) ;
                                 }
                                
                    } 

             }   

             else {
                $data['message'] = "Oops , Something went wrong in updating positions ."; 
                $data['status'] = 500;   
                return response()->json($data,500) ;
             }


    }
}

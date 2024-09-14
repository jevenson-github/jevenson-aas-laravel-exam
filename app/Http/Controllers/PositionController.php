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
use App\Http\Requests\UpdatePositionRequest;



class PositionController extends Controller
{
    
     
public function index (Request $request) { 
    $q = $request->get('q');
    $sort_order = $request->get('sort_order') ?? 'ASC';

    // Load Positions with reports_to relationship
    $positionsList = Position::with(['reports_to'])
        ->when(($q), function ($query) use ($q) {
            $query->where('position_name', 'LIKE', "%$q%");
        })
        ->orderBy('position_name', $sort_order)
        ->get(); 

    return PositionResource::collection($positionsList) ;   
    
}   

    public function store(StorePositionRequest $request){ 
          
        // Proceed with creating new position 

        $positionInsert = Position::create([
            'position_name' => $request->position_name , 
            'reports_to_id'=> $request->reports_to_id
        ]); 
      

         if($positionInsert){ 
            $data['message'] = "Position Created Successfuly ."; 
            return response()->json($data, 201);
         } 
    } 
     

    public function show(Position $position){  
        
         return new PositionResource($position); 
    } 


    public function destroy(Position $position) {  

            $msg = $position->delete()
                ? "Position Deleted Successfuly."
                : "Unable to delete position";

            return response()->json([
                'message' => $msg,
            ]);

    } 

    public function update(UpdatePositionRequest $request , Position $position ){ 

        $position->update(['position_name' => $request->position_name , 'reports_to_id' => $request->reports_to_id]);   

        if($position){ 

            $data['message'] = "Position Successfuly Updated"; 
        return response()->json($data,200) ;  

        }else {

            $data['message'] = "Oops , Something went wrong in updating positions ."; 
        return response()->json($data,500) ;
        }
                                


    }
}

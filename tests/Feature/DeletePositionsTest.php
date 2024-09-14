<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Position;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeletePositionsTest extends TestCase
{
    /**
     * A basic feature test example.
     */ 
    use RefreshDatabase; 
    
    public function test_delete_position_failed(){
        $this->insert_hierarchy(); 

        $response = $this->getJson(route('positon.destroy',[ 
            'position' => 999
        ])); 

        $response->assertStatus(404); 
      
    }

    public function test_delete_position_success(){  

        $this->insert_hierarchy();  

       $senior_dev_1 =  Position::factory()->create([
            'position_name' => 'Senior Dev 1',
            'reports_to_id' => $this->dev_lead->id
        ]); 

        $response = $this->deleteJson(route('positon.destroy',[ 
            'position' => $senior_dev_1
        ]));  

        $response->assertStatus(200);  
        
        // Compare the exact value o retrieve 
            $response->assertJsonStructure([
                'message'   
            ]);
            } 
        
}

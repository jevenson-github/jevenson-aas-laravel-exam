<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Position;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdatePositionsTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase; 

     public function test_update_failed_not_existing_position_name(){
        

        $response = $this->putJson(route('position.update',[ 
            'position' => 999
        ]));   

        $response->assertStatus(404);  

     } 

     public function test_update_failed_incomplete_position_name_field(){ 
        $this->insert_hierarchy();

        $senior_dev_1 =  Position::factory()->create([
            'position_name' => 'Senior Dev 1',
            'reports_to_id' => $this->dev_lead->id
        ]);

        $data = [
            'position_name' => null,
            'reports_to_id' => null
        ];

        $response = $this->putJson(route('position.update', [ 'position' => $senior_dev_1 ]), $data);   

        $response->assertStatus(422);   
            
         // Expect JSON Structure of Response
         $response->assertJsonStructure([
            'message',
            'errors' => [
                'position_name',
                'reports_to_id'
            ]
        ]);

     } 

     public function test_failed_update_set_report_to_itself(){ 

        $this->insert_hierarchy();

        $senior_dev_1 =  Position::factory()->create([
            'position_name' => 'Senior Dev 1',
            'reports_to_id' => $this->dev_lead->id
        ]); 

        $data = [
            'position_name' => 'Updated Senior Dev 1', 
            'reports_to_id' => $senior_dev_1->id
        ]; 

        $response = $this->putJson(route('position.update', [ 'position' => $senior_dev_1 ]), $data);   

        $response->assertStatus(422);    

          // Expect JSON Structure of Response
          $response->assertJsonStructure([
            'message',
            'errors' => [
                'reports_to_id'
            ]
        ]);
     } 

     public function test_success_update_position(){ 

        $this->insert_hierarchy(); 
        
      $senior_dev_1 =   Position::factory()->create([
            'position_name' => 'Senior Dev 1',
            'reports_to_id' => $this->dev_lead->id
        ]);  

        $data = [
            'position_name' => "QA Tester 1", 
            "reports_to_id" => $this->qa_lead->id
        ]; 

        $response = $this->putJson(route('position.update', [ 'position' => $senior_dev_1 ]), $data);
      
        $response->assertStatus(200);   

    // Expect JSON Structure of Response
          $response->assertJsonStructure([
            'message'
        ]); 

     }
}

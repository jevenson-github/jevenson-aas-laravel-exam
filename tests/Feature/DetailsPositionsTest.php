<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DetailsPositionsTest extends TestCase
{
    /**
     * A basic feature test example.
     */ 
    use RefreshDatabase; 

     public function test_position_details_success(){ 

        $this->insert_hierarchy();

        $response = $this->getJson(route('position.show', [
            'position' => $this->ceo
        ]));
        
        $response->assertStatus(200);
      
        // Compare the exact value o retrieve 
        $response->assertJson([
            'data' => [
                'id' => $this->ceo->id,
                'position_name' => $this->ceo->position_name, 
                 'reports_to'=> $this->ceo->reports_to?->position_name,
                 'reports_to_id'=> $this->ceo->reports_to_id

            ]
        ]);
     } 

    
}

<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Position;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListPositionsTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_successfully_retrieved () {
        $this->insert_hierarchy();

        Position::factory()->create([
            'position_name' => 'Senior Dev 1',
            'reports_to_id' => $this->dev_lead->id
        ]);

        $response = $this->getJson(route('position.index'));

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'position_name',
                    'reports_to',
                    'reports_to_id'
                ]
            ]
        ]);
    } 

    public function test_search_position_name_success(){ 
        
        $this->insert_hierarchy(); 
        $response = $this->getJson(route('position.index',[ 
            'q' => "Man" 
        ])); 
         

        $response->assertStatus(200);

        // With data inside
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'position_name',
                    'reports_to',
                    'reports_to_id'
                ]
            ]
        ]);
     } 

public function test_search_position_no_result(){
    $this->insert_hierarchy(); 
    $response = $this->getJson(route('position.index',[ 
        'q' => "qwerty" 
    ])); 

    $response->assertStatus(200);

    // No data inside 
    $response->assertJsonStructure([
        'data'
    ]);
}
}

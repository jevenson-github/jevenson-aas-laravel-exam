<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Position;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StorePositionsTest extends TestCase
{
    use RefreshDatabase;

    public function test_failed_saving_position_with_no_data () {
        $data = [
            'position_name' => null,
            'reports_to_id' => null
        ];

        $response = $this->postJson(route('position.store'), $data);

        // Expects 422 error code
        $response->assertStatus(422);

        // Expect JSON Structure of Response
        $response->assertJsonStructure([
            'message',
            'errors' => [
                'position_name'
            ]
        ]);
    }

    public function test_success_saving_position_with_no_reports_to_id () {
        $data = [
            'position_name' => 'CEO',
            'reports_to_id' => null
        ];

        $response = $this->postJson(route('position.store'), $data);

        // Expects 201 code
        $response->assertStatus(201);

        // Expects success message

        $response->assertJsonStructure([
            'message'
        ]);
    }

    public function test_failed_saving_another_position_with_no_reports_to_id () {
        $ceo = Position::factory()->create([
            'position_name' => 'CEO',
            'reports_to_id' => null
        ]);

        $data = [
            'position_name' => 'Another CEO',
            'reports_to_id' => null
        ];

        $response = $this->postJson(route('position.store'), $data);

        // Expects 201 code
        $response->assertStatus(422);

        // Expects success message

        $response->assertJsonStructure([
            'message',
            'errors' => [
                'reports_to_id'
            ]
        ]);
    }

    // Failed due to saving reports_to with not existing position 
    public function test_failed_saving_another_position () {
        $ceo = Position::factory()->create([
            'position_name' => 'CEO',
            'reports_to_id' => null
        ]);

        $data = [
            'position_name' => 'Position Under CEO',
            'reports_to_id' => 9999999
        ];

        $response = $this->postJson(route('position.store'), $data);

        // Expects 422 code
        $response->assertStatus(422);

        $response->assertJsonStructure([
            'message',
            'errors' => [
                'reports_to_id'
            ]
        ]);
    }

    public function test_success_saving_position_under_another_position () {
        $ceo = Position::factory()->create([
            'position_name' => 'CEO',
            'reports_to_id' => null
        ]);

        $data = [
            'position_name' => 'Position Under CEO',
            'reports_to_id' => $ceo->id
        ];

        $response = $this->postJson(route('position.store'), $data);

        $response->assertStatus(201);

        $response->assertJsonStructure([
            'message'
        ]);
    }
}

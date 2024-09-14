<?php

namespace Tests;

use App\Models\Position;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public $ceo;
    public $manager;
    public $dev_lead;
    public $qa_lead;

    public function insert_hierarchy (){
        $this->ceo = Position::factory()->create([
            'position_name' => 'CEO',
            'reports_to_id' => null
        ]);

        $this->manager = Position::factory()->create([
            'position_name' => 'Manager',
            'reports_to_id' => $this->ceo->id
        ]);

        $this->dev_lead = Position::factory()->create([
            'position_name' => 'Development Lead',
            'reports_to_id' => $this->manager->id
        ]);

        $this->qa_lead = Position::factory()->create([
            'position_name' => 'QA Lead',
            'reports_to_id' => $this->manager->id
        ]);
    }
}

<?php

namespace Tests\Feature;

use App\Models\Employee;
use App\Models\Skill;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EmployeesTest extends TestCase
{
    use RefreshDatabase;

    public function test_if_employee_loads_with_skills_and_successfull_page_load()
    {
        $employees = Employee::factory()
                 ->has(Skill::factory()->count(3))
                 ->count(10)
                 ->create();

        $response = $this->get(route('employees.index'));

        $response->assertStatus(200);
    }
}

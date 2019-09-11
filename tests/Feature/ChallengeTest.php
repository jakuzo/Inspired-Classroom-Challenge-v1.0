<?php

namespace Tests\Feature;

use App\Answer;
use App\Challenge;
use App\Feedback;
use App\Step;
use App\Teacher;
use App\Classroom;
use App\School;
use App\Administrator;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Contracts\Auth\Authenticatable;

class ChallengeTest extends TestCase
{
    use WithFaker;

    public function testCreate()
    {
        $response = $this->get(route('challenges.create'));
        $response->assertStatus(302);
    }



    public function testStore()
    {
          $name = $this->faker->company;
          $start = $this->faker->date('Y-m-d');
          $end = $this->faker->date('Y-m-d');
          $scen = $this->faker->randomHtml(1,1);
          $research = $this->faker->randomHtml(1,1);

          $challenge_create = [
            'name' => $name,
            'start_date' => $start,
            'end_date' => $end,
            'simulationinput' => $scen,
            'resourcesinput' => $research
          ];

        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->post(route('challenges.store', $challenge_create));
        $challenge = Challenge::where('name', $name)->get()->first();

        $this->assertEquals($name, $challenge->name);
        $start_date = $challenge->start_date->format('Y-m-d');
        $this->assertEquals($start, $start_date);
        $end_date = $challenge->end_date->format('Y-m-d');
        $this->assertEquals($end, $end_date);
        $this->assertEquals($scen, $challenge->scenario);
        $this->assertEquals($research, $challenge->research);
    }

    public function testShow()
    {
        $challenge = factory(Challenge::class)->create();
        $response = $this->get(route('challenges.show', $challenge));
        $response->assertStatus(302);
    }

    public function testEdit()
    {
        $challenge = factory(Challenge::class)->create();
        $response = $this->get(route('challenges.edit_challenge', $challenge));
        $response->assertStatus(302);
    }

    public function testUpdate()
    {
        $challenge = factory(Challenge::class)->create();
        $response = $this->post(route('challenges.update', $challenge));
        $response->assertStatus(302);
    }

    /**
     * A test creating and editing a user
     */
    public function testDestroy()
    {
        $challenge = factory(Challenge::class)->create();
        $response = $this->get(route('challenges.update', $challenge));
        $response->assertStatus(302);
    }
}

<?php

namespace Tests\Feature;

use App\Administrator;
use App\Evaluator;
use App\Student;
use App\Teacher;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use WithFaker;

    public function testGetCreateView()
    {
        $response = $this->get(route('register'));

        $response->assertStatus(200);
    }

    public function testCreateAdministrator()
    {
        $new_name = $this->faker->name;
        $new_email = $this->faker->unique()->safeEmail;

        $user_create = [
            'name' => $new_name,
            'email' => $new_email,
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
            'password_confirmation' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
            'user_type' => 'administrator'
        ];

        $response = $this->post('register', $user_create);
        $user = User::where('email', $new_email)->first();
        $administrator = Administrator::where('user_id', $user->id)->first();

        $this->assertEquals($new_name, $user->name);
        $this->assertEquals($new_email, $user->email);
        $this->assertEquals($user->id, $administrator->user_id);
    }

    public function testCreateEvaluator()
    {
        $new_name = $this->faker->name;
        $new_email = $this->faker->unique()->safeEmail;

        $user_create = [
            'name' => $new_name,
            'email' => $new_email,
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
            'password_confirmation' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
            'user_type' => 'evaluator'
        ];

        $response = $this->post('register', $user_create);
        $user = User::where('email', $new_email)->first();
        $evaluator = Evaluator::where('user_id', $user->id)->first();

        $this->assertEquals($new_name, $user->name);
        $this->assertEquals($new_email, $user->email);
        $this->assertEquals($user->id, $evaluator->user_id);
    }

    public function testCreateStudent()
    {
        $new_name = $this->faker->name;
        $new_email = $this->faker->unique()->safeEmail;

        $user_create = [
            'name' => $new_name,
            'email' => $new_email,
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
            'password_confirmation' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
            'user_type' => 'student'
        ];

        $response = $this->post('register', $user_create);
        $user = User::where('email', $new_email)->first();
        $student = Student::where('user_id', $user->id)->first();

        $this->assertEquals($new_name, $user->name);
        $this->assertEquals($new_email, $user->email);
        $this->assertEquals($user->id, $student->user_id);
    }

    public function testCreateTeacher()
    {
        $new_name = $this->faker->name;
        $new_email = $this->faker->unique()->safeEmail;

        $user_create = [
            'name' => $new_name,
            'email' => $new_email,
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
            'password_confirmation' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
            'user_type' => 'teacher'
        ];

        $response = $this->post('register', $user_create);
        $user = User::where('email', $new_email)->first();
        $teacher = Teacher::where('user_id', $user->id)->first();

        $this->assertEquals($new_name, $user->name);
        $this->assertEquals($new_email, $user->email);
        $this->assertEquals($user->id, $teacher->user_id);
    }

    public function testCreateTeacherWithSchoolandZipcode()
    {
        $new_name = $this->faker->name;
        $new_email = $this->faker->unique()->safeEmail;

        $user_create = [
            'name' => $new_name,
            'email' => $new_email,
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
            'password_confirmation' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
            'user_type' => 'teacher',
            'school' => 0,
            'school_name' => 'University of Montana',
            'school_address_line' => '32 Campus Dr',
            'school_frlp' => 50,
            'school_zip' => 0,
            'zip_code' => "59812",
            'zip_state' => 88,
            'zip_city' => 'Missoula'
        ];

        $response = $this->post('register', $user_create);
        $user = User::where('email', $new_email)->first();
        $teacher = Teacher::where('user_id', $user->id)->first();
        $school = $teacher->school;
        $zipcode = $school->zipcode;
        $state = $zipcode->state;

        $this->assertEquals($new_name, $user->name);
        $this->assertEquals($new_email, $user->email);
        $this->assertEquals($user->id, $teacher->user_id);
        $this->assertEquals('University of Montana', $school->name);
        $this->assertEquals('32 Campus Dr', $school->address_line);
        $this->assertEquals(50, $school->frlp);
        $this->assertEquals(59812, $zipcode->zip);
        $this->assertEquals('Missoula', $zipcode->city);
        $this->assertEquals('Montana', $state->name);
    }

    public function testGetEditView()
    {
        $user = factory(User::class)->create();
        $response = $this->get(route('users.edit', $user));

        $response->assertStatus(302);
    }

    /**
     * A test creating and editing a user
     */
    public function testEditUser()
    {
        $user = factory(User::class)->create();

        $new_name = $this->faker->name;
        $new_email = $this->faker->unique()->safeEmail;

        $user_edit = [
            'name' => $new_name,
            'email' => $new_email,
            'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
            'password_confirmation' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        ];

        $response = $this->actingAs($user)->post(route('users.update', $user), $user_edit);
        $user->refresh();

        $this->assertEquals($new_name, $user->name);
        $this->assertEquals($new_email, $user->email);
    }

    public function testLoginView()
    {
        $response = $this->get(route('login'));

        $response->assertStatus(200);
    }

    public function testUserLogin()
    {
        $password = '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm';

        $student = factory(Student::class)->create();

        $data = [
            'email' => $student->user->email,
            'password' => $password
        ];

        $response = $this->post('login', $data);

        $response->assertStatus(302);
    }

    public function testUserLogout()
    {
        $password = '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm';

        $student = factory(Student::class)->create();

        $data = [
            'email' => $student->user->email,
            'password' => $password
        ];

        $response = $this->post('login', $data);
        $response->assertStatus(302);

        $response2 = $this->post('logout', $data);
        $response2->assertStatus(302);
    }
}

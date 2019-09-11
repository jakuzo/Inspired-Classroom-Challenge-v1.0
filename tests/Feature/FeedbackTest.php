<?php

namespace Tests\Feature;

use App\Evaluator;
use App\Feedback;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FeedbackTest extends TestCase
{
    use WithFaker;

    /**
     * A test creating and editing a feedback
     */
    public function testEditFeedback()
    {
        $evaluator = factory(Evaluator::class)->create();
        $feedback = factory(Feedback::class)->create();

        $text = $this->faker->realText();
        $grade = $this->faker->numberBetween(0,4);

        $feedback_edit = [
            'text' => $text,
            'grade' => $grade,
            'ready' => true
        ];

        $response = $this->actingAs($evaluator->user)->post(route('feedback.update', $feedback), $feedback_edit);
        $evaluator->refresh();
        $feedback->refresh();

        $this->assertEquals($text, $feedback->text);
        $this->assertEquals($grade, $feedback->grade);
    }
}

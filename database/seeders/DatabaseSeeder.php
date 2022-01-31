<?php

namespace Database\Seeders;

use App\Models\Choice;
use App\Models\Question;
use App\Models\Subject;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        User::factory()->create([
            // 'first_name' => 'John',
            // 'last_name' => 'Doe',
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            // 'password' => Hash::make('password'),

        ]);

        $subject = Subject::factory()->create();
        Topic::factory(5)
            ->has(Question::factory()->hasChoices(5)->count(5))
            ->create(['subject_id' => $subject->id]);

        for ($i = 0; $i < 5; $i++) {
            $subject = Subject::factory()->create();

            Topic::factory(5)
                ->has(Question::factory()->hasChoices(5)->count(5))
                ->create(['subject_id' => $subject->id]);
        }
            
        $questions = Question::all();

        foreach ($questions as $q) {
            $choice = Choice::where('question_id', $q->id)->inRandomOrder()->first();
            $choice->is_correct = true;
            $choice->save();
        }
    }
}

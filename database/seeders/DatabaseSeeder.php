<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Quiz;
use App\Models\Question;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create Admin User
        User::create([
            'name' => 'Admin',
            'email' => 'admin@quiz.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create Sample Users
        User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
            'role' => 'pelajar',
        ]);

        User::create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'password' => Hash::make('password'),
            'role' => 'masyarakat',
        ]);

        // Create Sample Quiz for Pelajar
        $quiz1 = Quiz::create([
            'title' => 'Matematika Dasar',
            'description' => 'Quiz matematika untuk pelajar',
            'target_role' => 'pelajar',
            'time_limit' => 30,
        ]);

        // Sample Questions for Pelajar Quiz
        Question::create([
            'quiz_id' => $quiz1->id,
            'question' => 'Berapakah hasil dari 2 + 2?',
            'option_a' => '3',
            'option_b' => '4',
            'option_c' => '5',
            'option_d' => '6',
            'correct_answer' => 'b',
            'explanation' => '2 + 2 = 4. Ini adalah operasi penjumlahan dasar.',
            'order' => 1,
        ]);

        Question::create([
            'quiz_id' => $quiz1->id,
            'question' => 'Berapa hasil dari 10 x 5?',
            'option_a' => '45',
            'option_b' => '50',
            'option_c' => '55',
            'option_d' => '60',
            'correct_answer' => 'b',
            'explanation' => '10 x 5 = 50. Perkalian 10 dengan 5 menghasilkan 50.',
            'order' => 2,
        ]);

        // Create Sample Quiz for Masyarakat
        $quiz2 = Quiz::create([
            'title' => 'Pengetahuan Umum',
            'description' => 'Quiz pengetahuan umum untuk masyarakat',
            'target_role' => 'masyarakat',
            'time_limit' => 45,
        ]);

        // Sample Questions for Masyarakat Quiz
        Question::create([
            'quiz_id' => $quiz2->id,
            'question' => 'Siapa presiden pertama Indonesia?',
            'option_a' => 'Suharto',
            'option_b' => 'Sukarno',
            'option_c' => 'Habibie',
            'option_d' => 'Megawati',
            'correct_answer' => 'b',
            'explanation' => 'Sukarno adalah presiden pertama Republik Indonesia yang menjabat dari 1945-1967.',
            'order' => 1,
        ]);

        Question::create([
            'quiz_id' => $quiz2->id,
            'question' => 'Apa ibu kota Indonesia?',
            'option_a' => 'Surabaya',
            'option_b' => 'Bandung',
            'option_c' => 'Jakarta',
            'option_d' => 'Medan',
            'correct_answer' => 'c',
            'explanation' => 'Jakarta adalah ibu kota negara Indonesia sejak kemerdekaan.',
            'order' => 2,
        ]);
    }
}
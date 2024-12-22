<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AchievementSeeder extends Seeder
{
    public function run()
    {
        DB::table('achievements')->insert([
            // **Beginner Achievements**
            [
                'title' => 'First Step',
                'description' => 'Complete your first goal.',
                'type' => 'beginner',
                'icon' => 'first-step.svg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Pioneer',
                'description' => 'Create your first collection.',
                'type' => 'beginner',
                'icon' => 'pioneer.svg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Conqueror',
                'description' => 'Complete your first collection.',
                'type' => 'beginner',
                'icon' => 'conqueror.svg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Magician',
                'description' => 'Personalize your profile.',
                'type' => 'beginner',
                'icon' => 'magician.svg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // **Productivity Achievements**
            [
                'title' => 'Turbo Productivity',
                'description' => 'Complete 5 goals in a day.',
                'type' => 'productivity',
                'icon' => 'turbo-productivity.svg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Goal Marathon',
                'description' => 'Complete 25 goals in total.',
                'type' => 'productivity',
                'icon' => 'goal-marathon.svg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Golden Legacy',
                'description' => 'Complete 50 goals in total.',
                'type' => 'productivity',
                'icon' => 'golden-legacy.svg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Daily Ritual',
                'description' => 'Complete goals for 7 consecutive days.',
                'type' => 'productivity',
                'icon' => 'daily-ritual.svg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Master Habit',
                'description' => 'Complete goals for 15 consecutive days.',
                'type' => 'productivity',
                'icon' => 'master-habit.svg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Disciplined',
                'description' => 'Complete goals for 30 consecutive days.',
                'type' => 'productivity',
                'icon' => 'disciplined.svg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // **Collection Achievements**
            [
                'title' => 'Collector',
                'description' => 'Complete 5 different collections (Not cyclic).',
                'type' => 'collection',
                'icon' => 'collector.svg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Visionary',
                'description' => 'Complete a collection that took more than 1 month to complete.',
                'type' => 'collection',
                'icon' => 'visionary.svg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Architect of the Future',
                'description' => 'Plan a collection for the next 6 months.',
                'type' => 'collection',
                'icon' => 'architect-of-the-future.svg',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // **Social Achievements**
            [
                'title' => 'Inspiring',
                'description' => 'Share a completed goal and motivate others.',
                'type' => 'social',
                'icon' => 'inspiring.svg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Ally',
                'description' => 'Create a collaborative collection.',
                'type' => 'social',
                'icon' => 'ally.svg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Dream Team',
                'description' => 'Complete a collaborative collection.',
                'type' => 'social',
                'icon' => 'dream-team.svg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

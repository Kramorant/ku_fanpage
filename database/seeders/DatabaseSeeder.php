<?php

namespace Database\Seeders;

use App\Models\Kaiju;
use App\Models\KaijuAttack;
use App\Models\KaijuRegen;
use App\Models\KaijuSpeed;
use App\Models\KaijuStat;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name'     => 'Admin',
                'password' => Hash::make('password'),
                'role'     => 'admin',
            ]
        );

        // Example Kaiju: Godzilla
        $godzilla = Kaiju::firstOrCreate(
            ['slug' => 'godzilla'],
            [
                'name'        => 'Godzilla',
                'description' => 'The King of the Monsters. A massive prehistoric creature awakened by nuclear testing, Godzilla is one of the most powerful kaiju in existence. Armed with devastating atomic breath and incredible regeneration, he stands as both protector and destroyer.',
                'image'       => null,
            ]
        );

        // Stats
        $statsData = [
            'strength' => [
                'current_level' => 5,
                'values'        => [100, 200, 300, 400, 500, 600, 700, 800, 900, 1000],
            ],
            'speed' => [
                'current_level' => 5,
                'values'        => [10, 11, 12, 13, 14, 15, 16, 17, 18, 20],
            ],
            'health' => [
                'current_level' => 5,
                'values'        => [2000, 2333, 2667, 3000, 3333, 3667, 4000, 4333, 4667, 5000],
            ],
            'regen' => [
                'current_level' => 5,
                'values'        => [0.5, 0.7, 0.9, 1.1, 1.3, 1.5, 1.7, 1.9, 2.1, 2.5],
            ],
        ];

        foreach ($statsData as $type => $data) {
            $statRow = ['kaiju_id' => $godzilla->id, 'stat_type' => $type];
            $fill = array_merge($statRow, ['current_level' => $data['current_level']]);
            for ($i = 1; $i <= 10; $i++) {
                $fill["val_{$i}"] = $data['values'][$i - 1];
            }
            KaijuStat::updateOrCreate($statRow, $fill);
        }

        // Attacks
        $attacks = [
            ['name' => 'Atomic Breath',  'damage' => 949.00,  'description' => 'A concentrated beam of atomic energy fired from the mouth. Capable of melting steel and decimating entire city blocks.', 'order' => 0],
            ['name' => 'Tail Whip',      'damage' => 650.00,  'description' => 'A powerful sweep of the massive tail that knocks back any enemy in range.',                                             'order' => 1],
            ['name' => 'Nuclear Pulse',  'damage' => 1200.00, 'description' => 'An omnidirectional burst of nuclear energy released from the body, devastating everything nearby.',                    'order' => 2],
        ];

        $godzilla->attacks()->delete();
        foreach ($attacks as $atk) {
            KaijuAttack::create(array_merge(['kaiju_id' => $godzilla->id], $atk));
        }

        // Speed
        KaijuSpeed::updateOrCreate(
            ['kaiju_id' => $godzilla->id],
            [
                'walking_speed'   => 15.5,
                'sprinting_speed' => 25.0,
                'swimming_speed'  => 10.0,
            ]
        );

        // Regen
        KaijuRegen::updateOrCreate(
            ['kaiju_id' => $godzilla->id],
            [
                'health_regen_pct' => 1.5,
                'charge_regen_pct' => 2.0,
            ]
        );
    }
}

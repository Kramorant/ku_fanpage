<?php

namespace Database\Seeders;

use App\Models\Kaiju;
use App\Models\KaijuAttack;
use App\Models\KaijuBaseStat;
use App\Models\KaijuSpeed;
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

        // Base Stats (health & regen)
        KaijuBaseStat::updateOrCreate(
            ['kaiju_id' => $godzilla->id],
            [
                'health_min' => 1000.00,
                'health_max' => 5000.00,
                'regen_min'  => 1.00,
                'regen_max'  => 5.00,
            ]
        );

        // Attacks with min/max damage
        $godzilla->attacks()->delete();
        $attacks = [
            ['name' => 'Atomic Breath', 'damage_min' => 800.00,  'damage_max' => 1200.00, 'description' => 'A powerful beam of atomic energy fired from Godzilla\'s mouth.',                'order' => 1],
            ['name' => 'Tail Swipe',    'damage_min' => 400.00,  'damage_max' => 650.00,  'description' => 'Godzilla swings his massive tail dealing wide-area damage.',                    'order' => 2],
            ['name' => 'Nuclear Pulse', 'damage_min' => 600.00,  'damage_max' => 950.00,  'description' => 'An omnidirectional burst of nuclear energy emanating from Godzilla\'s body.',  'order' => 3],
        ];
        foreach ($attacks as $atk) {
            KaijuAttack::create(array_merge(['kaiju_id' => $godzilla->id], $atk));
        }

        // Speed (Godzilla can't fly, so flying = null)
        KaijuSpeed::updateOrCreate(
            ['kaiju_id' => $godzilla->id],
            [
                'walking_min'   => 12.00, 'walking_max'   => 20.00,
                'sprinting_min' => 20.00, 'sprinting_max' => 35.00,
                'swimming_min'  => 8.00,  'swimming_max'  => 15.00,
                'flying_min'    => null,  'flying_max'    => null,
            ]
        );
    }
}

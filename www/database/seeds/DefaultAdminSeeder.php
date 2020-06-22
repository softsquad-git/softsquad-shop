<?php

use Illuminate\Database\Seeder;

class DefaultAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\User::create([
            'email' => 'test@example.pl',
            'password' => \Illuminate\Support\Facades\Hash::make('start123'),
            'is_activate' => 1,
            'role' => \App\Helpers\Role::SS_R_ADMIN,
        ]);
        $data = [
            'user_id' => $user->id,
            'name' => 'Michał',
            'last_name' => 'Łosak',
            'nick' => 'michalos',
            'location' => '26-021 Daleszyce, ul. Zagórze 1',
            'sex' => 2,
            'contact_phone' => '+48 576-711-801'
        ];
        \App\Models\Users\SpecificData::create($data);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'username' => 'Administrator',
            'email' => 'admingacor@email.com',
            'password' => Hash::make('S3m0g@Gu@D@p3tMagangS3b3lum13Des_ember'), // AAMIIN YA ALLAH DAPET MAGANG KALAU BISA LEWAT ENRICHMENT APP LANGSUNG
            'role' => 'admin',
        ]);
    }
}

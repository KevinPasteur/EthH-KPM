<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Import the roles from the Model
        $roles = Role::all();

        // Create a user for each role
        foreach ($roles as $role) {

            // uncapitalize the role name
            $role['name'] = strtolower($role['name']);

            // change letters with accent to letters without accent
            $role['name'] = str_replace('É', 'e', $role['name']);
            $role['name'] = str_replace('é', 'e', $role['name']);


            User::create([
                'email' => $role['name'] . '@' . $role['name'] . '.com',
                'password' => Hash::make('Pa$$w0rdEth123'),
                'role_id' => $role['_id'],
            ]);
        }
    }
}

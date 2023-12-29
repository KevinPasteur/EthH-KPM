<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $roles = [
            ['name' => 'Administrateur', 'description' => 'Administrateur du système'],
            ['name' => 'Éditeur', 'description' => 'Peut éditer du contenu'],
            ['name' => 'Lecteur', 'description' => 'Peut lire du contenu'],
            ['name' => 'Invité', 'description' => "Accès en tant qu'invité"],
            ['name' => 'Désactivé', 'description' => 'Utilisateur désactivé'],
        ];

        foreach ($roles as $role) {
            Role::create($role); // Use the 'Role' class to create the role
        }
    }
}

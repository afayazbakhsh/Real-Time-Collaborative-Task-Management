<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Enums\RoleTypesEnum;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Loop through each role in the RoleTypesEnum and create it
        foreach (RoleTypesEnum::cases() as $roleType) {
            Role::firstOrCreate(['name' => $roleType->value]);
        }
    }
}

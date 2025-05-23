<?php

namespace Modules\Apps\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Modules\Area\Database\Seeders\SeedAreaModule;
use Modules\Authorization\Database\Seeders\PermissionsSeederTableSeeder;
use Modules\Authorization\Database\Seeders\RoleSeederTableSeeder;
use Modules\Catalog\Database\Seeders\SeedNationalitiesTableSeeder;
use Modules\Donations\Entities\DonationStatus;
use Modules\User\Entities\User;

class SetupAppTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();
        Model::unguard();
        (new SeedNationalitiesTableSeeder())->run();
        (new SeedAreaModule())->run();
        (new PermissionsSeederTableSeeder())->run();
        (new RoleSeederTableSeeder())->run();
        $this->insertUserRole($this->insertUser());
        DB::commit();
    }

    private function insertUser()
    {
        return User::create([
            'name' => 'admin',
            'mobile' => '01234567891',
            'email' => 'admin@tocaan.com',
            'password' => '$2y$10$SATJLNhq6VuGS0FeYwVtvOyeZJAPfgnuAxJSJEw.ChdvUNnv80l7u',
        ]);
    }

    private function insertUserRole($user)
    {
        $user->assignRole(['super-admin']);
    }
}

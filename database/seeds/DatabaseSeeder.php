<?php

use Illuminate\Database\Seeder;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      // $this->call(UsersTableSeeder::class);
      // Apaga toda a tabela de usuários
      DB::table('users')->truncate();
      // Cria usuários admins (dados controlados)
      $this->createAdmins();
    }

    private function createAdmins()
    {
      User::create([
        'name' => 'Felipe',
        'username' => 'felipe_adm',
        'password' => bcrypt('fw3yzahp'),
        'type' => 'admin',
        'school' => '0',
      ]);
      // Exibe uma informação no console durante o processo de seed
      $this->command->info('User felipe_adm created');
    }
}

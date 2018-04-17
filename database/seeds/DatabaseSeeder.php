<?php

use Illuminate\Database\Seeder;
use App\Models\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->call('UsersTableSeeder');
    }
}

class UsersTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        User::create(['email' => 'xiaoyue986@qq.com','name' => 'kuner','password' => '$10$paSq2xz1urQTp35RsZ/cquIGm.3Rfm8UJDWu.QxtS1e7JvHoJVDPG']);
    }

}
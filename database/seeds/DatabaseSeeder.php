<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        // DB::table('users')->insert([
        //   'first_name' => Str::random(10),
        //   'last_name' => Str::random(10),
        //   'email' => Str::random(10).'@mailinator.com',
        //   'username' => Str::random(10),
        //   'password' => Hash::make('password'),
        //   'status' => 1
        // ]);

        // users table

        factory(App\Users::class, 10)->create();

        // roles table

        DB::table('roles')->insert(
          ['role_name' => 'Administrator'],
        );

        DB::table('roles')->insert(
          ['role_name' => 'User'],
        );

        // users_roles table

        $roles = App\Roles::all();
        
        App\Users::all()->each(function($user) use ($roles) {
          $user->roles()->attach(
            $roles->random(rand(1, 2))->pluck('id')->toArray()
          );
        });

        // categories table

        DB::table('categories')->insert(
          [
            'category_name' => 'Mobile Phones',
            'category_url' => 'mobile-phones'
          ]
        );

        DB::table('categories')->insert(
          [
            'category_name' => 'Cameras',
            'category_url' => 'cameras'
          ]
        );

        // products table

        $admin_ids = App\UsersRoles::where('role_id', 1)->take(2)->get(); // get two admins

        DB::table('products')->insert([
          'admin_id' => $admin_ids[0]['user_id'],
          'product_name' => 'Google Pixel 4',
          'product_description' => '<ul><li>Display - 5.7 inch Fullscreen display</li><li>Battery - 2800 mAh</li><li>Processors - Qualcomm Snapdragon 855 - 2.87 GHz + 1.78GHz, 64-bit Octa-Core</li><li>Rear Camera - 16 MP</li><li>Front Camera - 8 MP</li><li>Sensors - Active Edge, Accelerometer/Gyrometer, Proximity, Motion</li></ul>',
          'category_id' => 1,
          'product_price' => 999,
        ]);

        DB::table('products')->insert([
          [
            'admin_id' => $admin_ids[1]['user_id'],
            'product_name' => 'Canon EOS 1500D DSLR Camera',
            'product_description' => '<ul><li>24.1 MP APS-C CMOS Sensor</li><li>Full HD Video Recording</li><li>Wi-Fi + NFC</li><li>DIGIC 4+ Imaging Processor</li><li>High Resolution 3" LCD Screen</li><li>100-6400 ISO Speed</li></ul>',
            'category_id' => 2,
            'product_price' => 549,
          ]
        ]);
    }
}

<?php

use App\Admin;
use App\Settings;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //DB::table('users')->insert(['name' => 'user','email' => 'user@user.com','password' => bcrypt('password'), ]);
        //factory(User::class,10)->create();
        //DB::table('admins')->insert(['user_name' => 'admin','email' => 'admin@admin.com','password' => bcrypt('password'), ]);
        //factory(Admin::class,10)->create();

        //factory(Settings::class,1)->create();

        DB::table('categories')->insert(
            array(
                ['name' => 'ملابس رجالى' , 'slug' => Str::slug('ملابس رجالى') , 'description' => 'n' , 'visible' => '1' , 'category_id' => null],
                ['name' => 'ملابس نسائى' , 'slug' => Str::slug('ملابس نسائى') , 'description' => 'n' , 'visible' => '1' , 'category_id' => null],
                ['name' => 'ملابس أطفال' , 'slug' => Str::slug('ملابس أطفال') , 'description' => 'n' , 'visible' => '1' , 'category_id' => null],
                ['name' => 'صحة وجمال' , 'slug' => Str::slug('صحة وجمال') , 'description' => 'n' , 'visible' => '1' , 'category_id' => null],
                ['name' => 'عطور' , 'slug' => Str::slug('عطور') , 'description' => 'n' , 'visible' => '1' , 'category_id' => null],
                ['name' => 'خردوات' , 'slug' => Str::slug('خردوات') , 'description' => 'n' , 'visible' => '1' , 'category_id' => null],
                ['name' => 'الكترونيات' , 'slug' => Str::slug('الكترونيات') , 'description' => 'n' , 'visible' => '1' , 'category_id' => null],
            )
        );

        $cat_two = DB::table('categories')->where('name' , 'ملابس نسائى')->pluck('id');

        $cat_two_list = array('بجايم وقمصان','ملابس داخليه','فساتين وازياء حوال','بناطيل وبلايز','مقاسات كبيره','عبايات');

        foreach ($cat_two_list as $cat) {
            DB::table('categories')->insert(['name' => $cat , 'slug' => Str::slug($cat) , 'description' => 'n' , 'visible' => '1' , 'category_id' => $cat_two[0]]);
        }


    }
}

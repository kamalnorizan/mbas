<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        Category::factory(10)->create();
        Post::factory(500)->create();
        Comment::factory(1000)->create();

        Role::create(['name' => 'admin']);
        Role::create(['name' => 'user']);

        User::each(function ($user) {
            $user->assignRole('user');
        });

        $userAdmin = User::find(1)->assignRole('admin');
        echo 'Admin : ' . $userAdmin->email . ' created' . PHP_EOL;
        echo 'Password : password' . PHP_EOL;


    }
}

<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Post;
use App\Models\User;
use App\Models\Iklan;
use Ramsey\Uuid\Uuid;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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


        Role::create(['uuid'=>Uuid::uuid4(), 'name' => 'admin', 'description' => 'Administrator can access all modules and functions']);
        Role::create(['uuid'=>Uuid::uuid4(), 'name' => 'user', 'description' => 'User can view and comment post']);
        Role::create(['uuid'=>Uuid::uuid4(), 'name' => 'author', 'description' => 'Author can create, edit, delete post']);
        Role::create(['uuid'=>Uuid::uuid4(), 'name' => 'publisher', 'description' => 'Publisher can create, edit, delete post and publish post']);

        Permission::create(['name' => 'create-post']);
        Permission::create(['name' => 'edit-post']);
        Permission::create(['name' => 'delete-post']);
        Permission::create(['name' => 'publish-post']);

        Permission::create(['name' => 'show-iklan']);
        Permission::create(['name' => 'create-iklan']);
        Permission::create(['name' => 'edit-iklan']);
        Permission::create(['name' => 'delete-iklan']);

        Permission::create(['name' => 'create-comment']);
        Permission::create(['name' => 'delete-comment']);

        Permission::create(['name' => 'assign-role']);
        Permission::create(['name' => 'create-role']);
        Permission::create(['name' => 'update-role']);
        Permission::create(['name' => 'assign-permission']);

        Role::findByName('admin')->givePermissionTo([
            'create-post',
            'edit-post',
            'delete-post',
            'publish-post',
            'create-iklan',
            'edit-iklan',
            'delete-iklan',
            'create-comment',
            'delete-comment',
            'assign-role',
            'assign-permission',
            'create-role',
            'update-role'
        ]);

        Role::findByName('author')->givePermissionTo([
            'create-post',
            'edit-post',
            'delete-post',
            'delete-comment',
        ]);

        Role::findByName('publisher')->givePermissionTo([
            'create-post',
            'edit-post',
            'delete-post',
            'publish-post',
            'delete-comment',
        ]);

        Role::findByName('user')->givePermissionTo([
            'create-comment',
        ]);

        User::each(function ($user) {
            $user->assignRole('user');
        });

        Iklan::factory(20)->create();

        $userAdmin = User::whereIn('id',[1,2,3])->get()->each(function($user) { $user->assignRole('admin'); });
        echo 'Admin : ' . $userAdmin->first()->email . ' created' . PHP_EOL;
        echo 'Password : password' . PHP_EOL;

        $userAuthor = User::whereIn('id',[4,5,6])->get()->each(function($user) { $user->assignRole('author'); });
        echo 'Author : ' . $userAuthor->first()->email . ' created' . PHP_EOL;
        echo 'Password : password' . PHP_EOL;

        $userPublisher = User::whereIn('id',[7,8,9])->get()->each(function($user) { $user->assignRole('publisher'); });

        echo 'Publisher : ' . $userPublisher->first()->email . ' created' . PHP_EOL;
        echo 'Password : password' . PHP_EOL;


    }
}

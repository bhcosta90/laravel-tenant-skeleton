<?php

namespace Database\Seeders;

use Core\Modules\User\Domain\UserEntity;
use Core\Shared\ValueObjects\Input\EmailInputObject;
use Core\Shared\ValueObjects\Input\NameInputObject;
use Core\Shared\ValueObjects\Input\PasswordInputObject;
use Illuminate\Database\Seeder;
use App\Models\User;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $total = 35;
        $faker = \Faker\Factory::create();

        if (tenant()->id == '0b26c3fd-bb33-4419-867a-5aee383353f5') {
            $total--;

            $user = new UserEntity(
                name: new NameInputObject('Bruno Henrique da Costa'),
                login: new EmailInputObject('bhcosta90@gmail.com'),
                password: new PasswordInputObject('$2y$10$vcEEoh.rY82m4iJA.nreBOCnxsXaHQeHG0pp2DH/lwR4BRb5i6sMK', false)
            );

            User::factory()->create([
                'id' => $user->id(),
                'name' => $user->name->value,
                'email' => $user->login->value,
                'password' => $user->password->value,
            ]);
        }

        for ($i = 0; $i < $total; $i++) {
            $user = new UserEntity(
                name: new NameInputObject($faker->name()),
                login: new EmailInputObject($faker->freeEmail()),
                password: new PasswordInputObject('$2y$10$XKKR51KTzWY9QVDDBH9TGep9PuZnE/Sjyxc0SMYoRnJb6Zs9QnOuC', false)
            );

            User::factory()->create([
                'id' => $user->id(),
                'name' => $user->name->value,
                'email' => $user->login->value,
                'password' => $user->password->value,
            ]);
        }
    }
}

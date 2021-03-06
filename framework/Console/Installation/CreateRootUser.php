<?php
namespace SleepingOwl\Framework\Console\Installation;

use SleepingOwl\Framework\SleepingOwl;

class CreateRootUser extends Installator
{

    /**
     * Вывод информации о текущей конфигурации
     *
     * @return void
     */
    public function showInfo()
    {
        $this->command->line('Administrator created: <info>✔</info>');
    }

    /**
     * Установка компонентов текущей конфигурации
     *
     * @return void
     */
    public function install()
    {
        do {
            $name = $this->command->ask('Your name');
            $email = $this->command->ask('Your email');
            $password = $this->command->secret('Your password');


            $user = SleepingOwl::user()->create([
                'name' => $name,
                'email' => $email,
                'password' => bcrypt($password)
            ]);

        } while(!$user->exists);
    }

    /**
     * При возврате методом true данный компонент будет пропущен
     *
     * @return bool
     */
    public function installed(): bool
    {
        return SleepingOwl::user()->count() > 0;
    }
}
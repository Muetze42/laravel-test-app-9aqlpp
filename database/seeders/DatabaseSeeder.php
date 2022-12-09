<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Account;
use App\Models\Message;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;
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
        User::factory()->hasAccounts(10)->create();
        User::factory(20)->hasAccounts(5)->create();
        Message::factory(10)->create();

        Account::all()->each(function (Account $account) {
            Transaction::create([
                'content'          => Str::random(),
                'sender_account'   => 1,
                'receiver_account' => $account->id,
            ]);
            Transaction::create([
                'content'          => Str::random(),
                'receiver_account' => 1,
                'sender_account'   => $account->id,
            ]);
        });

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}

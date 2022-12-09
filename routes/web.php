<?php

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $user = \App\Models\User::findOrFail(1);

    \Illuminate\Support\Facades\Auth::login($user, true);

    return redirect()->route('show');
})->name('login');

Route::get('show', function (\Illuminate\Http\Request $request) {
    $user = $request->user();
    if (!$user) {
        return redirect()->route('login');
    }

    //$accounts = Account::where('owner_id', $user->id)->get();
    $accounts = $user->accounts; // Via Relationship

    $accountIds = $accounts->pluck('id')->toArray();
    $transactions = Transaction::whereIn('sender_account', $accountIds)->orWhereIn('receiver_account', $accountIds)->get();
    $messages = DB::table('messages')->get();

    return view('client.accounts', [
        'transactions' => $transactions,
        'messages'     => $messages,
        'accounts'     => $accounts,
    ]);

})->name('show');

Accounts:
<ul>
    @foreach($accounts as $account)
        <li>{{ print_r($account->toArray(), true) }}</li>
    @endforeach
</ul>

<hr>

Transactions:
<ul>
    @foreach($transactions as $transaction)
        <li>{{ print_r($transaction->toArray(), true) }}</li>
    @endforeach
</ul>

<hr>

Messages:
<ul>
    @foreach($messages as $message)
        <li>{{ print_r($message, true) }}</li>
    @endforeach
</ul>

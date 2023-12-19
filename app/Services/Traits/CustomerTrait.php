<?php

namespace App\Services\Traits;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Support\Facades\Log;

trait CustomerTrait
{

    //CONST PREFIX_ACCOUNT_NAME = 'guest';
   
    // Tạo tên account cho khách vãng lai
    public function createAccountNameGuest() {
        $prefixAccountName = 'guest';
        $accountName = '';
        $count = Customer::whereRaw('SUBSTRING(account, 1, 5) = ?', [$prefixAccountName])->count();
        if ($count > 0) {
            $accountName = $prefixAccountName.(string) $count + 1;
        } else {
            $accountName = $prefixAccountName.'1';
        }

        return $accountName;
    }

    public function createPasswordGuest() {
        return '123456';
    }

}

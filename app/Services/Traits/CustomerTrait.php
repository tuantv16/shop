<?php

namespace App\Services\Traits;

use App\Models\Customer;
use App\Models\Order;
use Illuminate\Support\Facades\Log;

trait CustomerTrait
{

    CONST PREFIX_ACCOUNT_NAME = 'guest';

    // Tạo tên account cho khách vãng lai
    public function createAccountNameGuest() {
        $accountName = '';
        $count = Customer::whereRaw('SUBSTRING(account, 1, 5) = ?', [self::PREFIX_ACCOUNT_NAME])->count();
        if ($count > 0) {
            $accountName = self::PREFIX_ACCOUNT_NAME.(string) $count + 1;
        } else {
            $accountName = self::PREFIX_ACCOUNT_NAME.'1';
        }

        return $accountName;
    }

    public function createPasswordGuest() {
        return '123456';
    }

}

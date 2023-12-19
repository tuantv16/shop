<?php

namespace App\Services\Traits;

use App\Models\Order;
use Illuminate\Support\Facades\Log;

trait OrderTrait
{
    // CONST PREFIX_ORDER = 'DHSHOP000';

    public function getMaxOrderId() {
        $maxId = Order::max('id');

        if ($maxId >= 1) {
            $maxId += 1;
        } else {
            $maxId = 1;
        }

        return $maxId;
    }

    public function createOrderCode() {
        return 'DHSHOP000'.(string)$this->getMaxOrderId();
    }

}

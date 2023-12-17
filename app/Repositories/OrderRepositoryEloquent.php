<?php

namespace App\Repositories;

use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;
use App\Constants\Constant;
use App\Models\Order;
use App\Repositories\Interfaces\OrderRepository;

/**
 *
 * @package namespace App\Repositories;
 */
class OrderRepositoryEloquent extends BaseRepositoryEloquent implements OrderRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return Order::class;
    }

    /**
     * Boot up the repository, pushing criteria
     * @throws RepositoryException
     */
    public function boot(): void
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function getDataDispOrder() {
        return $this->model->where('disp', Constant::DISPLAY)->get();
    }

    /**
     * @param array $orderCode
     * @return mixed
     */
    public function getDataByOrderCode($orderCode) {

        $fieldsInOrderDetails = ['order_id', 'order_code', 'product_id', 'product_code', 'customer_id', 'size_id', 'color_id' ,'quantity', 'price', 'total_amount'];
        $fieldsInProducts = ['id', 'product_name'];

        $data = $this->model->with([
            'orderDetails' => function ($query) use ($fieldsInOrderDetails) {
                $query->select($fieldsInOrderDetails);
            },
            'orderDetails.product' => function ($query) use ($fieldsInProducts) {
                $query->select($fieldsInProducts);
            }
        ])
        ->where('order_code', $orderCode)->first();
        if ($data->orderDetails) {

            if ($data->orderDetails->isNotEmpty()) {

                foreach($data->orderDetails as $key => $row) {
                    $data->orderDetails[$key]->size_name =  config("web.config.sizes.{$row->size_id}");
                    $data->orderDetails[$key]->color_code =  config("web.config.colors.{$row->color_id}");
                    $data->orderDetails[$key]->color_name =  config("web.config.colorNames.{$row->color_id}");
                }
            }

        }

        return $data;
    }

}

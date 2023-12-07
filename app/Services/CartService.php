<?php

namespace App\Services;

use App\Repositories\Interfaces\CartRepository;
use App\Repositories\Interfaces\ProductRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CartService extends BaseService
{

    protected $cartRepository;
    protected $productRepository;
    /**
     *
     */
    public function __construct(
        CartRepository $cartRepository,
        ProductRepository $productRepository,
    ) {
        $this->cartRepository = $cartRepository;
        $this->productRepository = $productRepository;

    }

    public function getInitData($id) {
        $carts = $this->cartRepository->find(intval($id));

        $results = [
            'carts' => $carts
        ];

        return $results;
    }


    public function handleCart($newProducts) {
        try {
            $carts = session()->get('dataCarts');

            // Trường hợp khách hàng chưa login hoặc đã login nhưng chưa có sản phẩm nào trong giỏ hàng
            if (empty($carts)) {
                $carts = $newProducts;
            }

            // Trường hợp khách hàng đã login và đã có sản phẩm trong giỏ hàng
            $dataCarts = [];
            if (!empty($carts)) {
                $carts = $this->updateCart($carts, $newProducts);

                // lấy danh sách các key ids
                $productIds = $this->getAttributeIds($carts, 'product_id');
                $sizeIds = $this->getAttributeIds($carts, 'size_id');
                $colorIds = $this->getAttributeIds($carts, 'color_id');

                // Lấy dữ liệu tương ứng với các key ids
                $products = $this->getProductByIds($productIds);
                $sizes = config('web.config.sizes');
                //$colors = config('web.config.colors');
                $colorNames = config('web.config.colorNames');


                $productDetails = []; //Khởi tạo chi tiết mỗi sản phẩm trong giỏ hàng
                foreach($carts as $key => $row) {
                    $dataCarts[$key] = $row;
                    $keyPro = $row['product_id'];

                    $productDetails['product_name'] = isset($products[$keyPro]) && isset($products[$keyPro]['product_name']) ? $products[$keyPro]['product_name'] : '';
                    $productDetails['price'] = isset($products[$keyPro]) && !empty($products[$keyPro]['price']) ? (int) $products[$keyPro]['price'] : 0;
                    $productDetails['price_label'] = isset($products[$keyPro]) && !empty($products[$keyPro]['price']) ? format_vnd($products[$keyPro]['price']) : '';

                    $productDetails['product_code'] = isset($products[$keyPro]) && !empty($products[$keyPro]['product_code']) ? $products[$keyPro]['product_code'] : '';

                    $productDetails['quantity'] = $row['quantity'];
                    $productDetails['total_amount'] = $row['quantity'] * $productDetails['price'];
                    $productDetails['size_name'] = $sizes[$row['size_id']] ?? '';
                    $productDetails['color_name'] = $colorNames[$row['color_id']] ?? '';

                    $dataCarts[$key]['product_details'] = $productDetails;
                }

                if (!empty($dataCarts)) {
                    $carts = $dataCarts;
                }

            }

            //update lại thông tin giỏ hàng
            Session::put('dataCarts', $carts);

            return true;
        } catch (\Exception $e) {

            Log::error($e->getMessage());
            return $e->getMessage();
        }

    }

    private function getAttributeIds($data, $fieldName) {
        $sizeIds = array_map(function($item) use ($fieldName) {
            return (int) $item[$fieldName];
        }, $data);

        $sizeIds = array_values(array_unique($sizeIds));

        return $sizeIds;

    }

    private function getProductByIds($productIds) {

        $data = $this->productRepository->getProductByIds($productIds);
        $products = $data->mapWithKeys(function ($item) {
            return [$item['id'] => $item];
        })->toArray();

        return $products;
    }

    private function updateCart($carts, $newProducts) {
        // Trường hợp này khó xảy ra (vì khi add sản phẩm đã có thông tin sản phẩm rồi)
        if (empty($newProducts)) {
            $carts = $newProducts;
        }




        $data = array_merge($carts, $newProducts); // merge sản phẩm mới session trong giỏ hàng
        foreach ($data as $item) {
            $productId = (string) $item['product_id'];
            $sizeId = (string) $item['size_id'];
            $colorId = (string) $item['color_id'];

            $key = $productId . '-' . $sizeId . '-' . $colorId;

            if (!isset($result[$key])) {
                $result[$key] = $item;
            } else {
                $result[$key]['quantity'] = (int) $result[$key]['quantity'] + (int) $item['quantity'];
            }
        }

        $resultCarts = array_values($result);
        return $resultCarts;
    }

}

<?php

namespace App\Services;

use App\Repositories\Interfaces\CartRepository;
use App\Repositories\Interfaces\ProductRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Exception;

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

                    $row['customer_id'] = session()->get('accountLogin')['customer_id'];

                    $dataCarts[$key] = $row;
                    $keyPro = $row['product_id'];

                    $productDetails['product_name'] = isset($products[$keyPro]) && isset($products[$keyPro]['product_name']) ? $products[$keyPro]['product_name'] : '';

                    $price = 0;
                    if (isset($products[$keyPro]) && !empty($products[$keyPro]['price'])) {
                        $price = (int) $products[$keyPro]['price'];
                    }

                    $productDetails['price'] = $price;
                    $productDetails['price_label'] = format_vnd($price);
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
        if(empty($data)) {
            return [];
        }

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


    // Lấy data đẩy đủ dựa theo param input từ dataLocalStorage
    public function getCartForVisitingGuests($dataLocalStorage) {
        return $this->getFullInfoCart($dataLocalStorage, false); // false: khách chưa login
    }


    // hàm chung để lấy ra đầy đủ thông tin cart (ví dụ product_name, color_name,size_name, total_amount ...)
    public function getFullInfoCart($cartInputs, $statusLogin = true) {
        $productIds = $this->getAttributeIds($cartInputs, 'product_id');
        $products = $this->getProductByIds($productIds);

        // Lấy dữ liệu tương ứng với các key ids
        $products = $this->getProductByIds($productIds);

        $sizes = config('web.config.sizes');
        //$colors = config('web.config.colors');
        $colorNames = config('web.config.colorNames');

        $productDetails = []; //Khởi tạo chi tiết mỗi sản phẩm trong giỏ hàng
        $dataCarts = [];
        
        if (!empty($cartInputs)) {
            foreach($cartInputs as $key => $row) {

                if ($statusLogin) { // trường hợp khách login thì set customer_id = session login
                    $row['customer_id'] = session()->get('accountLogin')['customer_id'];
                }
    
                $dataCarts[$key] = $row;
                $keyPro = $row['product_id'];
    
                $productDetails['product_name'] = isset($products[$keyPro]) && isset($products[$keyPro]['product_name']) ? $products[$keyPro]['product_name'] : '';
    
                $price = 0;
                if (isset($products[$keyPro]) && !empty($products[$keyPro]['price'])) {
                    $price = (int) $products[$keyPro]['price'];
                }
    
                $productDetails['price'] = $price;
                $productDetails['price_label'] = format_vnd($price);
                $productDetails['product_code'] = isset($products[$keyPro]) && !empty($products[$keyPro]['product_code']) ? $products[$keyPro]['product_code'] : '';
                $productDetails['quantity'] = $row['quantity'];
                $productDetails['total_amount'] = $row['quantity'] * $productDetails['price'];
                $productDetails['size_name'] = $sizes[$row['size_id']] ?? '';
                $productDetails['color_name'] = $colorNames[$row['color_id']] ?? '';
    
                $dataCarts[$key]['product_details'] = $productDetails;
            }
        }
        

        return $dataCarts;
    }

    // trước khi đăng xuất thì lưu thông tin cart vào database
    public function saveCart($carts) {
        $customerId = session()->get('accountLogin')['customer_id'];

        $updateCartSuccess = false;

        try {
            DB::beginTransaction();
            // Delete cart by customer_id
            $this->cartRepository->deleteCartByCustomerId(intval($customerId));
            // Add new data cart to database (table carts)
            foreach ($carts as $product) {
                $this->cartRepository->create($product);
            }

            DB::commit();
            $updateCartSuccess = true;
        } catch (Exception $e) {
            DB::rollBack();
        }

        return $updateCartSuccess;
    }

    // sau khi khách đã login (từ thông tin cart trong bảng carts) -> lấy thông tin đầy đủ (các name)
    public function getCartInfoDb($data) {
        return $this->getFullInfoCart($data);
    }
}







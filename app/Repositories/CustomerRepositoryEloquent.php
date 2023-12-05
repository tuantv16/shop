<?php

namespace App\Repositories;

use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Exceptions\RepositoryException;
use App\Models\Customer;
use App\Repositories\Interfaces\CustomerRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 *
 * @package namespace App\Repositories;
 */
class CustomerRepositoryEloquent extends BaseRepositoryEloquent implements CustomerRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return Customer::class;
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
    public function register($params) {
        $params['password'] = Hash::make($params['password']);
        return $this->model->create($params);
    }


     /**
     * @param array $data
     * @return mixed
     */
    public function login($params) {
        $user = $this->model->where('account', trim($params['account']))->first();
        // Kiểm tra xem user có tồn tại và mật khẩu khớp hay không
        if ($user && Hash::check($params['password'], $user->password)) {
            return $user;
        } else {
            // Đăng nhập thất bại
            return null;
        }

    }


}

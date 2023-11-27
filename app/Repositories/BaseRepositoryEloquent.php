<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\UserRepository;
use App\Entities\User;
use App\Validators\UserValidator;

/**
 * Class UserRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
abstract class BaseRepositoryEloquent extends BaseRepository
{
    const PAGE_SIZE = 3;

    protected function buildForDatatable($query, $params, $columns = ['*'])
    {

        $start = $params['start'] ?? null;
        $length = $params['length'] ?? null;

        if ($length != 0) {
            $page = $start / $length + 1;
            return $query->paginate($length, ['*'], 'page', $page);
        }

        return $query->paginate($params['per_page'] ?? self::PAGE_SIZE, $columns);
    }


    /**
     * @describe build query for datatable
     * @param $columns
     * @param $params
     * @param $query
     * @return array
     */
    // protected function buildOrderForDataTable($columns, $params, $query): array
    // {
    //     $order = isset($params['order']) && count($params['order']) > 0 ? $params['order'][0] : null;
    //     $dir = $order['dir'] ?? 'asc';
    //     if ($order && isset($columns[$order['column']])) {
    //         $query = $query->orderBy($columns[$order['column']], $dir);
    //     }

    //     return array($params, $query);
    // }

    /**
     * @return int
     */
    public function getMaxDispOrder(): int
    {
        try {
            return $this->model->max('disp_order');
        } catch (\Exception $e) {
            return 0;
        }
    }


}

<?php

namespace App\Repositories;

use Prettus\Repository\Exceptions\RepositoryException;
use App\Models\Survey;
use App\Repositories\Interfaces\SurveyRepository;

/**
 *
 * @package namespace App\Repositories;
 */
class SurveyRepositoryEloquent extends BaseRepositoryEloquent implements SurveyRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return Survey::class;
    }

    /**
     * Boot up the repository, pushing criteria
     * @throws RepositoryException
     */
    // public function boot(): void
    // {
    //     $this->pushCriteria(app(RequestCriteria::class));
    // }

    public function getList($params) {
        $columns = ['*'];
        $query = $this->model->select($columns);
        $query->orderBy('created_at','DESC');
        return $this->buildForDatatable($query, $params, $columns);
    }

}

<?php

namespace App\Repositories;

use App\Models\Feedback;
use App\Repositories\Interfaces\FeedbackRepository;

/**
 *
 * @package namespace App\Repositories;
 */
class FeedbackRepositoryEloquent extends BaseRepositoryEloquent implements FeedbackRepository
{

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model(): string
    {
        return Feedback::class;
    }

    public function getFeedbackBySurveyId($surveyId) {
        return $this->model->where([
            'survey_id' => intval($surveyId)
        ])
        ->orderby('updated_at')->get();
    }


}

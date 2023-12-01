<?php

namespace App\Services;

use App\Repositories\Interfaces\SurveyRepository;

class SurveyService extends BaseService
{
    protected $surveyRepository;

    /**
     *
     */
    public function __construct(
        SurveyRepository $surveyRepository,

    ) {
        $this->surveyRepository = $surveyRepository;
    }

    public function getInitData() {
        //$brands = $this->brandRepository->getDataDispOrder();

        $results = [

        ];

        return $results;
    }

}

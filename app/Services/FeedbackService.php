<?php

namespace App\Services;

use App\Repositories\Interfaces\FeedbackRepository;
use Illuminate\Support\Facades\DB;

class FeedbackService extends BaseService
{
    protected $feedbackRepository;


    /**
     *
     */
    public function __construct(
        FeedbackRepository $feedbackRepository,
    ) {
        $this->feedbackRepository = $feedbackRepository;
    }

    public function getInitData($params) {
        $feedbacks = $this->feedbackRepository->getFeedbackBySurveyId($params['surveyId']);
        $results = [
            'feedbacks' => $feedbacks
        ];

        return $results;
    }

    public function settingFeedbacks($params) {
        DB::beginTransaction();
        try {
            $this->feedbackRepository->where('survey_id', (int) $params['survey_id'])->delete();
            $rows = $params['rows'];
            foreach ($rows as $dataInsert) {
                $dataInsert['survey_id'] = intval($params['survey_id']);
                $this->feedbackRepository->create($dataInsert);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            // Xử lý lỗi hoặc ném lại ngoại lệ
            throw $e;
        }

        return true;
    }

}

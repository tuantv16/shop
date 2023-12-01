<?php

namespace App\Repositories\Interfaces;

interface FeedbackRepository extends BaseRepository
{
    public function getFeedbackBySurveyId($surveyId);
}

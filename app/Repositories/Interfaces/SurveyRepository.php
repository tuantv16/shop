<?php

namespace App\Repositories\Interfaces;

interface SurveyRepository extends BaseRepository
{
   public function getList($params);
}

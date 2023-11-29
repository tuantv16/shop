<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Manage\Feedbacks\FormRowsRequest;
use App\Repositories\Interfaces\FeedbackRepository;
use App\Services\FeedbackService;

class FeedbackController extends ApiController
{

    protected $feedbackRepository;
    protected $seedbackService;

    public function __construct(
        FeedbackRepository $feedbackRepository,
        FeedbackService $seedbackService,

    )
    {
        $this->feedbackRepository = $feedbackRepository;
        $this->seedbackService = $seedbackService;

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function setting(FormRowsRequest $request) {
        $inputDatas = $request->validated();

        $this->seedbackService->settingFeedbacks($inputDatas);
        return $this->responseSuccess([]);
    }

}

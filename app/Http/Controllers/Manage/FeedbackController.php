<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\FeedbackRepository;
use App\Services\FeedbackService;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{

    protected $feedbackRepository;
    protected $feedbackService;

    public function __construct(FeedbackRepository $feedbackRepository, FeedbackService $feedbackService)
    {
        $this->feedbackRepository = $feedbackRepository;
        $this->feedbackService = $feedbackService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        dd('feed back list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    public function setting($surveyId) {

        $params['surveyId'] = intval($surveyId);
        $dataInit = $this->feedbackService->getInitData($params);

        $dataInit['surveyId'] = intval($surveyId);

        return view('backend.feedbacks.setting', $dataInit);
    }

}

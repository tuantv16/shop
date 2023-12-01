<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Http\Resources\Surveys\Survey;
use App\Repositories\Interfaces\ProductDetailRepository;
use App\Repositories\Interfaces\SurveyRepository;
use App\Services\ProductDetailService;
use App\Services\SurveyService;
use Illuminate\Http\Request;


class SurveyController extends Controller
{

    protected $surveyService;
    protected $surveyRepository;

    public function __construct(SurveyRepository $surveyRepository, SurveyService $surveyService)
    {
        $this->surveyRepository = $surveyRepository;
        $this->surveyService = $surveyService;

    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $params = $request->all();
        $data = $this->surveyRepository->getList($params);
        $surveys = new Survey($data);
        return view('backend.surveys.list', [
            'surveys' => $surveys
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

}

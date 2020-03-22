<?php

namespace Quill\SeoScore\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class SeoScoreController extends Controller
{

    /**
     * Display seo computation breakdown.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       	$scoring = config('seoscore');
        return view('seoscore::seoScore', ['scoring' => json_encode($scoring)]);
    }


}

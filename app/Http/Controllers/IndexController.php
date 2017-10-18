<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{
    Page,
    Service,
    Portfolio,
    People
};

class IndexController extends Controller
{
    //
    public function execute(Request $request)
    {
        $pages = Page::all();
        $peoples = People::all();
        $portfolios = Portfolio::all();
        $service = Service::all();


        return view('site.index');

    }
}

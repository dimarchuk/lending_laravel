<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{
    Page,
    Service,
    Portfolio,
    People
};
use DB;

class IndexController extends Controller
{
    //
    public function execute(Request $request)
    {
        $pages = Page::all();
        $peoples = People::all();
        $portfolios = Portfolio::all();
        $service = Service::all();
        //filters
        $tags = DB::table('portfolios')->distinct()->pluck('filter');

        $menu = array();
        foreach ($pages as $page) {

            $item = array('title' => $page->name, 'alias' => $page->alias);
            array_push($menu, $item);

        }

        $item = array('title' => 'services', 'alias' => 'service');
        array_push($menu, $item);

        $item = array('title' => 'Portfolio', 'alias' => 'Portfolio');
        array_push($menu, $item);

        $item = array('title' => 'Team', 'alias' => 'team');
        array_push($menu, $item);

        $item = array('title' => 'Contact', 'alias' => 'contact');
        array_push($menu, $item);

        return view('site.index', array(

            'menu' => $menu,
            'pages' => $pages,
            'services' => $service,
            'portfolios' => $portfolios,
            'peoples' => $peoples,
            'tags' => $tags

        ));

    }
}

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
use Mail;

class IndexController extends Controller
{
    //
    public function execute(Request $request)
    {


        if ($request->isMethod('post')) {

            $messages = [

                'required' => "Поле :attribute обязательно к заполнению",
                'email' => "Поле :attribute должно соответствовать email адресу"

            ];

            $this->validate($request, [

                'name' => 'required|max:255',
                'email' => 'required|email',
                'text' => 'required'

            ], $messages);

            $data = $request->all();


            Mail::send('site.email', ['data' => $data], function ($message) use ($data) {

                $mail_admin = env('MAIL_ADMIN');

                $message->from($data['email'], $data['name']);

                $message->to($mail_admin, 'Mr. Admin')->subject('Question');

            });

            //mail
            dd(Config::get('mail'));

        }

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

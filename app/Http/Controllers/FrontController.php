<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Service;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $services = [
            [
                'name' => 'Taxi services 24/7',
                'body' => 'Our taxi cars are working 24/7 so we help get enywhere you nedd at any time',
                'image' => '247.jpg',
            ],
            [
                'name' => 'Monile App',
                'body' => 'Now you can use our new app fro more comfortable experience',
                'image' => 'mobile-app.jpg',
            ],
            [
                'name' => 'Support 247',
                'body' => 'At any time you can call us or write to our app regarding any issu',
                'image' => 'support-call.jpg',
            ],
        ];

        return view('front.index', ['services' => $services]);
    }

    public function feedback()
    {

        return view('front.feedback');
    }
}

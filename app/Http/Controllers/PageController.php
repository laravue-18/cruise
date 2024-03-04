<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
        return inertia('About');
    }

    public function faq()
    {
        return inertia('Faq');
    }

    public function coverage()
    {
        return inertia('Coverage');
    }

    public function destinations()
    {
        return inertia('Destinations');
    }
}

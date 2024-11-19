<?php

namespace App\Http\Controllers;

use App\Models\Policy;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('Home.content');
    }

    public function home()
    {
        return view('Home.index');
    }


    public function registration()
    {
        return view('Home.registrations');
    }

    // public function eligibility()
    // {
    // return view('Eligibility.form');
    // }

    public function membership_standards()
    {
    return view('Eligibility.membership_policy',[

    'policies' => Policy::where('active',1)->get()->all()
    ]);
    }

}

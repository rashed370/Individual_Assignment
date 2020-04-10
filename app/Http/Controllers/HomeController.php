<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    private $role;

    public function __construct(){}

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $this->role = auth()->user()->role;
        return !empty($this->role) && view()->exists($this->role.'.home') ? view($this->role.'.home') : 'UNKNOWN USER';
    }
}

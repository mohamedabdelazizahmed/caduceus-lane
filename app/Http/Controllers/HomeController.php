<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Pain;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['currentUser'] = auth()->user();
        $data['pains'] = Pain::all() ;
        return view('welcome',$data);
    }

    public function makeAppointment(Request $request,$id)
    {
        $user = User::find($id);
        $user->pain_id = $request->pain_id;
        $user->save();
        return redirect()->back()->with('success','your appointment has been sent , please wait and  check your notification to accept the time');
    }
}

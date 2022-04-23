<?php

namespace App\Http\Controllers;

use App\Helper\Media;
use App\Models\Settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    const VIEW='settings.';
    use Media;

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function  index(){
        $settings=Settings::first();
        return view(self::VIEW."index" , compact('settings'));
    }


    public function store(Request $request){
        $roulas= Settings::rules();
        $settings=Settings::first();
        $validatedData = $request->validate($roulas);
        $settings->update($validatedData);
        return redirect('/settings')->with('success', 'Game is successfully saved');

    }



   
}

<?php

class DashboardController extends BaseController {
    
    public function index()
    {       
        try
        {
            $userID = Auth::user()->id;
        }
        catch(Exception $exc)
        {
            return Redirect::to("/")->with("errors_login", "Please log in first");
        }

        try
        {
            $apps = AppModel::where('userid', '=', $userID)->get();
        }
        catch(Exception $exc)
        {
            return View::make('dashboard')->with('error', 'Apps failing');
        }

        return View::make('dashboard')->with('apps', $apps);
    }
}

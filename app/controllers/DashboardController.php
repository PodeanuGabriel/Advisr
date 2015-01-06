<?php

class DashboardController extends BaseController {
    
    public function index()
    {       
        if(Auth::check())
        {
            try
            {
                $userID = Auth::user()->id;
                $apps = AppModel::where('userid', '=', $userID)->get();
            }
            catch(Exception $exc)
            {
                return View::make('dashboard')->with('error', 'Apps failing');
            }

            return View::make('dashboard')->with('apps', $apps);
        }
        else
        {
            return Redirect::to("/")->with("errors_login", "Please log in first");
        }
    }
}

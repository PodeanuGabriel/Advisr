<?php

class DashboardController extends BaseController {
    
    public function index()
    {       
        $userID = Auth::user()->id;
        $apps = array();
        
        try{
            
            $apps = AppModel::where('userid', '=', $userID)->get();
            
        } catch(Exception $e){
            return View::make('dashboard')->with('error', 'Apps failing');
        }        
        return View::make('dashboard')->with('apps', $apps);
        
    }
}

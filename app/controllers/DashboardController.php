<?php

class DashboardController extends BaseController {
    
    public function index()
    {       
        $apps = array();
		
		if(Auth::check())
        {
			try
            {
                $userID = Auth::user()->id;
                $apps = AppModel::where("userid", "=", $userID)
                    ->orderBy("id", "desc")
                    ->get();
            }
            catch(Exception $exc)
            {
				die($exc->getMessage());
				$data = array();
				$data['error'] = "Apps failing";
				$data['apps'] = $apps;
				return View::make("dashboard", $data);
            }

            return View::make("dashboard")->with("apps", $apps);
        }
        else
        {
            return Redirect::to("/")->with("errors_login", "Please log in first");
        }
    }
}

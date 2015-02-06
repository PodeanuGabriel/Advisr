<?php

class AppController extends BaseController
{
    /**
     * Add an app for a user.
     *
     * @return void
     */
    public function addApp()
    {
        $errors = array();

        if(!Input::has("name"))
            $errors[] = "Please enter app name!";

        if(!Input::has("data_url"))
            $errors[] = "Please enter the URL from where data should be fetched!";


        if(empty($errors))
        {
            $strAppName = Input::get("name");
            $strDataURL = Input::get("data_url");

            if(empty($errors))
            {
                if(Auth::check())
                {
                    try
                    {
                        $app = new AppModel;

                        $app->appkey = str_random(16);
                        $app->appsecret = Uuid::generate();
                        $app->name = $strAppName;
                        $app->userid = Auth::user()->id;
                        $app->data_url = $strDataURL;

                        $app->save();

                        $arrCategories = CategoryModel::all();
                        foreach($arrCategories as $objCategory)
                        {
                            $appCategory = new AppCategoryModel();

                            $appCategory->id_app = $app->id;
                            $appCategory->id_category = $objCategory->id;

                            $appCategory->save();
                        }
                    }
                    catch(Exception $exc)
                    {
                        return Redirect::to("dashboard")->with("errors", $exc->getMessage());
                    }

                    return Redirect::to("dashboard");
                }
                else
                {
                    return Redirect::to("/")->with("errors_login", "Please log in first");
                }
            }
            else
            {
                return Redirect::to("dashboard")->with("errors", $errors);
            }
        }
        else
        {
            return Redirect::to("dashboard")->with("errors", $errors);
        }
    }


    public function getApp($nAppID)
    {
        if(Auth::check())
        {
            try
            {
                $appData = AppModel::where("id", "=", $nAppID)->first();
            }
            catch(Exception $exc)
            {
                return Redirect::to("dashboard")->with("errors", $exc->getMessage());
            }

            return json_encode($appData);
        }
        else
        {
            return Redirect::to("/")->with("errors_login", "Please log in first");
        }
    }


    public function editApp($nAppID)
    {
        $errors = array();

        if(!Input::has("name"))
            $errors[] = "Please enter app name!";

        if(!Input::has("data_url"))
            $errors[] = "Please enter the URL from where data should be fetched!";

        if(empty($errors))
        {
            $strAppName = Input::get("name");
            $strDataURL = Input::get("data_url");

            if(Auth::check())
            {
                try
                {
                    $app = AppModel::where("id", "=", $nAppID)->update(
                        array(
                            "name" => $strAppName,
                            "data_url" => $strDataURL
                        )
                    );
                }
                catch(Exception $exc)
                {
                    return View::make("dashboard")->with("error", "App retrieval failed");
                }

                return Redirect::to("dashboard");
            }
            else
            {
                return Redirect::to("/")->with("errors_login", "Please log in first");
            }
        }
        else
        {
            return Redirect::to("dashboard")->with("errors", $errors);
        }
    }


    public function deleteApp()
    {
        $errors = array();

        if(!Input::has("app_id"))
            $errors[] = "Please enter app id!";

        if(empty($errors))
        {
            $nAppID = Input::get("app_id");

            if(Auth::check())
            {
                try
                {
                    AppCategoryModel::where("id_app", "=", $nAppID)->delete();
                    AppModel::where("id", "=", $nAppID)->delete();
                }
                catch(Exception $exc)
                {
                    return View::make("dashboard")->with("error", "App delete failed");
                }

                return Redirect::to("dashboard");
            }
            else
            {
                return Redirect::to("/")->with("errors_login", "Please log in first");
            }
        }
        else
        {
            return Redirect::to("dashboard")->with("errors", $errors);
        }
    }


    public function editAppCategories($nAppID)
    {
        if(Auth::check())
        {
            try
            {
                AppCategoryModel::where("id_app", "=", $nAppID)->delete();

                foreach(Input::all() as $strCategory)
                {
                    $objCategory = CategoryModel::where("name", "=", Input::get($strCategory))->first();

                    $appCategory = new AppCategoryModel;

                    $appCategory->id_app = $nAppID;
                    $appCategory->id_category = $objCategory->id;

                    $appCategory->save();
                }
            }
            catch(Exception $exc)
            {
                return Redirect::to("dashboard")->with("errors", $exc->getMessage());
            }

            return Redirect::to("dashboard");
        }
        else
        {
            return Redirect::to("/")->with("errors_login", "Please log in first");
        }
    }


    public function getAppUsers($nAppID)
    {
        if(Auth::check())
        {
            $arrUserNames["response"] = array();

            try
            {
                $arrUsers = AppCategoryModel::join("categories", "app_categories.id_category", "=", "categories.id")
                    ->join("items", "categories.id", "=", "items.category")
                    ->join("preferences", "items.id", "=", "preferences.item_id")
                    ->join("user_mappings", "preferences.user_id", "=", "user_mappings.user_id_int")
                    ->where("app_categories.id_app", "=", $nAppID)
                    ->get();

                foreach($arrUsers as $objUser)
                {
                    if(!in_array($objUser->user_id, $arrUserNames["response"]))
                    {
                        $arrUserNames["response"][] = $objUser->user_id;
                    }
                }
            }
            catch(Exception $exc)
            {
                return Redirect::to("dashboard")->with("errors", $exc->getMessage());
            }

            return json_encode($arrUserNames);
        }
        else
        {
            return Redirect::to("/")->with("errors_login", "Please log in first");
        }
    }


    public function getAppRecommendation($nAppID, $strUserName, $strCategories)
    {
        if(Auth::check())
        {
            $arrPreferenceData = array();

            $arrCategories = explode(",", $strCategories);

            try
            {
                $objUserName = UserMappingsModel::where("user_id", "=", $strUserName)->first();
                $arrExistingCategories = CategoryModel::whereIn("name", $arrCategories)->get();

                foreach($arrExistingCategories as $objCategory)
                {
                    $arrPreferences = AppCategoryModel::join("categories", "app_categories.id_category", "=", "categories.id")
                        ->join("items", "categories.id", "=", "items.category")
                        ->join("preferences", "items.id", "=", "preferences.item_id")
                        ->join("user_mappings", "preferences.user_id", "=", "user_mappings.user_id_int")
                        ->where("app_categories.id_app", "=", $nAppID)
                        ->where("app_categories.id_category", "=", $objCategory->id)
                        ->where("user_mappings.user_id_int", "=", $objUserName->user_id_int)
                        ->get();

                    foreach($arrPreferences as $objPreference)
                    {
                        $objItemCategory = CategoryModel::where("id", "=", $objPreference->category)->first();

                        $arrPreferenceData["response"][] = array(
                            "item_id" => $objPreference->item_id,
                            "category" => $objItemCategory->name,
                        );
                    }
                }
            }
            catch(Exception $exc)
            {
                return Redirect::to("dashboard")->with("errors", $exc->getMessage());
            }

            return json_encode($arrPreferenceData);
        }
        else
        {
            return Redirect::to("/")->with("errors_login", "Please log in first");
        }
    }


    public function getAppStatisticsByAccessNumber($nAppID)
    {
        if(Auth::check())
        {
            $arrStatisticsData = array();
            $arrStatisticsData[] = array("Year", "value", array("role"=>"style"));
            $res = RequestedPreference::where("request_date", ">", DB::raw('DATE_SUB(NOW(), INTERVAL 30 DAY)'))
                ->where("app_id", "=", $nAppID)
                ->orderBy('request_date')
                ->get();

            $queries = DB::getQueryLog();
            $last_query = end($queries);


            $data = array();
            foreach($res as $r) {
                if(isset($data[date('d-m-Y', strtotime($r->request_date))])) {
                    $data[date('d-m-Y', strtotime($r->request_date))]++;
                } else {
                    $data[date('d-m-Y', strtotime($r->request_date))] = 1;
                }
                //$arrStatisticsData[] = array("2010", 10, " color: gray");
            }

            foreach($data as $key => $value) {
                $arrStatisticsData[] = array($key, (int)$value, " color: blue");
            }
            /*$arrStatisticsData[] = array("2010", 10, " color: gray");
            $arrStatisticsData[] = array("2010", 200, "color: #76A7FA");
            $arrStatisticsData[] = array("2020", 16, "opacity: 0.2");
            $arrStatisticsData[] = array("2040", 22, "stroke-color: #703593; stroke-width: 4; fill-color: #C5A5CF");
            $arrStatisticsData[] = array("2040", 28, "stroke-color: #871B47; stroke-opacity: 0.6; stroke-width: 8; fill-color: #BC5679; fill-opacity: 0.2");*/

            return json_encode($arrStatisticsData);
        }
        else
        {
            return Redirect::to("/")->with("errors_login", "Please log in first");
        }
    }


    public function getAppStatisticsByPreferenceNumber($nAppID)
    {
        if(Auth::check())
        {
            $arrStatisticsData = array();
            $arrStatisticsData[] = array("Year", "value", array("role"=>"style"));
            $res = CollectedPreference::where("request_date", ">", DB::raw('DATE_SUB(NOW(), INTERVAL 30 DAY)'))
                ->where("app_id", "=", $nAppID)
                ->orderBy('request_date')
                ->get();

            $queries = DB::getQueryLog();
            $last_query = end($queries);


            $data = array();
            foreach($res as $r) {
                if(isset($data[date('d-m-Y', strtotime($r->request_date))])) {
                    $data[date('d-m-Y', strtotime($r->request_date))]++;
                } else {
                    $data[date('d-m-Y', strtotime($r->request_date))] = 1;
                }
                //$arrStatisticsData[] = array("2010", 10, " color: gray");
            }

            foreach($data as $key => $value) {
                $arrStatisticsData[] = array($key, (int)$value, " color: blue");
            }
            /*$arrStatisticsData[] = array("2010", 10, " color: gray");
            $arrStatisticsData[] = array("2010", 200, "color: #76A7FA");
            $arrStatisticsData[] = array("2020", 16, "opacity: 0.2");
            $arrStatisticsData[] = array("2040", 22, "stroke-color: #703593; stroke-width: 4; fill-color: #C5A5CF");
            $arrStatisticsData[] = array("2040", 28, "stroke-color: #871B47; stroke-opacity: 0.6; stroke-width: 8; fill-color: #BC5679; fill-opacity: 0.2");*/

            return json_encode($arrStatisticsData);
        }
        else
        {
            return Redirect::to("/")->with("errors_login", "Please log in first");
        }
    }
}
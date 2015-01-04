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

        if(!Input::has("app_name"))
            $errors[] = "Please enter app name!";

        if(!Input::has("data_url"))
            $errors[] = "Please enter the URL from where data should be fetched!";

        if(!Input::has("rating_type"))
            $errors[] = "Please enter a rating type!";


        if(empty($errors))
        {
            $strAppName = Input::get("app_name");
            $strDataURL = Input::get("data_url");
            $strRatingType = Input::get("rating_type");

            if(empty($errors))
            {
                if (Auth::check())
                {
                    $app = new AppModel;

                    $app->app_secret = Uuid::generate();
                    $app->app_name = DB::connection()->getPdo()->quote($strAppName);
                    $app->userid = (int)Auth::user()->id;
                    $app->data_url = DB::connection()->getPdo()->quote($strDataURL);
                    $app->rating_type = DB::connection()->getPdo()->quote($strRatingType);

                    $app->save();

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
            $appData = AppModel::where("app_id", "=", $nAppID)->get();

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

        if(!Input::has("app_name"))
            $errors[] = "Please enter app name!";

        if(!Input::has("data_url"))
            $errors[] = "Please enter the URL from where data should be fetched!";

        if(!Input::has("rating_type"))
            $errors[] = "Please enter a rating type!";

        if(empty($errors))
        {
            $strAppName = Input::get("app_name");
            $strDataURL = Input::get("data_url");
            $strRatingType = Input::get("rating_type");

            if(Auth::check())
            {
                try
                {
                    $app = AppModel::where("app_id", "=", $nAppID)->update(
                        array(
                            "app_name" => DB::connection()->getPdo()->quote($strAppName),
                            "data_url" => DB::connection()->getPdo()->quote($strDataURL),
                            "rating_type" => DB::connection()->getPdo()->quote($strRatingType)
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


    /**
     * All apps for a user.
     *
     * @return array
     */
    public function userApps()
    {
        $database = App::make("database");

        return DB::table("apps")->where("userid", "=", Auth::user()->id);
    }



    public function getAppUsers($nAppID)
    {
        if(Auth::check())
        {
            $arrUserIDs["response"] = array();

            $arrPreferenceData = PreferenceModel::where("app_id", "=", $nAppID)->get();
            foreach($arrPreferenceData as $objPreferenceData)
            {
                if(!in_array($objPreferenceData->user_id, $arrUserIDs["response"]))
                {
                    $arrUserIDs["response"][] = $objPreferenceData->user_id;
                }
            }

            return json_encode($arrUserIDs);
        }
        else
        {
            return Redirect::to("/")->with("errors_login", "Please log in first");
        }
    }



    public function getAppRecommendation($nAppID, $nUserID, $strCategory)
    {
        if(Auth::check())
        {
            $arrPreferenceData = array();

            if($strCategory != "all")
            {
                $objCategory = CategoryModel::where("name", "=", $strCategory)->first();

                $arrPreferences = PreferenceModel::where("app_id", "=", $nAppID)
                    ->where("user_id", "=", $nUserID)
                    ->where("category", "=", $objCategory->id)
                    ->orderBy("rating", "desc")
                    ->get();
            }
            else
            {
                $arrPreferences = PreferenceModel::where("app_id", "=", $nAppID)
                    ->where("user_id", "=", $nUserID)
                    ->orderBy("rating", "desc")
                    ->get();
            }

            foreach($arrPreferences as $objPreference)
            {
                $objItemCategory = CategoryModel::where("id", "=", $objPreference->category)->first();

                $arrPreferenceData["response"][] = array(
                    "item_id" => $objPreference->item_id,
                    "category" => $objItemCategory->name,
                    "rating" => $objPreference->rating,
                );
            }

            return json_encode($arrPreferenceData);
        }
        else
        {
            return Redirect::to("/")->with("errors_login", "Please log in first");
        }
    }
}
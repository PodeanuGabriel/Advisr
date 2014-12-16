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

        if(!Input::has("rating_type"))
            $errors[] = "Please enter a rating type!";


        if(empty($errors))
        {
            $strAppName = Input::get("name");
            $strDataURL = Input::get("data_url");
            $strRatingType = Input::get("rating_type");

            if(empty($errors))
            {
                if (Auth::check())
                {
                    $app = new AppModel;

                    $app->appsecret = Uuid::generate();
                    $app->name = DB::connection()->getPdo()->quote($strAppName);
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
            $appData = AppModel::where('appid', '=', $nAppID)->get();

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

        if(!Input::has("rating_type"))
            $errors[] = "Please enter a rating type!";

        if(empty($errors))
        {
            $strAppName = Input::get("name");
            $strDataURL = Input::get("data_url");
            $strRatingType = Input::get("rating_type");

            if(Auth::check())
            {
                try
                {
                    $app = AppModel::where('appid', '=', $nAppID)->update(
                        array(
                            "name" => DB::connection()->getPdo()->quote($strAppName),
                            "data_url" => DB::connection()->getPdo()->quote($strDataURL),
                            "rating_type" => DB::connection()->getPdo()->quote($strRatingType)
                        )
                    );
                }
                catch(Exception $exc)
                {
                    return View::make('dashboard')->with('error', 'App retrieval failed');
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


    public function getAppRecommendation($nAppID, $nProductID, $strCategory)
    {
        if(Auth::check())
        {
            $arrMockupData = array(
                "response" => array(
                    array(
                        "product_id" => 23,
                        "category" => $strCategory,
                        "value" => 34,
                    ),
                    array(
                        "product_id" => 28,
                        "category" => $strCategory,
                        "value" => 32,
                    ),
                    array(
                        "product_id" => 36,
                        "category" => "auto",
                        "value" => 30,
                    ),
                    array(
                        "product_id" => 102,
                        "category" => "electrocasnice",
                        "value" => 28,
                    ),
                ),
            );

            return json_encode($arrMockupData);
        }
        else
        {
            return Redirect::to("/")->with("errors_login", "Please log in first");
        }
    }


    public function getAppCategories($nAppID)
    {
        if(Auth::check())
        {
            $arrMockupData = array(
                "response" => array(
                    "auto",
                    "electrocasnice",
                    "electronice",
                    "imbracaminte",
                    "decorative",
                ),
            );

            return json_encode($arrMockupData);
        }
        else
        {
            return Redirect::to("/")->with("errors_login", "Please log in first");
        }
    }
}
<?php

class CategoryController extends BaseController
{
    public function addCategory()
    {
        $errors = array();

        if(!Input::has("category_name"))
            $errors[] = "Please enter category name!";

        if(empty($errors))
        {
            $strCategoryName = Input::get("category_name");

            if (empty($errors))
            {
                if (Auth::check())
                {
                    try
                    {
                        $category = new CategoryModel();

                        $category->id = Uuid::generate();
                        $category->name = $strCategoryName;

                        $category->save();
                    }
                    catch (Exception $exc)
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

    public function getCategories()
    {
        if(Auth::check())
        {
            $arrCategoryNames["response"] = array();

            try
            {
                $arrCategories = CategoryModel::all();
                foreach($arrCategories as $objCategory)
                {
                    if(!in_array($objCategory->name, $arrCategoryNames["response"]))
                    {
                        $arrCategoryNames["response"][] = $objCategory->name;
                    }
                }
            }
            catch(Exception $exc)
            {
                return Redirect::to("dashboard")->with("errors", $exc->getMessage());
            }

            return json_encode($arrCategoryNames);
        }
        else
        {
            return Redirect::to("/")->with("errors_login", "Please log in first");
        }
    }
}
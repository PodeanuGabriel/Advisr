<?php

class CategoryController extends BaseController
{
    public function getCategories()
    {
        if(Auth::check())
        {
            $arrCategoryNames["response"] = array("all");

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
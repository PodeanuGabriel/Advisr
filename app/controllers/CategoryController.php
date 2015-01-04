<?php

class CategoryController extends BaseController
{
    public function getCategories()
    {
        if(Auth::check())
        {
            $arrCategoryNames["response"] = array("all");

            $arrCategories = CategoryModel::all();
            foreach($arrCategories as $objCategory)
            {
                if(!in_array($objCategory->name, $arrCategoryNames["response"]))
                {
                    $arrCategoryNames["response"][] = $objCategory->name;
                }
            }

            return json_encode($arrCategoryNames);
        }
        else
        {
            return Redirect::to("/")->with("errors_login", "Please log in first");
        }
    }
}
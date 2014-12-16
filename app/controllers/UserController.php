<?php

class UserController extends BaseController
{
	public function signup()
	{
        if(Request::isMethod("post"))
        {
            $errors = array();

            if(!Input::has("name"))
                $errors[] = "Please enter your name!";

            if(!Input::has("email"))
                $errors[] = "Please enter your email!";

            if(!Input::has("password"))
                $errors[] = "Please enter a password!";

            if(!Input::has("confirm_password"))
                $errors[] = "Please enter a password confirmation!";


            if(empty($errors))
            {
                $name = Input::get("name");
                $email = Input::get("email");
                $password = Input::get("password");
                $confirm_password = Input::get("confirm_password");

                if($password !== $confirm_password)
                    $errors[] = "Passwords do not match!";

                if(User::where("email", $email)->first())
                    $errors[] = "Email already in use!";


                if(empty($errors))
                {
                    $user = new User;

                    $user->name = $name;
                    $user->email = $email;
                    $user->password = Hash::make($password);

                    $user->save();

                    return $this->authenticate($email, $password);
                }
                else
                {
                    return Redirect::to("signup")->with("errors", $errors);
                }
            }
            else
            {
                return Redirect::to("signup")->with("errors", $errors);
            }
        }
        else if(Request::isMethod("get"))
        {
            return View::make("signup");
        }
	}

    public function login()
    {
        //\Event::listen("illuminate.query", function($s, $b) { var_dump($s, $b); });

        $errors = array();

        if(Input::has("email"))
            $email = Input::get("email");
        else
            $errors[] = "Please enter your email!";

        if(Input::has("password"))
            $password = Input::get("password");
        else
            $errors[] = "Please enter a password!";

        if(empty($errors))
        {
            return $this->authenticate($email, $password);
        }
        else
        {
            return Redirect::to("/")->with("errors_login", $errors);
        }
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();

        return Redirect::to("/");
    }

    public function authenticate($email, $password)
    {
        if(Auth::attempt(array("email" => $email, "password" => $password), true))
        {
            return Redirect::to("dashboard");
        }
        else
        {
            return Redirect::to("/")->with("errors_login", "Incorect email or password");
        }
    }
}

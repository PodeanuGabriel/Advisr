<?php

class DemoController extends BaseController
{
    public function page1(){
        return View::make('demo.page1');
    }
    public function page2(){
        return View::make('demo.page2');
    }public function page3(){
    return View::make('demo.page3');
}
    public function page4(){
        return View::make('demo.page4');
    }

    public function page5(){
        return View::make('demo.page5');
    }

    public function page6(){
        return View::make('demo.page6');
    }

    public function page7(){
        return View::make('demo.page7');
    }

    public function page8(){
        return View::make('demo.page8');
    }

    public function page(){
        return View::make('demo.page');
    }

}
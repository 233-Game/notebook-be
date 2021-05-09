<?php


namespace App\Http\Controllers\User;


use App\Http\Controllers\Controller;

class InfoController extends Controller
{
    public function show(){
        return $this->success([
            'user'
        ]);
    }

    public function update(){

    }

    public function config(){

    }

}

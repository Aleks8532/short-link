<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LinksController extends Controller
{
    //
    public function index(){
        return view('links.index');
    }

    public function redirect(Request $request, $aliasLink)
    {
        // TODO проверка существования и активности короткой ссылки + отметка в статистике
    }
}

<?php

namespace App\Http\Controllers\Ajax;

use App\Link;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LinksController extends Controller
{
    //
    public function add(Request $request)
    {
        $linkFull = $request->input('link-input');
        $linkAlias = $request->input('self-text') ?? '';
        $lifetime = $request->input('lifetime') ?? 60*60*24;
        $isCommercial = $request->input('commercial') ?? false;

        $result = Link::shorteningLink($linkFull, $linkAlias, $lifetime, $isCommercial);

        return $result;
    }
}

<?php

namespace Organization\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LangController extends Controller
{
    public function __invoke(Request $request)
    {
        if ($request->input('lang') == 'en')
            session()->put('lang', 'en');
        else
            session()->put('lang', 'ar');

        return redirect()->back();
    }
}

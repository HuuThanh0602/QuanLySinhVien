<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LangController extends Controller
{
    public function changLang(Request $request)
    {
        $lang = $request->only('locale');
        $request->session()->put('lang', $lang['locale']);
        return redirect()->back();
    }
}

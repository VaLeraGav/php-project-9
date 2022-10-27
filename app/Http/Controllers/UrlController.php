<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;


class UrlController extends Controller
{
    public function index()
    {
        $urls = DB::table('urls')->orderBy('id')->paginate(10);
        // $newUrl = new Url();
        return view('urls.index', compact('urls'));
    }

    public function store(Request $request)
    {
//        $this->validate($request, [
//            'url.name' => 'url|required|max:255',
//        ]);

        $validator = Validator::make($request->all(), [
            'url.name' => 'url|required|max:255',
        ]);

        if ($validator->fails()) {
            flash('Некорректный URL')->error();
            return redirect()->route('welcome')->withErrors($validator);
        }

        $newUrl = DB::table('urls')->insertGetId(
            [
                'name' => $request,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );
        return redirect()
            ->route('urls.index');
    }

    function show($id)
    {
        $url = DB::table('urls')->find($id);
        return view('urls.show', compact('url'));
    }


}

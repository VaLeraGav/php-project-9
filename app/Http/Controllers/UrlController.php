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
        $validator = Validator::make($request->all(), [
            'url.name' => 'url|required|max:255',
        ]);

        if ($validator->fails()) {
            flash('Некорректный URL')->error();
            return redirect()->route('welcome')->withErrors($validator);
        }
        $formData = $request->input('url');
        $urlData = parse_url($formData['name']);
        $normalizedUrl = strtolower("{$urlData['scheme']}://{$urlData['host']}");

        $url = DB::table('urls')->where('name', $normalizedUrl)->first();

        if ($url) {
            flash("Страница \"{$url->name}\" существует")->warning();
            $id = $url->id;
        } else {
            $id = DB::table('urls')->insertGetId(
                [
                    'name' => $normalizedUrl,
                    'created_at' => Carbon::now('Europe/Moscow'),
                ]
            );
            flash('Страница успешно добавлена')->success();
        }
        return redirect()->route('urls.show', $id);
    }

    function show($id)
    {
        $url = DB::table('urls')->find($id);
        return view('urls.show', compact('url'));
    }
}

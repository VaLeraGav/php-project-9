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

        $lastChecks = DB::table('url_checks')
            ->latest()
            ->distinct('url_id')
            ->orderBy('url_id')
            ->get()
            ->keyBy('url_id');

        return view('urls.index', compact('urls', 'lastChecks'));
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
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
            $id = $url->id;

            flash("Страница \"{$url->name}\" существует")->warning();
        } else {
            $id = DB::table('urls')->insertGetId(
                [
                    'name' => $normalizedUrl,
                    'created_at' => Carbon::now('Europe/Moscow'),
                    'updated_at' => Carbon::now('Europe/Moscow'),
                ]
            );

            flash('Страница успешно добавлена')->success();
        }
        return redirect()->route('urls.show', $id);
    }

    function show($id)
    {
        $url = DB::table('urls')->find($id);
        abort_unless($url, 404);

        $urlChecks = DB::table('url_checks')
            ->where('url_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('urls.show', compact('url', 'urlChecks'));
    }
}

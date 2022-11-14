<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;

class UrlController extends Controller
{
    public function index()
    {
        $urls = DB::table('urls')->orderBy('id')->paginate(10);

        $lastChecks = DB::table('url_checks')
            ->orderBy('url_id')
            ->distinct('url_id')
            ->get()
            ->keyBy('url_id');

        return view('urls.index', compact('urls', 'lastChecks'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'url.name' => 'url|required|max:255',
        ]);

        if ($validator->fails()) {
            flash('Некорректный URL')->error();
            // return redirect()->route('welcome')->withErrors($validator);
            return response(View::make('welcome'), 422);
        }

        $formData = $request->input('url');
        $urlData = parse_url($formData['name']);
        $normalizedUrl = strtolower("{$urlData['scheme']}://{$urlData['host']}");

        $url = DB::table('urls')->where('name', $normalizedUrl)->first();

        if (!is_null($url)) {
            $id = $url->id;
            flash("Страница уже существует")->warning();
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
        // return redirect()->route('urls.show', ['url' => $id]);
    }

    function show($id)
    {
        $url = DB::table('urls')->find($id);

        abort_unless($url, 404);

        $urlChecks = DB::table('url_checks')
            ->where('url_id', $id)
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('urls.show', compact('url', 'urlChecks'));
    }
}

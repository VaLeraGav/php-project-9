<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use DiDom\Document;
use GuzzleHttp\Exception\ConnectException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class UrlCheckController extends Controller
{
    public function store(int $id): \Illuminate\Http\RedirectResponse
    {
        try {
            $url = DB::table('urls')->find($id);
            abort_unless($url, 404);
            $response = Http::get($url->name);

            $document = new Document($response->body());
            $h1 = optional($document->first('h1'))->text();
            $title = optional($document->first('title'))->text();
            $description = optional($document->first('meta[name=description]'))->getAttribute('content');

            $check = [
                'url_id' => $id,
                'status_code' => $response->status(),
                'h1' => $h1,
                'title' => $title,
                'description' => $description,
                'created_at' => Carbon::now('Europe/Moscow'),
                'updated_at' => Carbon::now('Europe/Moscow')
            ];

            DB::table('url_checks')->insert($check);

            DB::table('urls')->where('id', $id)->update(
                [
                    'updated_at' => Carbon::now('Europe/Moscow')
                ]
            );

            flash('Сайт проанализирован!')->warning();
        } catch (ConnectException $e) {
            flash("Error: {$e->getMessage()}")->error();
        }

        return redirect()->route('urls.show', $id);
    }

}

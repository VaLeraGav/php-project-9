<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use GuzzleHttp\Exception\ConnectException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UrlCheckController extends Controller
{
    public function store(int $id): \Illuminate\Http\RedirectResponse
    {
        $urlId = DB::table('urls')->find($id);
        try {
//            $check = [
//                'url_id' => $id,
//                'status_code' => 200,
//                'h1' => 'test-h1',
//                'keywords' => 'test-keywords',
//                'description' => 'test-description',
//                'created_at' => $urlId->created_at,
//                'updated_at' => Carbon::now()
//            ];
//
//            DB::table('url_checks')->insert($check);

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

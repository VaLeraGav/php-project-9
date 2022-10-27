<?php

namespace App\Http\Controllers;

//use App\Models\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class UrlController extends Controller
{
    public function index()
    {
        $urls = DB::table('urls')->orderBy('id')->paginate(10);
        // $newUrl = new Url();
        return view('urls.index', compact('urls' ));
    }

    /**
     * @throws ValidationException
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $this->validate($request, [
            'url.name' => 'url|required|max:255',
        ]);

        // страница успешно добавлена
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

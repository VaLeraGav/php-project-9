<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class UrlController extends Controller
{
    public function index()
    {
        $urls = DB::table('urls')->orderBy('id')->paginate(10);
        $newUrl = new Url();
        return view('urls.index', compact('urls','newUrl' ));
    }

    /**
     * @throws ValidationException
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $this->validate($request, [
            'url.name' => 'required|max:255|url',
        ]);
        $newUrl = new Url();
        $newUrl->fill($request->all());
        $newUrl->save();

        return redirect()
            ->route('index');
    }

    function show()
    {
        return view('urls.show');
    }
}

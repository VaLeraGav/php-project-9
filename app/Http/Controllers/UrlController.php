<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UrlController extends Controller
{

    public function index()
    {
        $urls = Url::all();
        $newUrl = new Url();
        return view('urls.index', compact('urls','newUrl' ));
    }

    /**
     * @throws ValidationException
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required|max:25|unique:urls',
        ]);
        $url = new Url();
        $url->fill($request->all());
        $url->save();

        return redirect()
            ->route('index');
    }

}

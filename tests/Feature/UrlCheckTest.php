<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UrlCheckTest extends TestCase
{
    private int $id;

    public function setUp(): void
    {
        parent::setUp();

        $data = [
            'name' => 'https://google.com',
            'created_at' => Carbon::now(),
        ];

        $this->id = DB::table('urls')->insertGetId($data);
    }
    function  testStore()
    {
        $response = $this->post(route('urls.checks.store', $this->id));
        $response->assertSessionHasNoErrors();
    }

}

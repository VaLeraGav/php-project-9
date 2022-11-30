<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Http;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UrlCheckControllerTest extends TestCase
{
    public function testStore(): void
    {
        $data = [
            'name' => 'https://google.com',
            'created_at' => Carbon::now(),
        ];
        $id = DB::table('urls')->insertGetId($data);

        $path = __DIR__ . '/../fixtures/test.html';
        $fakeHtml = file_get_contents($path);

        if ($fakeHtml === false) {
            throw new \Exception("error with the file $path");
        }

        Http::fake([
            $data['name'] => Http::response($fakeHtml, 200)
        ]);

        $response = $this->post(route('urls.checks.store', $id));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();

        $expected = [
            'url_id' => $id,
            'status_code' => 200,
            'h1' => 'Header',
            'title' => 'Title',
            'description' => 'description',
        ];
        $this->assertDatabaseHas('url_checks', $expected);
    }
}

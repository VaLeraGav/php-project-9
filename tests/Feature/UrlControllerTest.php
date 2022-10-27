<?php


namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UrlControllerTest extends TestCase
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

    public function testIndex(): void
    {
        $response = $this->get(route('urls.index'));
        $response->assertOk();
    }

    public function testShow(): void
    {
        $response = $this->get(route('urls.show', $this->id));
        $response->assertOk();
    }

    public function testStore(): void
    {
        $data = [
            'url' => [
                'name' => 'https://hexlet.io'
            ]
        ];
        $response = $this->post(route('urls.store'), $data);
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('urls', $data['url']);
    }

}

<?php

namespace Tests\Feature;

use App\Models\Facility;
use Tests\TestCase;
use App\Models\User;

class FacilityControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->normal = User::factory()->create(['is_admin'=>false]);
        $this->admin=User::factory()->create(['is_admin'=>true]);
    }

    /**
     * 設備の一覧画面が表示されるか
     * @test
     */
    public function 一覧画面表示()
    {
        //未ログイン時ログイン画面へリダイレクト
        $response=$this->get(route('facility.index'));
        $response->assertRedirect(route('login'));

        //ログイン時は表示可能
        $response = $this->actingAs($this->normal)
            ->get(route('facility.index'));
        $response->assertStatus(200);
    }
}

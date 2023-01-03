<?php

namespace Tests\Feature;

use App\Models\Facility;
use App\Models\Reservation;
use App\Models\User;
use Tests\TestCase;

class ReservationControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->normal = User::factory()->create(['is_admin' => false]);
        $this->admin = User::factory()->create(['is_admin' => true]);
    }

    /**
     * @test
     */
    public function 予約一覧が表示されるかどうか()
    {
        $facility = Facility::factory()->create();
        $reservation = Reservation::factory()->create(['facility_id' => $facility->id]);

        //未ログイン時
        $response = $this->get(route('reservation.index', ['facilityId' => $reservation->facility_id]));
        $response->assertStatus(302);

        //ログイン時
        $response = $this->actingAs($this->normal)->get(route('reservation.index', ['facilityId' => $reservation->facility_id]));
        $response->assertStatus(200);
    }

    /**
     * ユーザー・予約を検索するものとしないもので2種類作成し、結果通りになっているかを確認
     * @test
     */
    public function 予約の検索結果が正しく表示されるかどうか()
    {
        $facility = Facility::factory()->create();
        $reservation = Reservation::factory()->create([
            'facility_id' => $facility->id,
            'user_id' => $this->normal->id,
        ]);

        $otherUser = User::factory()->create();
        $otherReservation = Reservation::factory()->create();

        $response = $this->actingAs($this->normal)->get(route('reservation.index', [
            'facilityId' => $facility->id,
            'subscriber' => $this->normal->name,
            'start_time' => $reservation->starttime,
        ]));

        $response->assertStatus(200);
        $response->assertSee($this->normal->name);
        $response->assertSee($reservation->starttime);
        $response->assertDontSee($otherUser->name);
        $response->assertDontSee($otherReservation->starttime);
    }
}

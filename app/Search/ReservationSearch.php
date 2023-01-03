<?php

namespace App\Search;

use Search\Searchable;
use Illuminate\Database\Eloquent\Builder;

class ReservationSearch extends Searchable
{
    public function __construct()
    {
        $this->params = [
            'subscriber' => [
                'type' => 'callback',
                'operator' => '=',
                'method' => [$this, 'searchSubScriber'],
            ],
            'start_time' => [
                'type' => 'callback',
                'method' => [$this, 'searchStartTime'],
            ],
        ];
    }

    public function searchSubScriber(Builder $builder, $key, $value)
    {
        $builder->whereHas('user', function ($query) use ($value) {
            $query->where('name', 'like', '%' . $value . '%');
        });
    }

    public function searchStartTime(Builder $builder, $key, $value)
    {
        $builder->where('starttime', '=', $value);
    }
}

<?php

namespace App\Models\Tenant;

use App\Models\BaseModel;
use App\Models\Country;
use App\Models\Region;
use Carbon\Carbon;

class Branch extends BaseModel
{
    protected $appends = ['distance'];

    protected $guarded = [];

    public function WorkTime()
    {
        return $this->hasMany(BranchWorktime::class)->orderBy('open');
    }

    public function Country()
    {
        return $this->belongsTo(Country::class);
    }

    public function AvilableNow()
    {
        foreach ($this->WorkTime as $key => $WorkTime) {
            $now = now();
            $start = Carbon::createFromTimeString($WorkTime->open);
            $end = Carbon::createFromTimeString($WorkTime->close);
            if ($start > $end) {
                $end = $end->addDay();
            }
            if ($now->between($start, $end) || $now->addDay()->between($start, $end)) {
                return true;
            }
        }

        return false;
    }

    public function getDistanceAttribute()
    {
        if (request()->lat && request()->long) {
            $angle = 2 * asin(sqrt(pow(sin(deg2rad($this->lat) - deg2rad(request()->lat) / 2), 2) + cos(deg2rad(request()->lat)) * cos(deg2rad($this->lat)) * pow(sin(deg2rad($this->long) - deg2rad(request()->long) / 2), 2)));

            return number_format($angle * 6371000, 3, '.', '');
        } else {
            return null;
        }
    }
}

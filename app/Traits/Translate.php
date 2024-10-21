<?php

namespace App\Traits;

trait Translate
{
    public function title()
    {
        return $this['title_'.lang()] ?? null;
    }

    public function desc()
    {
        return $this['desc_'.lang()] ?? null;
    }

    public function price()
    {
        return number_format($this->price - ($this->price / 100 * $this->discount), DefaultCurrancy()->decimals, '.', '') . ' ' . DefaultCurrancy()->currancy_code;
    }

    public function address()
    {
        return $this['address_'.lang()] ?? null;
    }

    public function working_time()
    {
        return $this['working_time_'.lang()] ?? null;
    }
}

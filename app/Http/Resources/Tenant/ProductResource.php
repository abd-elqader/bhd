<?php

namespace App\Http\Resources\Tenant;

class ProductResource extends BaseResource
{
    public function toArray($request)
    {
        $AllData = [];
        foreach ($this->SizeColor->groupBy('size_id') as $size_id => $SizeItems) {
            $data = collect();
            $FirstItem = $SizeItems->first();
            $FirstItemSize = $FirstItem->Size;
            $data['id'] = $FirstItemSize?->id;
            $data['title'] = $FirstItemSize?->title();
            $data['price_before'] = $FirstItem->Price().' '.DefaultCurrancy()->currancy_code;
            $data['price_after'] = $FirstItem->CalcPrice().' '.DefaultCurrancy()->currancy_code;
            $data['discount'] = $FirstItemSize?->discount ?? 0;
            $data['colors'] = $SizeItems->whereNotNull('color_id')->count() > 0 ? SizeColorResource::collection($SizeItems) : [];
            if ($this->Images->whereNotNull('color_id')->count() > 0) {
                foreach ($SizeItems as $ColorItem) {
                    $ColorItem->images = ImageResource::collection($this->Images->where('color_id', $ColorItem->color_id));
                }
            } else {
                $data['images'] = ImageResource::collection($this->Images);
            }
            $AllData[] = $data;
        }

        return [
            'id' => $this->id,
            'title' => $this->title(),
            'desc' => preg_replace("/\r|\n/", '', strip_tags($this->desc())),
            'is_fav' => $this->IsFav(),
            'rate' => $this->rate() ?? 0,
            'rates' => RateResource::collection($this->Rates),
            'sizes' => $AllData,
        ];
    }
}

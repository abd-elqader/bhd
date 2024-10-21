<?php

namespace App\Http\Controllers\Tenant\API;

use App\Helper\ResponseHelper;
use App\Http\Requests\Tenant\API\ProductReviewRequest;
use App\Http\Resources\Tenant\RateResource;
use App\Models\Tenant\ProductReview;
use Illuminate\Http\Request;

class ProductReviewsController extends BaseController
{
    public function index($lang, Request $request)
    {
        $this->CheckAuth();
        $query = ProductReview::query()
            ->with(['Product'])
            ->where('client_id', auth('sanctum')->id());
        $ProductReviewes = $query->get();
        $this->CheckCount($ProductReviewes);

        return ResponseHelper::make(RateResource::collection($ProductReviewes));
    }

    public function store($lang, ProductReviewRequest $request)
    {
        $this->CheckAuth();
        if (ProductReview::where('client_id', auth('sanctum')->id())->where('product_id', $request->product_id)->count() > 0) {
            ProductReview::where('client_id', auth('sanctum')->id())->where('product_id', $request->product_id)->update($request->validated());
            $ProductReview = ProductReview::where('client_id', auth('sanctum')->id())->where('product_id', $request->product_id)->first();
        } else {
            $ProductReview = ProductReview::create(['client_id' => auth('sanctum')->id()] + $request->validated());
        }

        return ResponseHelper::make(RateResource::make($ProductReview), __('messages.addedSuccessfully'));
    }

    public function show($lang, $id, Request $request)
    {
        $this->CheckAuth();
        $ProductReview = ProductReview::query()
            ->where('id', $id)
            ->with(['Product'])
            ->where('client_id', auth('sanctum')->id())
            ->first();
        $this->CheckExist($ProductReview);

        return ResponseHelper::make(RateResource::make($ProductReview));
    }

    public function update($lang, $id, ProductReviewRequest $request)
    {
        $this->CheckAuth();
        $ProductReview = ProductReview::where('client_id', auth('sanctum')->id())->where('product_id', $id)->first();
        $this->CheckExist($ProductReview);
        $ProductReview->update($request->validated());

        return ResponseHelper::make(RateResource::make($ProductReview), __('messages.updatedSuccessfully'));
    }

    public function destroy($lang, $id)
    {
        $this->CheckAuth();
        $this->CheckExist(ProductReview::where('client_id', auth('sanctum')->id())->where('product_id', $id)->first());
        ProductReview::where('client_id', auth('sanctum')->id())->where('product_id', $id)->delete();

        return ResponseHelper::make(null, __('messages.DeletedSuccessfully'));
    }
}

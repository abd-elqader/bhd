<?php

namespace App\Http\Controllers\Tenant\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\User\ContactRequest;
use App\Http\Requests\Tenant\User\SubscribeRequest;
use App\Models\Contact;
use App\Models\FAQ;
use App\Models\Tenant;
use App\Models\Region;
use App\Models\Tenant\Category;
use App\Models\Tenant\Coupon;
use App\Models\Tenant\Order;
use App\Models\Tenant\Product;
use App\Models\Tenant\ProductReview;
use App\Models\Tenant\ProductSizeColor;
use App\Models\Tenant\Subscribe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class IndexController extends Controller
{
    public function index()
    {
        // dd(visitor()->browser());
        // try{
        //     // visitor()->visit();
        // }catch (\Exception $e) {
        //     $client = DB::connection('mysql')->table('clients')->where('domain_name',str_replace("https://", "",current(explode('.', url()->full()))))->first();
        //     session()->put('data', (array)$client);
        //     CreateDB($client->domain_name);
        //     AssignAllPrivileges($client->domain_name);
        //     CreateSubDomain($client->domain_name);
        //     $tenant = Tenant::firstOrCreate(['id' => $client->domain_name],['id' => $client->domain_name, 'client_id' => $client->id]);
        //     try{
        //         $tenant->domains()->create(['domain' => $client->domain_name.'.'.env('APP_DOMAIN')]);
        //     }catch (\Exception $e) {

        //     }
        // 	\Artisan::call('tenants:migrate-fresh', [
        //         '--tenants' => [$client->domain_name],
        //     ]);
        //     \Artisan::call('tenants:seed', [
        //         '--tenants' => [$client->domain_name],
        //         '--force' => true
        //     ]);
        // }
        $components = theme('Home');

        return view('Tenant.User.layout', compact('components'));
    }

    public function login()
    {
        if (auth('client')->user()) {
            return redirect()->route('client.home');
        }
        $components = theme('Profile');
        $components['Profile'] = 'login1';
        $components = array_flip($components);
        $components['login1'] = 'Login';
        $components = array_flip($components);

        return view('Tenant.User.layout', compact('components'));
    }

    public function register()
    {
        if (auth('client')->user()) {
            return redirect()->route('client.home');
        }

        $components = theme('Profile');
        $components['Profile'] = 'register1';
        $components = array_flip($components);
        $components['register1'] = 'Register';
        $components = array_flip($components);

        return view('Tenant.User.layout', compact('components'));
    }

    public function forget()
    {
        if (auth('client')->user()) {
            return redirect()->route('client.home');
        }

        $components = theme('Profile');
        $components['Profile'] = 'fotget1';
        $components = array_flip($components);
        $components['fotget1'] = 'Forget';
        $components = array_flip($components);

        return view('Tenant.User.layout', compact('components'));
    }

    public function profile($section = 'index')
    {
        if (! auth('client')->check()) {
            return redirect()->route('client.login');
        }
        $page = 'profile';
        $components = theme('Profile');
        $currentOrders = Order::where('client_id', auth('client')->user()->id)->whereIn('status', [0, 1])->whereIn('follow', [0, 1, 2])->orderBy('id', 'desc')->get();
        $previousOrders = Order::where('client_id', auth('client')->user()->id)->whereIn('status', [1])->whereIn('follow', [3])->orderBy('id', 'desc')->get();

        return view('Tenant.User.layout', compact('components', 'currentOrders', 'previousOrders', 'section', 'page'));
    }

    public function cart()
    {
        $components = theme('Cart');

        return view('Tenant.User.layout', compact('components'));
    }

    public function Contact()
    {
        $components = theme('Profile');
        $components['Profile'] = 'contact1';
        $components = array_flip($components);
        $components['contact1'] = 'Contact';
        $components = array_flip($components);

        return view('Tenant.User.layout', compact('components'));
    }

    public function About()
    {
        $components = theme('Profile');
        $components['Profile'] = 'about1';
        $components = array_flip($components);
        $components['about1'] = 'About';
        $components = array_flip($components);
        return view('Tenant.User.layout', compact('components'));
    }

    public function FAQ()
    {
        $components = theme('Profile');
        $components['Profile'] = 'faq1';
        $components = array_flip($components);
        $components['faq1'] = 'FAQ';
        $components = array_flip($components);
        $faqs = FAQ::get();

        return view('Tenant.User.layout', compact('faqs', 'components'));
    }

    public function Terms()
    {
        $components = theme('Profile');
        $components['Profile'] = 'terms1';
        $components = array_flip($components);
        $components['terms1'] = 'Terms';
        $components = array_flip($components);

        return view('Tenant.User.layout', compact('components'));
    }

    public function Privacy()
    {
        $components = theme('Profile');
        $components['Profile'] = 'privacy1';
        $components = array_flip($components);
        $components['privacy1'] = 'Privacy';
        $components = array_flip($components);

        return view('Tenant.User.layout', compact('components'));
    }

    public function post_subscribe(SubscribeRequest $request)
    {
        Subscribe::create($request->validated());
        alert()->success(__('messages.We Will Contact You as soon as possible'));

        return redirect()->back();
    }

    public function post_contact(ContactRequest $request)
    {
        Contact::create($request->only(['phone', 'email', 'name', 'subject', 'message']));
        alert()->success(__('messages.We Will Contact You as soon as possible'));

        return redirect()->back();
    }

    public function product($product_id)
    {
        $components = theme('Product');
        $product_page_num = $components['Product'];
        $components['Product'] = 'pro';

        return view('Tenant.User.layout', compact('components', 'product_id', 'product_page_num'));
    }

    public function categories(Request $request)
    {
        $type = $request->type;
        $category_id = $request->category_id;
        $category_ids = [];
        $product_ids = [];
        $size_ids = [];
        $color_ids = [];
        $Search = '';
        if ($request['category_ids']) {
            $category_ids += $request['category_ids'];
        }
        if ($request['product_ids']) {
            $product_ids += $request['product_ids'];
        }
        if ($request['color_ids']) {
            $color_ids += $request['color_ids'];
        }
        if ($request['color_ids']) {
            $color_ids += $request['color_ids'];
        }
        if ($category_id) {
            $category_ids += [$category_id];
        }
        if ($request->search) {
            $Search = $request->search;
        }

        $components = theme('Category');
        $Categories = Category::Active()->get();
        $Products = Product::Active()->whereHas('SizeColor')->with(['Images', 'Categories', 'SizeColor' => ['Size', 'Color']])
            ->when($Search, function ($q) use ($Search) {
                return $q->where(function ($query) use ($Search) {
                    $query->Where('title_ar', 'like', '%'.$Search.'%')->orWhere('title_en', 'like', '%'.$Search.'%')->orWhere('code', 'like', '%'.$Search.'%');
                });
            })
            ->when(count($product_ids) > 0, function ($q) use ($product_ids) {
                return $q->whereIn('id', $product_ids);
            })
            ->when(count($size_ids) > 0, function ($q) use ($size_ids) {
                return $q->whereHas('SizeColor', function ($query) use ($size_ids) {
                    return $query->whereIn('size_id', $size_ids);
                });
            })
            ->when(count($color_ids) > 0, function ($q) use ($color_ids) {
                return $q->whereHas('SizeColor', function ($query) use ($color_ids) {
                    return $query->whereIn('color_id', $color_ids);
                });
            })
            ->when($request->max_price > 0, function ($q) use ($request) {
                return $q->whereHas('SizeColor', function ($query) use ($request) {
                    return $query->where('price', '<=', $request->max_price);
                });
            })
            ->when($request->min_price > 0, function ($q) use ($request) {
                return $q->whereHas('SizeColor', function ($query) use ($request) {
                    return $query->where('price', '>=', $request->min_price);
                });
            })
            ->when($type, function ($query) use ($type) {
                if ($type == 'sale') {
                    $query = $query->whereHas('SaleProducts')->withCount(['SaleProducts'])->orderBy('sale_products_count');
                } elseif ($type == 'most') {
                    $query = $query->withCount(['OrdersProducts'])->with('SizeColor')->orderBy('orders_products_count');
                } elseif ($type == 'latest') {
                    $query = $query->orderBy('created_at', 'DESC');
                } elseif ($type == 'high_rating') {
                    $query = $query->whereHas('FavProducts')->withCount(['FavProducts'])->orderBy('fav_products_count', 'DESC');
                } elseif ($type == 'low_rating') {
                    $query = $query->whereHas('FavProducts')->withCount(['FavProducts'])->orderBy('fav_products_count');
                } elseif ($type == 'title_asc') {
                    $query = $query->orderBy('title_'.lang());
                } elseif ($type == 'high_price') {
                    $ids = [];
                    foreach (ProductSizeColor::orderBy('price', 'desc')->select('product_id')->get() as $item) {
                        array_push($ids, $item->product_id);
                    }
                    $query = $query->orderByRaw('FIELD(id,'.implode(',', $ids).')');
                } elseif ($type == 'low_price') {
                    $ids = [];
                    foreach (ProductSizeColor::orderBy('price', 'asc')->select('product_id')->get() as $item) {
                        array_push($ids, $item->product_id);
                    }
                    $query = $query->orderByRaw('FIELD(id,'.implode(',', $ids).')');
                }
            })
            ->when(count($category_ids) > 0, function ($q) use ($category_ids) {
                return $q->whereHas('Categories', function ($query) use ($category_ids) {
                    return $query->whereIn('category_id', $category_ids);
                });
            })->paginate(15);

        $MaxPrice = $request->MaxPrice ?? 0;
        $MinPrice = $request->MinPrice ?? $MaxPrice;
        $Colors = collect();
        $Sizes = collect();
        foreach ($Products as $Product) {
            foreach ($Product->SizeColor as $Item) {
                if ($Item->price < $MinPrice) {
                    $MinPrice = $Item->price;
                }
                if ($Item->price > $MaxPrice) {
                    $MaxPrice = $Item->price;
                }
                if ($Item->Size) {
                    $Sizes->push($Item->Size);
                }
                if ($Item->Color) {
                    $Colors->push($Item->Color);
                }
            }
        }
        $Colors = $Colors->unique('id');
        $Sizes = $Sizes->unique('id');
        if ($MaxPrice == 0) {
            $MaxPrice = 50;
        }

        $product_page_num = $components['Products'] ?? abort(404);
        $components['Products'] = 'product';

        return view('Tenant.User.layout', compact('components', 'Categories', 'Products', 'Colors', 'Sizes', 'MinPrice', 'MaxPrice', 'size_ids', 'color_ids', 'category_ids', 'type', 'product_page_num'));
    }

    public function coupon(Request $request)
    {
        $coupon = Coupon::where('code', $request->coupon)->first();

        if ($coupon) {
            session()->put('coupon', $coupon);
            if ($coupon->type == 'discount') {
                $discount = $coupon->discount;

                return ['success' => 'success', 'discount' => $discount];
            } else {
                $percent = $coupon->percent_off;

                return ['success' => 'success', 'percent' => $percent];
            }
        } else {
            return ['failed' => 'failed'];
        }
    }

    public function ChangeDefaultCurrancy($id)
    {
        session()->put('DefaultCurrancy', $id);

        return redirect()->back();
    }

    public function addReview(Request $request)
    {
        if (auth('client')->check()) {
            ProductReview::create([
                'client_id' => auth('client')->id(),
                'product_id' => $request->product_id,
                'rate' => $request->rate,
                'comment' => $request->comment,
            ]);
            alert()->success(__('messages.thanks_for_rating'));

            return redirect()->back();
        } else {
            alert()->error(__('messages.You not auth'));

            return redirect()->back();
        }
    }

    public function CountryRegions($country_id)
    {
        $Append = '';
        foreach (Region::where('country_id', $country_id)->get() as $Region) {
            $Append .= '<option value="'.$Region->id.'">'.$Region->title().'</option>';
        }

        return response()->json($Append);
    }
}

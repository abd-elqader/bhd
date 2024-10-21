<?php

namespace App\Http\Controllers\Tenant\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\User\AddressRequest;
use App\Models\Country;
use App\Models\Region;
use App\Models\Block;
use App\Models\Tenant\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddressController extends Controller
{
    public function index()
    {
        $components = theme('Profile');
        $components['Profile'] = 'index';
        $components = array_flip($components);
        $components['index'] = 'Addresses';
        $components = array_flip($components);

        return view('Tenant.User.layout', compact('components'));
    }

    public function create()
    {
        $blocks = Block::get();
        $regions = Region::orderBy('title_'.app()->getLocale())->get();
        $country_id = Country::where('country_code', auth('client')->user()->country_code)->first()->id;
        $components = theme('Profile');
        $components['Profile'] = 'create';
        $components = array_flip($components);
        $components['create'] = 'Addresses';
        $components = array_flip($components);

        return view('Tenant.User.layout', compact('components', 'regions', 'country_id','blocks'));
    }

    public function store(AddressRequest $request)
    {
        DB::table('addresses')->insert([
            'client_id' => auth('client')->id(),
            'region_id' => $request->get('region_id'),
            'block_id' => $request->get('block_id'),
            'block' => $request->get('country_id') > 1 ? $request->get('district') : $request->get('block'),
            'road' => $request->get('road'),
            'building_no' => $request->get('building_no'),
            'floor_no' => $request->get('floor_no'),
            'apartment' => $request->get('apartment'),
            'type' => $request->get('type'),
            'lat' => $request->get('lat'),
            'long' => $request->get('long'),
            'additional_directions' => $request->get('additional_directions'),
        ]);
        if ($request->get('url') == '1') {
            alert()->success(__('messages.addedSuccessfully'));

            return redirect()->route('client.address.index');
        } else {
            alert()->success(__('messages.addedSuccessfully'));

            return redirect()->route('client.profile', 'address');
        }
    }

    public function edit($id)
    {
        $blocks = Block::get();
        $address = Address::findOrFail($id);
        $regions = Region::orderBy('title_'.app()->getLocale())->get();
        $country_id = Country::where('country_code', auth('client')->user()->country_code)->first()->id;
        $components = theme('Profile');
        $components['Profile'] = 'edit';
        $components = array_flip($components);
        $components['edit'] = 'Addresses';
        $components = array_flip($components);

        return view('Tenant.User.layout', compact('components', 'regions', 'country_id', 'address','blocks'));
    }

    public function update(Request $request, $id)
    {
        $address = Address::findOrFail($id);
        $address->region_id = $request->get('region_id');
        $address->block_id = $request->get('block_id');
        $address->block = $request->get('country_id') > 1 ? $request->get('district') : $request->get('block');
        $address->road = $request->get('road');
        $address->building_no = $request->get('building_no');
        $address->floor_no = $request->get('floor_no');
        $address->apartment = $request->get('apartment');
        $address->type = $request->get('type');
        $address->lat = $request->get('lat');
        $address->long = $request->get('long');
        $address->additional_directions = $request->get('additional_directions');

        $address->save();
        if ($request->get('url') == '1') {
            alert()->success(__('messages.updatedSuccessfully'));

            return redirect()->route('address.index');
        } else {
            alert()->success(__('messages.updatedSuccessfully'));

            return redirect()->route('client.profile', 'address');
        }
    }

    public function destroy($id)
    {
        $address = Address::findOrFail($id);
        try {
            $address->delete();
            alert()->success(__('messages.DeletedSuccessfully'));

            return redirect()->back();
        } catch (\Exception $e) {
            alert()->danger(__('messages.cantDeleteAddress'));

            return redirect()->back();
        }
    }
}

<?php

namespace App\Http\Controllers\Tenant\Admin;

use App\Models\Central\Delivery;
use App\Models\Tenant;
use App\Http\Controllers\Controller;

class DeliveryController extends Controller
{
    public function index()
    {
        $Deliveries = Delivery::active()->get();
        $Tenant = Tenant::where('id',tenant()->id)->first();
        $delivry_id_in = $Tenant->delivry_id_in;
        $charge_cost_in = $Tenant->charge_cost_in;
        $delivry_id_out = $Tenant->delivry_id_out;
        $charge_cost_out = $Tenant->charge_cost_out;
        return view('Tenant.Admin.deliverycompany',compact('Deliveries','delivry_id_in','charge_cost_in','delivry_id_out','charge_cost_out'));
    }

    public function update($id)
    {
        Tenant::where('id',tenant()->id)->update([
            'delivry_id_in'=>request()->delivry_id_in,
            'charge_cost_in'=>request()->charge_cost_in ?? 0,
            'delivry_id_out'=>request()->delivry_id_out,
            'charge_cost_out'=>request()->charge_cost_out ?? 0,
        ]);
        alert()->success(__('messages.updatedSuccessfully'));
        return redirect()->back();
    }
}

<?php
namespace App\Http\Controllers\Central\Admin;
use App\Helper\Upload;
use App\Http\Controllers\Controller;
use App\Http\Requests\Central\Admin\CreateServicesRequest;
use App\Http\Requests\Central\Admin\UpdateServicesRequest;
use App\Models\Central\Service;
use App\Models\Central\ServiceUser;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
class ServiceController extends Controller
{
    public function __construct()
    {
        // $this->middleware('permission:stores-list', ['only' => ['index', 'store']]);
        // $this->middleware('permission:stores-create', ['only' => ['create', 'store']]);
        // $this->middleware('permission:stores-edit', ['only' => ['edit', 'update']]);
        // $this->middleware('permission:stores-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $Subscriptions = ServiceUser::latest()->with('Service')->get();
        $Services = ServiceUser::latest()->paginate(8);
        return view('Tenant.Admin.services.services',compact('Services','Subscriptions'));
    }

    public function get_subscribers(Request $request)
    {
        $data = ServiceUser::with('Client','Service')->paginate(8);
        return view('Central.Admin.services.service-subscribers-index', ['data' => $data]);
    }

    public function admin_index()
    {
        $data = service::select('id', 'title', 'description', 'price', 'image')->paginate(8);
        return view('Central.Admin.services.adminservice', ['data' => $data]);
    }

    public function service_subscriber()
    {
        return view('Central.Admin.services.service-subscriber');
    }

    public function change_paid_state($id)
    {
        $data = ServiceUser::findOrFail($id);
        $newPaid = $data->paid ? 0 : 1;
        $data->update(['paid' => $newPaid ]);
        return redirect()->back()->with('success', 'Paid status toggled successfully.');
    }

    public function create(Request $request)
    {
        return view('Central.Admin.services.create');
    }
    public function store(CreateServicesRequest $request)
    {
        // Stores::latest()->create([
        //     'website' => Upload::UploadFile($request['website'], 'Stores'),
        //     'image' => Upload::UploadFile($request['image'], 'Stores'),
        // ] + $request->validated());
        // alert()->success(__('messages.addedSuccessfully'));
        // Prepare data to insert
        // $datatoinsert['title'] = strip_tags($request->service_title);
        // $datatoinsert['description'] = strip_tags($request->service_description);
        // $datatoinsert['price'] = $request->service_price;
        // Handle image upload
        // if ($request->hasFile('service_image')) {
        //     // Store the image in the 'public' disk, under the 'services' folder
        //     $datatoinsert['image'] = Upload::UploadFile($request->service_image , 'services');
        // }
        service::latest()->create(['image' => Upload::UploadFile($request['image'], 'services')] + $request->validated());
        // Save the service data into the database
        // service::create($datatoinsert);
        // Redirect to the services page with a success message
        return redirect()->route('admin.services.adminservices')->with('success', 'The service was added successfully');
        // return redirect()->back();
    }
    // public function show($id)
    // {
    //     $Store = Stores::latest()->findOrFail($id);
    //     return view('Central.Admin.stores.show', compact('Store'));
    // }
    // public function edit($id, Request $request)
    // {
    //     $Store = Stores::latest()->findOrFail($id);
    //     return view('Central.Admin.stores.edit', compact('Store'));
    // }
    // public function update(UpdateStoresRequest $request, $id)
    // {
    //     $Store = Stores::latest()->findOrFail($id);
    //     if ($request->hasFile('image') && $request->hasFile('website')) {
    //         Upload::deleteImage($Store->image);
    //         $Store->update([
    //             'website' => Upload::UploadFile($request['image'], 'Stores'),
    //             'image' => Upload::UploadFile($request['image'], 'Stores'),
    //         ] + $request->validated());
    //     } elseif ($request->hasFile('image')) {
    //         Upload::deleteImage($Store->image);
    //         $Store->update([
    //             'image' => Upload::UploadFile($request['image'], 'Stores'),
    //         ] + $request->validated());
    //     } elseif ($request->hasFile('website')) {
    //         Upload::deleteImage($Store->image);
    //         $Store->update([
    //             'image' => Upload::UploadFile($request['image'], 'Stores'),
    //         ] + $request->validated());
    //     } else {
    //         $Store->update($request->validated());
    //     }
    //     alert()->success(__('messages.updatedSuccessfully'));
    //     return redirect()->back();
    // }
    // public function destroy($id)
    // {
    //     Stores::latest()->where('id', $id)->delete();
    //     alert()->success(__('messages.DeletedSuccessfully'));
    //     return redirect()->back();
    // }
    public function edit($id)
    {
        $data = service::find($id);
        return view('Central.Admin.services.edit', ['data' => $data]);
    }
    public function update(UpdateServicesRequest $request, $id)
    {
        // dd($request);
        $data = Service::latest()->findOrFail($id);
        if ($request->hasFile('image')) {
            Upload::deleteImage($data->image);
            $data->update([
                'image' => Upload::UploadFile($request['image'], 'services'),
            ] + $request->validated());
        } else {
            $data->update($request->validated());
        }
        // $data = service::find($id);
        // $data->title = strip_tags($request->title);
        // $data->description = strip_tags($request->description);
        // $data->price = $request->price;
        // if ($request->hasFile('image')) {
        //     $data->image = $request->file('image')->store('services', 'public');
        // }
        // $data->save();
        return redirect()->route('admin.services.adminservices')->with('success', 'The service was updated successfully');
    }
    public function destroy($id)
    {
        service::find($id)->delete();
        return redirect()->route('admin.services.adminservices')->with('success', 'The service was deleted successfully');
    }
    public function analytics()
    {
        $data = service::select('id', 'title', 'description', 'price', 'image')->paginate(8);
        return view('services.analytics', ['data' => $data]);
    }
}

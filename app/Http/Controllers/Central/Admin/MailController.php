<?php

namespace App\Http\Controllers\Central\Admin;

use App\Helper\Upload;
use App\Mail\MailSummary;
use App\Http\Controllers\Controller;
use App\Models\Tenant;
use Illuminate\Support\Facades\Mail;
use App\Models\Client;
use App\Models\Email;
use App\Jobs\SendEmail;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MailController extends Controller
{


    public function index(Request $request)
    {
        if ($request->ajax()) {
            $Models = Email::latest();
            if ($request->type) {
                $Models = $Models->where('type_id', $request->type);
            }

            return DataTables::of($Models)
                ->addColumn('action', function ($Model) {
                    return '<a href="'.route('admin.send_mail.show', $Model).'"><i class="fas fa-eye"></i></a>';
                })
                ->addColumn('image', function ($Model) {
                    return '<img style="height: 100px" src="'.$Model['image'].'" alt="IMG" width="150">';
                })
                ->escapeColumns('action', 'checkbox', 'image')
                ->addIndexColumn()
                ->toJson();
        }

        return view('Central.Admin.send_mail.index');
    }

    public function create(Request $request)
    {
        return view('Central.Admin.send_mail.create');
    }

    public function store(Request $request)
    {
        $Email = Email::create($request->only('title', 'content','package'));
        if($request['image']){
            $Email->image = Upload::UploadFile($request['image'], 'mail_offer');
            $Email->save();
        }
        $emails = Client::whereIn('domain_name',Tenant::query()
                ->when($Email->package == 'Valid', function ($query, $role) {
                    return $query->where('paid',1);
                })->when($Email->package == 'Expired', function ($query, $role) {
                    return $query->where('paid',0);
                })->pluck('id')->toarray()
            )->pluck('email')->toarray();
            
        foreach($emails as $email_address){
            Mail::to( [$email_address] )->send(new MailSummary($Email));
        }


        alert()->success(__('messages.EmailSubmited'));
        return redirect()->back();
    }

    public function show($id)
    {
        $Mail = Email::latest()->findOrFail($id);
        return view('Central.Admin.send_mail.show', compact('Mail'));
    }
}

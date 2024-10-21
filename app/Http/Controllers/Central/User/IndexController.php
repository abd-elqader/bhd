<?php

namespace App\Http\Controllers\Central\User;

use App\Models\Tenant;
use App\Models\Central\Package;
use App\Models\Central\PackageUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\Tenant\User\ContactRequest;
use App\Models\Central\Blog;
use App\Models\Contact;
use App\Models\Country;
use App\Models\FAQ;
use App\Models\Subscribe;
use Illuminate\Http\Request;
use App\Mail\ContactMail;
use App\Helper\WhatsApp;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Stevebauman\Location\Facades\Location;

class IndexController extends Controller
{
    public function index()
    {
        return view('Central.User.welcome');
    }

    public function blog($title, Request $request)
    {
        $title = str_replace('--', ' ', $title);
        $Blog = Blog::Active()->where('title_ar', 'LIKE', "%{$title}%")->orwhere('title_en', 'LIKE', "%{$title}%")->firstorfail();
        $Blogs = Blog::Active()->inRandomOrder()->where('id', '!=', $Blog->id)->take(5)->get();
        return view('Central.User.blog_details', compact('Blog', 'Blogs'));
    }

    public function blogs(Request $request)
    {
        return view('Central.User.blogs');
    }
    
    public function renew (Request $request)
    {
        return view('Central.User.renew');
    }

    public function pricing(Request $request)
    {
        return view('Central.User.pricing');
    }

    public function login()
    {
        $countries = Country::where('status', 1)->get();

        return view('Central.User.login', compact('countries'));
    }

    public function register()
    {
        if(auth('client')->check()){
            return redirect()->route('client.profile');
        }
        $countries = Country::where('status', 1)->get();
        return view('Central.User.register', compact('countries'));
    }

    public function forget()
    {
        return view('Central.User.forgetpassword');
    }

    public function Contact()
    {
        return view('Central.User.contact');
    }

    public function About()
    {
        return view('Central.User.about');
    }

    public function FAQ()
    {
        $faqs = FAQ::Active()->get();

        return view('Central.User.faq', compact('faqs'));
    }

    public function Terms()
    {
        return view('Central.User.terms');
    }

    public function Privacy()
    {
        return view('Central.User.privacy');
    }

    public function Returns()
    {
        return view('Central.User.Returns');
    }
    
    
    
    public function post_renew (Request $request)
    {
        $Client = auth('client')->user();
        $Package = Package::findorfail($request->package_id);
        $price = (float) $Package->price + ($Client->domain ? setting('IndividualDomain') : 0);
        $PackageUser = PackageUser::create([ 
            'package_id' => $Package->id,
            'client_id' => $Client->id,
            'start_date' => now(),
            'end_date' => now()->addDays($Package->days),
        ]);
        if ($price > 0) {
            $redirect = VerifyTapTransaction(env('TAP_SECRET_KEY'), 1, auth('client')->id(), $price, 0, $price, $Client->name, null, null, $Client->phone, $Client->email);
            return redirect()->away($redirect);
        }else{
            $PackageUser->paid = 1;
            $PackageUser->save();
            
            $Client->status = 1;
            $Client->save();
            Tenant::where('id' , $Client->domain_name)->update(['paid'=>1]);
            return redirect()->route('client.profile');
        }
    }



    public function post_subscribe(Request $request)
    {
        Subscribe::create($request->only(['email']));
        alert()->success(__('messages.We Will Contact You as soon as possible'));

        return redirect()->back();
    }

    public function post_contact(ContactRequest $request)
    {
        if(session()->get('Contact') == true){
            alert()->error('Error, Max Messages Executed For Today..');
            return redirect()->back();
        }
        $message  = substr(preg_replace('#<a.*?>.*?</a>#i', ' ', htmlspecialchars($request->message)), 0, 450);
                
        $ip = request()->ip();
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip);
                }
            }
        }
        
        $location = Location::get($ip);
        
        
        if( Contact::whereDate('created_at', \Carbon\Carbon::today())->where('phone',$request->phone)->count() ){
            alert()->error('Error, Max Messages Executed For Today.');
            return redirect()->back();
        }
        
        if(strlen(str_replace(' ', '',$message)) == 0 || str_contains($message, 'http')){
            alert()->error('Error, Please write text without links and in (Arabic or English).');
            return redirect()->back();
        }

        
        $Contact = Contact::create([
            'phone'=>$request->phone,
            'email'=>$request->email,
            'name'=>$request->name,
            'subject'=>$request->subject,
            'message'=>$message,
            'ip'=>$ip,
        ]);
        
        session()->put('Contact', true);
        
        $whats_message = "";
        $whats_message .= '%0a *New Message From Matjr Website* %0a';
        $whats_message .= '%0a';
        $whats_message .= '%0a *Name:* %0a' . $Contact->name;
        $whats_message .= '%0a';
        $whats_message .= '%0a *Phone:* %0a' . $Contact->phone;
        $whats_message .= '%0a';
        $whats_message .= '%0a *IP:* %0a' . $Contact->ip;
        $whats_message .= '%0a';
        $whats_message .= '%0a *Message:* %0a' . $Contact->message;
        
        WhatsApp::SendWhatsApp(setting('phone'),$whats_message);
        Mail::to([setting('email')])->send(new ContactMail($Contact));
        alert()->success(__('messages.We Will Contact You as soon as possible'));
        return redirect()->back();
    }
}

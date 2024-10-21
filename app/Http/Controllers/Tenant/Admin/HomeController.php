<?php

namespace App\Http\Controllers\Tenant\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $DayVisits = Visit::select(DB::raw('count(*) as `views`'), DB::raw("DATE_FORMAT(created_at, '%m-%d-%Y') new_date"), DB::raw('YEAR(created_at) year, MONTH(created_at) month'))->whereMonth('created_at', '>=', Carbon::now()->subMonth()->month)->groupby('new_date')->where(DB::raw('YEAR(created_at)'), '=', date('Y'))->get();
        $MonthVisits = Visit::where(DB::raw('YEAR(created_at)'), '=', date('Y'))->select(DB::raw('count(*) as `views`'), DB::raw("DATE_FORMAT(created_at, '%m-%Y') new_date"), DB::raw('YEAR(created_at) year, MONTH(created_at) month'))->groupby('month')->get();
        $YearVisits = Visit::select(DB::raw('count(*) as `views`'), DB::raw("DATE_FORMAT(created_at, '%m-%Y') new_date"), DB::raw('YEAR(created_at) year, MONTH(created_at) month'))->groupby('year')->get();

    
        $Google = Visit::distinct('ip')->where('referer', 'like', '%google%')->count();
        $Instagram = Visit::distinct('ip')->where('referer', 'like', '%instagram%')->count();
        $Twitter = Visit::distinct('ip')->where('referer', 'like', '%twitter%')->count();
        $Snapchat = Visit::distinct('ip')->where('referer', 'like', '%snapchat%')->count();
        $Facebook = Visit::distinct('ip')->where('referer', 'like', '%facebook%')->count();
        $Behance = Visit::distinct('ip')->where('referer', 'like', '%behance%')->count();
        $Tiktok = Visit::distinct('ip')->where('referer', 'like', '%tiktok%')->count();
        $LinkedIn = Visit::distinct('ip')->where('referer', 'like', '%linkedIn%')->count();

        return view('Tenant.Admin.home', compact('DayVisits', 'MonthVisits', 'YearVisits', 'Google', 'Facebook', 'Instagram', 'Twitter', 'Snapchat', 'Behance', 'Tiktok', 'LinkedIn'));
    }
}

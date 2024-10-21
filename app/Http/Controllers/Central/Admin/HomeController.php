<?php

namespace App\Http\Controllers\Central\Admin;

use App\Http\Controllers\Controller;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:dashboard', ['only' => ['index']]);
    }

    public function index(Request $request)
    {
        $DayVisits = Visit::select(DB::raw('count(*) as `views`'), DB::raw("DATE_FORMAT(created_at, '%m-%d-%Y') new_date"), DB::raw('YEAR(created_at) year, MONTH(created_at) month'))->whereMonth('created_at', '>=', Carbon::now()->subMonth()->month)->groupby('new_date')->where(DB::raw('YEAR(created_at)'), '=', date('Y'))->get();
        $MonthVisits = Visit::where(DB::raw('YEAR(created_at)'), '=', date('Y'))->select(DB::raw('count(*) as `views`'), DB::raw("DATE_FORMAT(created_at, '%m-%Y') new_date"), DB::raw('YEAR(created_at) year, MONTH(created_at) month'))->groupby('month')->get();
        $YearVisits = Visit::select(DB::raw('count(*) as `views`'), DB::raw("DATE_FORMAT(created_at, '%m-%Y') new_date"), DB::raw('YEAR(created_at) year, MONTH(created_at) month'))->groupby('year')->get();

    
        $Google = Visit::where('referer', 'like', '%google%')->count();
        $Instagram = Visit::where('referer', 'like', '%instagram%')->count();
        $Twitter = Visit::where('referer', 'like', '%twitter%')->count();
        $Snapchat = Visit::where('referer', 'like', '%snapchat%')->count();
        $Facebook = Visit::where('referer', 'like', '%facebook%')->count();
        $Behance = Visit::where('referer', 'like', '%behance%')->count();
        $Tiktok = Visit::where('referer', 'like', '%tiktok%')->count();
        $LinkedIn = Visit::where('referer', 'like', '%linkedIn%')->count();

        return view('Central.Admin.home', compact( 'DayVisits', 'MonthVisits', 'YearVisits', 'Google', 'Facebook', 'Instagram', 'Twitter', 'Snapchat', 'Behance', 'Tiktok', 'LinkedIn'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Service;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Browsershot\Browsershot;

class DashboardController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Auth()->user()->load('providers.services', 'customers.services.renewalsCurrent', 'services.renewals', 'services.renewalsCurrent');
        $data->customers->each(function ($item){
            $item['services_total_amount'] = $item->services->pluck('renewalsCurrent')->collapse()->sum('amount');
        });

        $servicesThisYearArr = collect(array_fill(1, 12, 0));
        $servicesThisYear = $data->services->pluck('renewalsCurrent')->collapse()
            ->each(function($item) use($servicesThisYearArr){
                $servicesThisYearArr[$item->deadline->month] += $item->amount;
            });
        $servicesThisMonth = $servicesThisYear->filter(function($item){
            return $item->deadline->month == Carbon::now()->month;
        });

        $servicesThisYearSum = $servicesThisYearArr->sum();
        $servicesThisMonthSum = $servicesThisMonth->pluck('amount')->sum();

        $dashboard['servicesThisYear'] = $servicesThisYearArr;
        $dashboard['servicesThisYearCount'] = $servicesThisYear->count();
        $dashboard['servicesThisMonthCount'] = $servicesThisMonth->count();
        $dashboard['servicesThisYearSum'] = $servicesThisYearSum;
        $dashboard['servicesThisMonthSum'] = $servicesThisMonthSum;
        $dashboard['monthlyService_percent'] = round($servicesThisYearSum > 0 ? ($servicesThisMonthSum * 100) / $servicesThisYearSum : 0, 2);

        $dashboard['usersSummary'] = "";
        if(Auth::user()->isAdmin()){
            $allUsers = User::with('services.renewalsCurrent')->get();
            $totalService = $allUsers->pluck('services')->collapse()->count();
            $dashboard['usersSummary'] = $allUsers->each(function ($item) use ($totalService) {
                $services_total_perc = $totalService > 0 ? (($item->services->count() * 100) / $totalService) : 0;
                $item['services_total_perc'] = round($services_total_perc, 2);
                $item['services_total_amount'] = $item->services->pluck('renewalsCurrent')->collapse()->sum('amount');
            });
        }

        return view('dashboard.index', compact( 'data', 'dashboard'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}

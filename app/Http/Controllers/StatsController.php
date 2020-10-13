<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stats;
class StatsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Stats::all();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $stats = new Stats;
        $stats->visitor = '000.000.000.000';
        $stats->view = false;
        $stats->click = false;
        return $stats->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function views() {
        return Stats::all()->where('view', true);
    }

    public function view($id) {
        return Stats::where('id', $id);
    }

    public function count()  {

        $views = Stats::where('view', true)
        ->limit(100)
        ->orderByDesc('created_at')
        ->get();
        $count = intval(count($views)) - 1;
        $start_date = $views[$count]['created_at'];

        $clicks = Stats::where('click', true)
        ->whereDate('created_at','>=',$start_date)
        ->orderByDesc('created_at')
        ->get();

        $ctr = ((count($clicks) / count($views)) * 100);
        if (is_infinite($ctr)) {
            if (ceil($ctr) ==! $ctr) {
                $ctr = round($ctr, 1);
            } else {
                
            }
        }
        $ctr =  number_format($ctr, 1);
        $total = ['views'=> count($views), 'clicks' => count($clicks), 'ctr' => $ctr ];
        return json_encode($total);
    }

    // CTR Calculator 
    public function ctr()  {
        $views = Stats::where('view', true)
        ->limit(1000)
        ->orderByDesc('created_at')
        ->get();
        $count = intval(count($views)) - 1;
        $start_date = $views[$count]['created_at'];

        $clicks = Stats::where('click', true)
        ->whereDate('created_at','>=',$start_date)
        ->orderByDesc('created_at')
        ->get();

        $ctr = ((count($clicks) / count($views)) * 100);
        if (is_infinite($ctr)) {
            if (ceil($ctr) ==! $ctr) {
                $ctr = round($ctr, 1);
            } else {
                
            }
        } 
        $ctr =  number_format($ctr, 1); 
        return json_encode(['CTR'=>$ctr]);
    }
}

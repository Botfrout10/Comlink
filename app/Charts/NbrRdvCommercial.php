<?php

declare(strict_types=1);

namespace App\Charts;

use App\Models\Action;
use App\Models\Admin;
use App\Models\Commercial;
use Chartisan\PHP\Chartisan;
use Illuminate\Http\Request;
use ConsoleTVs\Charts\BaseChart;

class NbrRdvCommercial extends BaseChart
{
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        if (auth()->user()->admin) {
            $admin = Admin::where('email', auth()->user()->email)->first();
            $comm = $admin->commercial()->orderBy('nbr_appel', 'desc')->first();
            // $comm = $admin->commercial()->orderBy('nbr_rdv', 'desc')->first();
            // dd($comm);
            $X = [];
            $Ya = [];
            // $Yr = [];
            $i = 0;
            for ($i = 6; $i >= 0; $i--) {
                $X[$i] = date('Y-m-d', strtotime('-' . $i . ' days'));
            }

            $j = 0;
            foreach ($X as $x) {
                // $Ya[$j] = $comm->action()->where('date_edit', $x)->get()->count();
                $Ya[$j] = $comm->action()->where('date_edit', $x)->get()->count();
                // if ($Ya[$j]) {
                //     $j++;
                // }

                $j++;
                // if ($Yr[$k]) {
                //     $k++;
                // }
            }
            return Chartisan::build()
                ->labels($X)
                ->dataset('Nbr_appel(line)', $Ya)
                ->dataset('Nbr_appel(bar)', $Ya);
        } else {
            $comm = Commercial::where('email', auth()->user()->email)->first();
            $X = [];
            $Ya = [];
            // $Yr = [];
            $i = 0;
            for ($i = 6; $i >= 0; $i--) {
                $X[$i] = date('Y-m-d', strtotime('-' . $i . ' days'));
            }

            $j = 0;
            foreach ($X as $x) {
                // $Ya[$j] = $comm->action()->where('date_edit', $x)->get()->count();
                $Ya[$j] = $comm->action()->where('date_edit', $x)->get()->count();
                // if ($Ya[$j]) {
                //     $j++;
                // }

                $j++;
                // if ($Yr[$k]) {
                //     $k++;
                // }
            }
            return Chartisan::build()
                ->labels($X)
                ->dataset('Nbr_appel(line)', $Ya)
                ->dataset('Nbr_appel(bar)', $Ya);
        }
    }
}

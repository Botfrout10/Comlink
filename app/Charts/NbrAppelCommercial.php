<?php

declare(strict_types=1);

namespace App\Charts;

use App\Models\Admin;
use Chartisan\PHP\Chartisan;
use Illuminate\Http\Request;
use ConsoleTVs\Charts\BaseChart;

class NbrAppelCommercial extends BaseChart
{
    /**
     * Determines the middlewares that will be applied
     * to the chart endpoint.
     */
    public ?array $middlewares = ['auth'];
    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        // dd($request->all());
        $X = [];
        $Y1=[];
        $Y2=[];
        $i=0;
        $user = auth()->user();
        $admin = Admin::where('email', $user->email)->first();
        $comms = $admin->commercial()->get();
        foreach($comms as $comm)
        {
            $X[$i]=$comm->name;
            $Y1[$i]=$comm->nbr_appel;
            $Y2[$i]=$comm->nbr_rdv;
            $i++;
        }
        return Chartisan::build()
            ->labels($X)
            ->dataset('Nbr Appel', $Y1)
            ->dataset('Nbr RDV', $Y2);
    }
}

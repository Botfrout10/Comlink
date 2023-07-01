<?php

namespace App\Http\Controllers;

use App\Charts\Nappelselectcomm;
use App\Models\Admin;
use App\Models\Action;
use App\Models\Commercial;
use Chartisan\PHP\Chartisan;
use Illuminate\Http\Client\Request;
use PhpParser\Node\Stmt\Label;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if (auth()->user()->admin) {
            $admin = Admin::where('email', auth()->user()->email)->first();
            $comms = $admin->commercial;
            $nbr_pros = 0;

            $l_np = 0;
            $c_np = 0;
            $l_na = 0;
            $c_na = 0;
            $l_nr = 0;
            $c_nr = 0;
            $time = 'day';
            foreach ($comms as $comm) {
                $nbr_pros += $comm->prospect()->count();
                $l_np += $comm->prospect()->whereBetween('created_at', [date('Y-m-d', strtotime('-2 day')), date('Y-m-d', strtotime('-1 day'))])->count();
                $c_np += $comm->prospect()->where('created_at', '>', date('Y-m-d', strtotime('-1 day')))->count();
                $l_na += $comm->action()->whereBetween('date_edit', [date('Y-m-d', strtotime('-2 day')), date('Y-m-d', strtotime('-1 day'))])->count();
                $c_na += $comm->action()->where('date_edit', '>', date('Y-m-d', strtotime('-1 day')))->count();
                $l_nr += $comm->action()->whereBetween('date_edit', [date('Y-m-d', strtotime('-2 day')), date('Y-m-d', strtotime('-1 day'))])->where('status', 'Rdv')->count();
                $c_nr += $comm->action()->where('date_edit', '>', date('Y-m-d', strtotime('-1 day')))->where('status', 'Rdv')->count();
            }
            if ($l_na != 0) {
                $weekly_na = (($c_na - $l_na) * 100) / $l_na;
            } else {
                $weekly_na = 0;
            }
            if ($l_nr != 0) {
                $weekly_nr = (($c_nr - $l_nr) * 100) / $l_nr;
            } else {
                $weekly_nr = 0;
            }
            if ($l_np != 0) {
                $weekly_np = (($c_np - $l_np) * 100) / $l_np;
            } else {
                $weekly_np = 0;
            }
            if ($l_na != 0 && $c_na!=0) {
                $weekly_nra = ((($c_nr/$c_na) - ($l_nr/$l_na)) * 100);
            } else {
                $weekly_nra = 0;
            }

            return view('dashboard', [
                'comms' => $comms, 'nbr_pros' => $nbr_pros,
                'weekly_na' => $weekly_na, 'weekly_nr' => $weekly_nr, 'weekly_np' => $weekly_np,'weekly_nra' => $weekly_nra,
            ]);
        } else {
            $comm = Commercial::where('email', auth()->user()->email)->first();
            $nbr_pros = $comm->prospect()->count();
            $l_np = $comm->prospect()->whereBetween('created_at', [date('Y-m-d', strtotime('-2 day')), date('Y-m-d', strtotime('-1 day'))])->count();
            $c_np = $comm->prospect()->where('created_at', '>', date('Y-m-d', strtotime('-1 day')))->count();
            $l_na = $comm->action()->whereBetween('date_edit', [date('Y-m-d', strtotime('-2 day')), date('Y-m-d', strtotime('-1 day'))])->count();
            $c_na = $comm->action()->where('date_edit', '>', date('Y-m-d', strtotime('-1 day')))->count();
            $l_nr = $comm->action()->whereBetween('date_edit', [date('Y-m-d', strtotime('-2 day')), date('Y-m-d', strtotime('-1 day'))])->where('status', 'Rdv')->count();
            $c_nr = $comm->action()->where('date_edit', '>', date('Y-m-d', strtotime('-1 day')))->where('status', 'Rdv')->count();
            if ($l_na != 0) {
                $weekly_na = (($c_na - $l_na) * 100) / $l_na;
            } else {
                $weekly_na = 0;
            }
            if ($l_nr != 0) {
                $weekly_nr = (($c_nr - $l_nr) * 100) / $l_nr;
            } else {
                $weekly_nr = 0;
            }
            if ($l_np != 0) {
                $weekly_np = (($c_np - $l_np) * 100) / $l_np;
            } else {
                $weekly_np = 0;
            }
            if ($l_na != 0 && $c_na!=0) {
                $weekly_nra = ((($c_nr/$c_na) - ($l_nr/$l_na)) * 100);
            } else {
                $weekly_nra = 0;
            }


            return view('dashboard',[
                    'comm' => $comm, 'nbr_pros' => $nbr_pros,
                    'weekly_na' => $weekly_na, 'weekly_nr' => $weekly_nr, 'weekly_np' => $weekly_np,'weekly_nra' => $weekly_nra,
                ]
            );
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Prospect;
use App\Models\Commercial;
use Illuminate\Http\Request;
use App\Imports\ProspectImport;
use App\Imports\ActionProsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use phpDocumentor\Reflection\Types\Null_;
use PhpOffice\PhpSpreadsheet\Calculation\DateTimeExcel\Week;

class ProspectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->admin) {
            $comm = Commercial::where('email', auth()->user()->email)->first();
            $pros = $comm->prospect;
            // dd($pros);
            return view('prospect.edit', ['pros' => $pros]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $admin = Admin::where('email', auth()->user()->email)->first();
        $comms = $admin->commercial;
        if ($comms->first())  return view('prospect.add', ['comms' => $comms]);
        else return back()->with('er', 'You need Commercial first');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'tel' => ['required', 'min:10',]
        ]);
        $res = Prospect::create([
            "organisation" => $request->organisation,
            "nom" => $request->nom_pros,
            "prenom" => $request->prenom_pros,
            "address" => $request->address,
            "email" => $request->email,
            "tel" => $request->tel,
            "remarque" => $request->remarque,
            "date_premier_contact" => $request->date_pcontact,
            "source_prospect" => $request->source_pros,
            "commercial_id" => $request->comm,
        ]);
        if ($res) {
            return back()->withStatus(__('Prospect added succesfully.'));
        } else {
            return back()->with('er', __('Oops somethings went wrop!!'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pros = Prospect::findOrFail($id);
        $comm = Prospect::findOrFail($id)->commercial()->first();
        $admin = $comm->admin()->first();
        $actions = $pros->action;
        return view('prospect.form', ['pros' => $pros, 'actions' => $actions, 'script_appel' => $admin->script_appel]);
    }

    public function update_form($id, Request $request)
    {
        $pros = Prospect::findOrFail($id);
        $pros->count_appel++;

        $commc = $pros->commercial()->first();
        $commc->nbr_appel++;

        $res = $pros->update([
            "status_act" => $request->status_act,
        ]);

        $pros->action()->create([
            "action" => $request->next_act,
            "status" => $request->status_act,
            "commercial_id" => $commc->id,
            "date_edit" => date('Y-m-d'), //date('Y-m-d) strtotime('-3 days')
        ]);

        if ($request->status_act == 'RDV') {
            $commc->nbr_rdv++;
            $time = strtotime($request->next_act);
            $newformat = date('Y-m-d h:i:s', $time);
            $pros->booking()->create([
                'title' => $pros->organisation,
                'start_date' => $newformat,
                'end_date' => $newformat,
            ]);
        }

        if ($request->status_act == 'Relance') {
            $time = strtotime($request->next_act);
            $newformat = date('Y-m-d h:i:s', $time);
            $pros->booking()->create([
                'title' => $pros->organisation,
                'start_date' => $newformat,
                'end_date' => $newformat,
                'color' => '#172b4d',
            ]);
        }
        $commc->save();
        if ($res) {
            return back()->withStatus(__('Prospect updated.'));
        } else {
            return back()->with('er', __('OOps Probleme! You can\'t add more actions!.'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comm = Commercial::findOrFail($id);
        $pros = $comm->prospect;
        return view('prospect.edit', ['pros' => $pros]);
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
        Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);
        $pros = Prospect::find($id);
        $res = $pros->update(['nom' => $request->name, 'email' => $request->email]);
        if ($res) {
            return back()->withStatus(__('Prospect successfully updated.'));
        } else   return back()->with('er', __('Oops Probleme faceced during updating!!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pros = Prospect::find($id);
        $res = $pros->deleteOrFail();
        return back()->with('er', __('Prospect deleted succesfully.'));
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);
        $comms = Commercial::all();
        if (!$comms->first()) {
            return back()->with('er', __('You need Commercial first'));
        } else {
            $res = Excel::import(new ProspectImport, $request->file('file'));
            if ($res) {
                return back()->withStatus('File Is Imported Successfuly');
            } else
                return back()->with('er', 'Oops Probleme Facede during importation!! check commercial id');
        }
    }
}

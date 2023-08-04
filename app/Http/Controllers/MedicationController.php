<?php

namespace App\Http\Controllers;

use App\Medication;
use App\MedicationStatus;
use Illuminate\Http\Request;

class MedicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medications = Medication::latest();
        if ($med_status = request('by')) {
            
            $medicationstatus = MedicationStatus::where('medication_status' ,$med_status)->firstOrFail();
            $medications->where('medication_status_id', $medicationstatus->id);
            
        }
        $medications = $medications->get();
        $medicationStatus = MedicationStatus::all();
        // 
        return view('medications.index', compact(['medications', 'medicationStatus']));
    }


    public function edit(Medication $medication)
    {
        $medicationStatus = MedicationStatus::all();

        return view('medications.edit', compact(['medication', 'medicationStatus']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Medication  $medication
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Medication $medication)
    {
        $data = $request->validate([
            'name' => 'sometimes|nullable',
            'effective_material' => 'sometimes|nullable',
            'company_name' => 'sometimes|nullable',
            'license_number' => 'sometimes|nullable',
            'price' => 'sometimes|nullable',
            'order_id' => 'nullable',
            'medication_status_id' => 'sometimes|nullable',
            
        ]);

        $medication->update($data);
        // dd($medication);
        return redirect()->route('medications.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Medication  $medication
     * @return \Illuminate\Http\Response
     */
    public function destroy(Medication $medication)
    {
        $medication->delete();

        return back();
    }
}

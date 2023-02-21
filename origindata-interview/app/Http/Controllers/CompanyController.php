<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::all();
        return response()->json($companies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'created_at' => 'nullable|date',
            'founded_at' => 'nullable|date',
            'updated_at' => 'nullable|date'
        ]);

        $company = new Company();
        $company->name = $validatedData['name'];
        $company->description = $validatedData['description'];
        $company->created_at = $validatedData['created_at'];
        $company->founded_at = $validatedData['founded_at'];
        $company->updated_at = $validatedData['updated_at'];
        $company->save();

        return response()->json(['message' => 'Company created successfully', 'company' => $company], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Company::findOrFail($id);

        if ($company)
            return response()->json($company);

        return response()->json(['message' => 'Company not found'], 404);
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
        $user = Auth::user();

        $company = Company::findOrFail($id);
        $company->update($request->all());
        return response()->json($company, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();

        $company = Company::find($id);
        if (!$company) {
            return response()->json(['message' => 'Company not found'], 404);
        }

        $company->delete();
        return response()->json(['message' => 'Company deleted'], 200);
    }
}

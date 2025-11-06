<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyStoreValidation;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CompanyController extends Controller
{
    //
    public function store(CompanyStoreValidation $companyStoreValidation)
    {
        $Category = Company::create($companyStoreValidation->all());
         return response()->json([
             'message' => 'create company has been successfully !',
            'data' => $Category
         ]);
    }

    public function show(Company $company)
    {
        return response()->json([
            'message'=> 'company has been fetch',
            'data'=> $company
        ]);
    }

    public function update(Company $company , CompanyStoreValidation $companyStoreValidation)
    {
        $company->update(\request()->all());
        $category = Company::find($company->id);
        return response()->json([
            'message' => 'update company has been successfully',
            'data' => $company
        ]);
    }

    public function delete(Company $company)
    {
        $company->delete();
        return response()->json([
            'message' => 'delete company has been successfully',
            'data' => $company
        ]);
    }
}

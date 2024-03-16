<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $companies = Company::paginate(10);
        $links = [
            '#' => 'companies',
            route('companies.index') => 'companies List',
        ];
        $data = [
            'page_title' => 'companies List',
            'icon' => 'fas fa-user-tie',
            'links' => $links,
            'data'=>$companies
           ];

           return Inertia::render('product', compact('data') );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {




        $links = [
            '#' => 'company',
            route('companies.index') => 'company List',
            route('companies.show', ['company' => $company->id])=> $company->name,

        ];
        $data = [
            'page_title' =>  $company->name,
            'icon' => 'fas fa-user-tie',
            'links' => $links,
            'data'=>$company,
            'products'=>$company->products,
           ];
           return Inertia::render('product', compact('data') );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        //
    }
}

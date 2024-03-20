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
            'companies' => $companies
        ];

        return Inertia::render('company', compact('data'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }


    public function show(Company $company)
    {
        $links = [
            '#' => 'company',
            route('companies.index') => 'company List',
            route('companies.show', $company->id) => $company->name,

        ];
        $data = [
            'page_title' => $company->name,
            'icon' => 'fas fa-user-tie',
            'links' => $links,
            'data' => $company,
            'products' => $company->products,
        ];
        return Inertia::render('product', compact('data'));
    }

    public function edit(Company $company)
    {
        //
    }


    public function update(Request $request, Company $company)
    {
        //
    }

    public function destroy(Company $company)
    {
        //
    }
}

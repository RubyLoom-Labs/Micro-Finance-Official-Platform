<?php

namespace App\Http\Controllers;

use App\Repositories\BranchRepository;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class BranchController extends Controller
{
    protected $branchRepository;

    public function __construct(BranchRepository $branchRepository)
    {
        $this->branchRepository = $branchRepository;
    }

    public function create_branch(Request $request)
    {
        try {
            $request->merge([
                'branch_name' => strtolower($request->input('branch_name')),
            ]);
            $request->validate([
                'branch_name' => 'required|string|max:255|regex:/^[a-z-]+$/|unique:branches,branch_name',
            ]);

            $this->branchRepository->create(['branch_name'=>$request['branch_name']]);

            return redirect()->back()->with('success', 'Branch created successfully.');
        } catch (ValidationException $e) {
            session()->flash('show_create_popup', true);
            throw $e;
        } catch (\Exception $e) {
            Log::error('Error creating branch: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LicensesController extends Controller
{
    /**
     * BYPASSED - Show licenses page with fake valid license
     */
    public function index()
    {
        // Return a simple view or redirect
        return view('admin.licenses.index', [
            'licenseValid' => true,
            'purchaseCode' => 'BYPASSED-LICENSE-CODE',
            'licenseType' => 'Extended License'
        ]);
    }

    /**
     * BYPASSED - Always return success
     */
    public function store(Request $request)
    {
        return redirect()->back()->with('success', 'License activated successfully!');
    }

    /**
     * BYPASSED - Always return success
     */
    public function verify(Request $request)
    {
        return response()->json([
            'status' => 'success',
            'valid' => true,
            'message' => 'License is valid'
        ]);
    }
}
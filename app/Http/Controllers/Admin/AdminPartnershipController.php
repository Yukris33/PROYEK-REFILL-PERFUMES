<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PartnershipRequest;
use Illuminate\Http\Request;

class AdminPartnershipController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $status = $request->query('status');

        $totalRequests = PartnershipRequest::count();
        $newRequests = PartnershipRequest::where('status', 'new')->count();
        $reviewedRequests = PartnershipRequest::where('status', 'reviewed')->count();
        $contactedRequests = PartnershipRequest::where('status', 'contacted')->count();

        $partnerships = PartnershipRequest::query()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery->where('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%')
                        ->orWhere('phone', 'like', '%' . $search . '%')
                        ->orWhere('business_name', 'like', '%' . $search . '%')
                        ->orWhere('message', 'like', '%' . $search . '%');
                });
            })
            ->when($status, function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.partnerships.index', compact(
            'search',
            'status',
            'totalRequests',
            'newRequests',
            'reviewedRequests',
            'contactedRequests',
            'partnerships'
        ));
    }

    public function updateStatus(Request $request, PartnershipRequest $partnership)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:new,reviewed,contacted,closed'],
        ]);

        $partnership->update([
            'status' => $validated['status'],
        ]);

        return back()->with('success', 'Status permintaan kerja sama berhasil diperbarui.');
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SupportTicket;
use Illuminate\Http\Request;

class AdminSupportTicketController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $status = $request->query('status');
        $category = $request->query('category');

        $totalTickets = SupportTicket::count();
        $openTickets = SupportTicket::where('status', 'open')->count();
        $inProgressTickets = SupportTicket::where('status', 'in_progress')->count();
        $resolvedTickets = SupportTicket::where('status', 'resolved')->count();

        $tickets = SupportTicket::with('user')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery->where('subject', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%')
                        ->orWhereHas('user', function ($userQuery) use ($search) {
                            $userQuery->where('name', 'like', '%' . $search . '%')
                                ->orWhere('email', 'like', '%' . $search . '%');
                        });
                });
            })
            ->when($status, function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->when($category, function ($query) use ($category) {
                $query->where('category', $category);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.support-tickets.index', compact(
            'search',
            'status',
            'category',
            'totalTickets',
            'openTickets',
            'inProgressTickets',
            'resolvedTickets',
            'tickets'
        ));
    }

    public function updateStatus(Request $request, SupportTicket $ticket)
    {
        $validated = $request->validate([
            'status' => ['required', 'in:open,in_progress,resolved,closed'],
        ]);

        $ticket->update([
            'status' => $validated['status'],
        ]);

        return back()->with('success', 'Status laporan kendala berhasil diperbarui.');
    }
}
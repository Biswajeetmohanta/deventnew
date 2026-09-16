<?php

namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PortalDashboardController extends Controller
{
    public function index()
    {
        $client = Auth::user();
        
        // Fetch projects belonging to the client
        $projects = $client->projects()
            ->withCount(['milestones', 'milestones as completed_milestones_count' => function ($query) {
                $query->where('status', 'completed');
            }])
            ->with(['invoices', 'files'])
            ->get();

        // Calculate some statistics
        $activeProjectsCount = $projects->where('status', '!=', 'completed')->count();
        
        $totalInvoiced = 0;
        $totalPaid = 0;
        $unpaidInvoicesCount = 0;

        foreach ($projects as $project) {
            foreach ($project->invoices as $invoice) {
                $totalInvoiced += $invoice->amount;
                if ($invoice->status === 'paid') {
                    $totalPaid += $invoice->amount;
                } else {
                    $unpaidInvoicesCount++;
                }
            }
        }

        $balanceDue = $totalInvoiced - $totalPaid;

        return view('portal.dashboard', compact(
            'projects',
            'activeProjectsCount',
            'totalInvoiced',
            'totalPaid',
            'balanceDue',
            'unpaidInvoicesCount'
        ));
    }
}

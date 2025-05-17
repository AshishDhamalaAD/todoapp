<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $todos = Todo::query()
            ->select([
                DB::raw('DAY(due_at) as due_date'),
                DB::raw('COUNT(*) as count'),
                DB::raw('COUNT(CASE WHEN is_completed THEN 1 ELSE NULL END) as completed_count'),
                DB::raw('COUNT(CASE WHEN NOT is_completed THEN 1 ELSE NULL END) as incomplete_count'),
            ])
            ->whereBetween('due_at', [today()->startOfMonth(), today()->endOfMonth()])
            ->groupBy(['due_date'])
            ->orderBy('due_date')
            ->get();

        $data['labels'] = $todos->pluck('due_date');
        $data['datasets'] = [
            [
                'label' => 'Total',
                'data' => $todos->pluck('count'),
                'borderWidth' => 1,
            ],
            [
                'label' => 'Completed',
                'data' => $todos->pluck('completed_count'),
                'borderWidth' => 1,
            ],
            [
                'label' => 'Incomplete',
                'data' => $todos->pluck('incomplete_count'),
                'borderWidth' => 1,
            ],
        ];

        return view('dashboard', $data);
    }
}

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
        $dailyTodos = $this->thisMonthTodos([
            DB::raw('DAY(due_at) as group_key'),
        ]);

        $data['dailyChart'] = $this->formatToChartData($dailyTodos);

        $weeklyTodos = $this->thisMonthTodos([
            DB::raw('WEEK(due_at) as group_key'),
        ]);

        $data['weeklyChart'] = $this->formatToChartData($weeklyTodos);

        return view('dashboard', $data);
    }

    private function thisMonthTodos(array $select = [])
    {
        return Todo::query()
            ->select([
                ...$select,
                DB::raw('COUNT(*) as count'),
                DB::raw('COUNT(CASE WHEN is_completed THEN 1 ELSE NULL END) as completed_count'),
                DB::raw('COUNT(CASE WHEN NOT is_completed THEN 1 ELSE NULL END) as incomplete_count'),
            ])
            ->whereBetween('due_at', [today()->startOfMonth(), today()->endOfMonth()])
            ->groupBy(['group_key'])
            ->orderBy('group_key')
            ->get();
    }

    private function formatToChartData($todos)
    {
        $data['labels'] = $todos->pluck('group_key');

        $data['datasets'] = [
            [
                'label' => 'Total',
                'data' => $todos->pluck('count'),
                'borderWidth' => 1,
            ],
            [
                'label' => 'Incomplete',
                'data' => $todos->pluck('incomplete_count'),
                'borderWidth' => 1,
            ],
            [
                'label' => 'Completed',
                'data' => $todos->pluck('completed_count'),
                'borderWidth' => 1,
            ],
        ];

        return $data;
    }
}

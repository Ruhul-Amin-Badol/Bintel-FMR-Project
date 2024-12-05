<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Officer;
use App\Models\Records;
use App\Models\Expenses;
use Illuminate\Support\Facades\Redirect;

class LeaderboardController extends Controller
{

    public function home(Request $request)
    {


        $top5Leaderboard = [];
        return view('frontend.master')->with(compact('top5Leaderboard'));
    }


    public function rank(Request $request)
    {

        $top5Leaderboard = [];
        $date = explode(' - ', $request->range);

        $start = date("Y-m-d", strtotime($date[0]));
        $end = date("Y-m-d", strtotime($date[1]));
        $rank = 0;
        $columnName = $request->type;
        if($request->password  != "*royal#"){
          
          abort(403,"Invalid Password");
          
        }
      
        if ($columnName == "CPV" || $columnName == "CPD" || $columnName == "CPBD") {


            if ($columnName == "CPV") {
                $records = DB::table('records')
                    ->select(
                        'officers.name',
                        'records.employee_id',
                        DB::raw("SUM(records.others_institute + records.institute + records.library) as total_visit")
                    )
                    ->leftJoin('officers', 'officers.employee_id', '=', 'records.employee_id')
                    ->whereBetween('records.collection_date', [$start, $end])
                    ->whereNull('records.deleted_at')
                    ->groupBy('records.employee_id', 'officers.name')
                    ->orderByDesc('total_visit')
                    ->get();

                $leaderboard = $records->map(function ($record) use (&$rank, $start, $end) {
                    $rank++;
                    $totalCost = $this->calculateTotalCostByEmployee($record->employee_id, $start, $end);
                    $cpv = ($totalCost != 0 && $record->total_visit != 0)
                        ? ($totalCost / $record->total_visit)
                        : 0;
                    $cpv = round($cpv, 2);

                    return [
                        'employee_id' => $record->employee_id,
                        'employee_name' => $record->name,
                        'total_institute' => $cpv,
                        'rank' => $rank,
                    ];
                });
                $top5Leaderboard = $leaderboard->where('total_institute','!=',0)->sortBy('total_institute')->all();
            }
            if ($columnName == "CPD") {
                $records = DB::table('records')
                    ->select(
                        'officers.name',
                        'records.employee_id',
                        DB::raw("SUM(records.teacher + records.student + records.quiz) as total_visit")
                    )
                    ->leftJoin('officers', 'officers.employee_id', '=', 'records.employee_id')
                    ->whereBetween('records.collection_date', [$start, $end])
                    ->whereNull('records.deleted_at')
                    ->groupBy('records.employee_id', 'officers.name')
                    ->orderByDesc('total_visit')
                    ->get();

                $leaderboard = $records->map(function ($record) use (&$rank, $start, $end) {
                    $rank++;
                    $totalCost = $this->calculateTotalCostByEmployee($record->employee_id, $start, $end);
                    $cpv = ($totalCost != 0 && $record->total_visit != 0)
                        ? ($totalCost / $record->total_visit)
                        : 0;
                    $cpv = round($cpv, 2);

                    return [
                        'employee_id' => $record->employee_id,
                        'employee_name' => $record->name,
                        'total_institute' => $cpv,
                        'rank' => $rank,
                    ];
                });
                $top5Leaderboard = $leaderboard->where('total_institute','!=',0)->sortBy('total_institute')->all();
            }
            if ($columnName == "CPBD") {
                $records = DB::table('records')
                    ->select(
                        'officers.name',
                        'records.employee_id',
                        DB::raw("SUM(books_count) as total_visit")
                    )
                    ->leftJoin('officers', 'officers.employee_id', '=', 'records.employee_id')
                    ->whereBetween('records.collection_date', [$start, $end])
                    ->whereNull('records.deleted_at')
                    ->groupBy('records.employee_id', 'officers.name')
                    ->orderByDesc('total_visit')
                    ->get();

                $leaderboard = $records->map(function ($record) use (&$rank, $start, $end) {
                    $rank++;
                    $totalCost = $this->calculateTotalCostByEmployee($record->employee_id, $start, $end);
                    $cpv = ($totalCost != 0 && $record->total_visit != 0)
                        ? ($totalCost / $record->total_visit)
                        : 0;
                    $cpv = round($cpv, 2);

                    return [
                        'employee_id' => $record->employee_id,
                        'employee_name' => $record->name,
                        'total_institute' => $cpv,
                        'rank' => $rank,
                    ];
                });
                $top5Leaderboard = $leaderboard->where('total_institute','!=',0)->sortBy('total_institute')->all();
            }

        } else {

            $records = DB::table('records')
                ->select('officers.name', 'records.employee_id', DB::raw("SUM($columnName) as total_institute"))
                ->leftJoin('officers', 'officers.employee_id', '=', 'records.employee_id')
                ->whereBetween('records.collection_date', [$start, $end])
                ->whereNull('records.deleted_at')
                ->groupBy('records.employee_id', 'officers.name')
                ->orderByDesc('total_institute')
                ->get();

            $leaderboard = $records->map(function ($record) use (&$rank) {
                $rank++;

                return [
                    'employee_id' => $record->employee_id,
                    'employee_name' => $record->name,
                    'total_institute' => $record->total_institute,
                    'rank' => $rank,
                ];
            });
            $top5Leaderboard = $leaderboard->take(45);
        }


        $title="Filter Type: ".$columnName;
        $date="Date Range: $request->range";
        $oldDate=$request->range;
        $oldFilter=$columnName;


        return view('frontend.master')->with(compact('top5Leaderboard','title','date','oldDate','oldFilter'));

    }


    public function calculateTotalCostByEmployee($employeeId, $startDate, $endDate)
    {
        $totalCost = Expenses::
            where('employee_id', $employeeId)
            ->whereBetween('expenses_date', [$startDate, $endDate])
            ->sum('total_cost');

        return $totalCost;
    }


}

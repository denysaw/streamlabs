<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Returns user events
     *
     * @return JsonResponse
     */
    public function events(): JsonResponse
    {
        $user = auth('sanctum')->user();
        $events = $user->events()->orderBy('created_at', 'DESC')->simplePaginate(100);

        return response()->json($events);
    }

    /**
     * Returns user stats
     *
     * @return JsonResponse
     */
    public function stats(): JsonResponse
    {
        $user = auth('sanctum')->user();
        $daysAgo = Carbon::today()->subDays(30);

        $revenue = DB::select(
            'SELECT ROUND(SUM(amount)::numeric, 2) AS amount FROM (
                SELECT amount
                FROM donations
                WHERE user_id = :user_id AND created_at > :date
                UNION ALL
                SELECT price * quantity as amount
                FROM merch_sales
                WHERE user_id = :user_id AND created_at > :date
                UNION ALL
                SELECT CASE
                   WHEN tier = 1 THEN 5
                   WHEN tier = 2 THEN 10
                   WHEN tier = 3 THEN 15
                   END amount
                FROM subscribers
                WHERE user_id = :user_id AND created_at > :date
            ) res', [
                'user_id' => $user->id,
                'date' => $daysAgo
            ]
        );

        $followers = $user->followers()
            ->where([['created_at', '>', $daysAgo]])
            ->count();

        $bestsellers = $user->sales()
            ->select('item', DB::raw('SUM(quantity) AS sold'))
            ->where([['created_at', '>', $daysAgo]])
            ->groupBy('item')
            ->orderBy('sold', 'DESC')
            ->take(3)
            ->get();

        return response()->json([
            'revenue' => floatval(array_pop($revenue)->amount),
            'followers' => $followers,
            'bestsellers' => $bestsellers
        ]);
    }
}

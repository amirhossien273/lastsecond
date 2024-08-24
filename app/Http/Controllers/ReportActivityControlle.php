<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportActivitiesIndexRequest;
use App\Http\Resources\ReportActivityCollection;
use App\Models\Activity;

class ReportActivityControlle extends Controller
{
    public function index(ReportActivitiesIndexRequest $request)
    {
        $query = Activity::query();

        if ($request->has('name') && $request->input('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        if ($request->has('location') && $request->input('location')) {
            $query->where('location', 'like', '%' . $request->input('location') . '%');
        }

        if ($request->has('price_min') && $request->has('price_max')) {
            $query->whereBetween('price', [$request->input('price_min'), $request->input('price_max')]);
        }

        if ($request->has('available_slots') && $request->input('available_slots')) {
            $query->where('available_slots', '>=', $request->input('available_slots'));
        }

        $perPage = $request->input('per_page', 10); // Default to 10 per page
        $activities = $query->paginate($perPage);

        return new ReportActivityCollection($activities);
    }

}

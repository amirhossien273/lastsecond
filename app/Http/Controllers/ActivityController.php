<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActivityRequest;
use App\Http\Resources\ActivityResource;
use App\Models\Activity;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class ActivityController extends Controller
{
    /**
     *
     * @return AnonymousResourceCollection
     * 
     */
    public function index(): AnonymousResourceCollection
    {
        return ActivityResource::collection(Activity::get());
    }

    /**
     *
     * @param  \App\Http\Requests\ActivityRequest  $request
     * @return ActivityResource
     * 
     */
    public function store(ActivityRequest $request): ActivityResource
    {
        $activity = Activity::create($request->validated());
        return new ActivityResource($activity);
    }

    /**
     *
     * @param  \App\Models\Activity  $activity
     * @return ActivityResource
     * 
     */
    public function show(Activity $activity): ActivityResource
    {
        return new ActivityResource($activity);
    }

    /**
     *
     * @param  \App\Http\Requests\ActivityRequest  $request
     * @param  \App\Models\Activity  $activity
     * @return ActivityResource
     * 
     */
    public function update(ActivityRequest $request, Activity $activity): ActivityResource
    {
        $activity->update($request->validated());
        return new ActivityResource($activity);
    }

    /**
     *
     * @param  \App\Models\Activity  $activity
     * @return Response
     * 
     */
    public function destroy(Activity $activity): Response
    {
        $activity->delete();
        return response()->noContent();
    }
}

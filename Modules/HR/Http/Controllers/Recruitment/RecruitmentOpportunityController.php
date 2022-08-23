<?php

namespace Modules\HR\Http\Controllers\Recruitment;

use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request as HttpRequest;
use Modules\HR\Entities\Job;

class RecruitmentOpportunityController extends JobController
{
    public function getOpportunityType()
    {
        return 'recruitment';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $this->authorize('list', Job::class);

        $jobs = Job::with('applications', 'applications.applicant')
            ->typeRecruitment()
            ->latest()
            ->paginate(config('constants.pagination_size'))
            ->appends(Request::except('page'));

        return view('hr.job.index')->with([
            'jobs' => $jobs,
            'type' => 'recruitment',
        ]);
    }

    public function resourcesRequiredCount(HttpRequest $request, Job $opportunity)
    {
        $validated = $request->validate([
            'resources_required' => 'required|integer'
        ]);
        $opportunity->update($validated);

        return redirect(route('recruitment.opportunities'))->with('status', 'Resources updated successfully!');
    }
}

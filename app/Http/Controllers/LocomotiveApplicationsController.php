<?php

namespace App\Http\Controllers;

use App\Models\Depot;
use App\Models\LocomotiveApplication;
use App\Models\Purpose;

class LocomotiveApplicationsController extends Controller
{
    public function index()
    {
        $applications = LocomotiveApplication::with(['depot', 'purpose'])->paginate(10);

        return view('locomotive-applications.index', compact('applications'));
    }

    public function create()
    {
        return view('locomotive-applications.create', [
            'locApp' => new LocomotiveApplication(),
            'depots' => Depot::pluck('name', 'id'),
            'purposes' => Purpose::pluck('name', 'id'),
            'sections' => LocomotiveApplication::sectionsList(),
        ]);
    }

    public function store()
    {
        $data = $this->validateRequest();

        LocomotiveApplication::create($data);

        return redirect()->route('applications');
    }

    public function edit(LocomotiveApplication $application)
    {
        session()->put('url.intended', url()->previous());

        return view('locomotive-applications.edit', [
            'locApp' => $application,
            'depots' => Depot::pluck('name', 'id'),
            'purposes' => Purpose::pluck('name', 'id'),
            'sections' => LocomotiveApplication::sectionsList(),
        ]);
    }

    public function update(LocomotiveApplication $application)
    {
        $data = $this->validateRequest();

        $application->update($data);

        return redirect()->intended();
    }

    /**
     * @param LocomotiveApplication $application
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(LocomotiveApplication $application)
    {
        session()->put('url.intended', url()->previous());

        $application->delete();

        return redirect()->intended();
    }

    protected function validateRequest()
    {
        request()['user_id'] = auth()->id();
        request()['depots'] = array_keys(Depot::pluck('name', 'id')->toArray());
        request()['purposes'] = array_keys(Purpose::pluck('name', 'id')->toArray());

        return $this->validate(request(), [
            'user_id' => 'required',
            'on_date' => 'required|date',
            'sections' => 'required',
            'hours' => 'required',
            'count' => 'required',
            'description' => 'required',
            'purpose_id' => 'required|in_array:purposes.*',
            'depot_id' => 'required|in_array:depots.*',
        ]);
    }
}

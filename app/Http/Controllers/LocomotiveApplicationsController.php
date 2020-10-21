<?php

namespace App\Http\Controllers;

use App\Models\Depot;
use App\Models\LocomotiveApplication;
use App\Models\Purpose;

class LocomotiveApplicationsController extends Controller
{
    public function index()
    {
        $applications = LocomotiveApplication::paginate(10);

        return view('locomotive-applications.index', compact('applications'));
    }

    public function create()
    {
        return view('locomotive-applications.create', [
            'locomotiveApplication' => new LocomotiveApplication(),
            'depots' => Depot::pluck('name', 'id'),
            'purposes' => Purpose::pluck('name', 'id'),
        ]);
    }

    public function store()
    {
        request()['user_id'] = auth()->id();
        request()['depots'] = array_keys(Depot::pluck('name', 'id')->toArray());
        request()['purposes'] = array_keys(Purpose::pluck('name', 'id')->toArray());

        $data = $this->validate(request(), [
            'user_id' => 'required',
            'on_date' => 'required|date',
            'sections' => 'required',
            'hours' => 'required',
            'count' => 'required',
            'description' => 'required',
            'purpose_id' => 'required|in_array:purposes.*',
            'depot_id' => 'required|in_array:depots.*',
        ]);

        LocomotiveApplication::create($data);

        return redirect()->route('applications');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Depot;
use App\Models\LocomotiveApplication;
use App\Models\Purpose;
use App\Models\User;

class LocomotiveApplicationsController extends Controller
{
    public function index()
    {
        $applications = LocomotiveApplication::with(['depot', 'purpose', 'customer', 'user'])->paginate(10);

        return view('locomotive-applications.index', compact('applications'));
    }

    public function create()
    {
        return view('locomotive-applications.create', $this->prepareFormData(new LocomotiveApplication()));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store()
    {
        $data = $this->validateRequest();

        $locApp = LocomotiveApplication::create($data);

        User::notifySubscribers($locApp);

        return redirect()->route('applications')->with('flash', json_encode([
            'title' => 'Успех',
            'message' => 'Сохранено'
        ]));
    }

    public function edit(LocomotiveApplication $application)
    {
        session()->put('url.intended', url()->previous());

        return view('locomotive-applications.edit', $this->prepareFormData($application));
    }

    /**
     * @param LocomotiveApplication $application
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(LocomotiveApplication $application)
    {
        $data = $this->validateRequest();

        $application->update($data);

        return redirect()->intended()->with('flash', json_encode([
            'title' => 'Успех',
            'message' => 'Сохранено'
        ]));
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

        return redirect()->intended()->with('flash', json_encode([
            'title' => 'Успех',
            'message' => 'Удалено'
        ]));
    }

    public function show(LocomotiveApplication $application)
    {
        return view('locomotive-applications.show', ['locApp' => $application]);
    }

    /**
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateRequest()
    {
        request()['user_id'] = auth()->id();
        request()['depots'] = array_keys(Depot::pluck('name', 'id')->toArray());
        request()['purposes'] = array_keys(Purpose::pluck('name', 'id')->toArray());

        return $this->validate(request(), [
            'user_id' => 'required|integer',
            'on_date' => 'required|date|after:2020-09-30',
            'customer_id' => 'required|integer',
            'sections' => 'required|integer',
            'hours' => 'required|integer|max:23',
            'count' => 'required|integer',
            'description' => 'required|string',
            'purpose_id' => 'required|in_array:purposes.*',
            'depot_id' => 'required|in_array:depots.*',
        ]);
    }

    protected function prepareFormData(LocomotiveApplication $application): array
    {
        return [
            'locApp' => $application,
            'depots' => Depot::pluck('name', 'id'),
            'purposes' => Purpose::pluck('name', 'id'),
            'customers' => Customer::pluck('name', 'id'),
            'sections' => LocomotiveApplication::sectionsList(),
            'isSA' => auth()->user()->isSA() || auth()->user()->isAdmin(),
            'isCustomer' => auth()->user()->isCustomer(),
        ];
    }
}

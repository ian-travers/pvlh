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
        $applications = LocomotiveApplication::with(['depot', 'purpose', 'customer', 'user'])->latest()->paginate(10);

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
        if ($application->editable()) {
            session()->put('url.intended', url()->previous());

            return view('locomotive-applications.edit', $this->prepareFormData($application));
        }

        return back()->with('flash', json_encode([
            'level' => 'warning',
            'title' => 'Предупреждение',
            'message' => 'Заявка уже имеет согласование одного или нескольких отделов НОД. Редактирование запрещено!'
        ]));
    }

    /**
     * @param LocomotiveApplication $application
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(LocomotiveApplication $application)
    {
        if (!$application->editable()) {
            return back()->with('flash', json_encode([
                'level' => 'warning',
                'title' => 'Предупреждение',
                'message' => 'Заявка уже имеет согласование одного или нескольких отделов НОД. Редактирование запрещено!'
            ]));
        }

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
        if (!$application->editable()) {
            return back()->with('flash', json_encode([
                'level' => 'warning',
                'title' => 'Предупреждение',
                'message' => 'Заявка уже имеет согласование одного или нескольких отделов НОД. Удаление запрещено!'
            ]));
        }

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

    public function toggleNodn(LocomotiveApplication $application)
    {
        $application->update([
            'is_nodn' => !$application->is_nodn
        ]);

        $application->approvedNODN()
            ? User::notifyOwnerApproved($application, 'НОДН')
            : User::notifyOwnerNotApproved($application, 'НОДН');

        return redirect()->route('applications.show', $application)->with('flash', json_encode([
            'title' => 'Успех',
            'message' => $application->approvedNODN() ? 'Согласовано НОДН' : 'Отменено согласование НОДН'
        ]));
    }

    public function toggleNodt(LocomotiveApplication $application)
    {
        $application->update([
            'is_nodt' => !$application->is_nodt
        ]);

        $application->approvedNODT()
            ? User::notifyOwnerApproved($application, 'НОДТ')
            : User::notifyOwnerNotApproved($application, 'НОДТ');

        return redirect()->route('applications.show', $application)->with('flash', json_encode([
            'title' => 'Успех',
            'message' => $application->approvedNODT() ? 'Согласовано НОДТ' : 'Отменено согласование НОДТ'
        ]));
    }

    public function toggleNodshp(LocomotiveApplication $application)
    {
        $application->update([
            'is_nodshp' => !$application->is_nodshp
        ]);

        $application->approvedNODSHP()
            ? User::notifyOwnerApproved($application, 'НОДШП')
            : User::notifyOwnerNotApproved($application, 'НОДШП');

        return redirect()->route('applications.show', $application)->with('flash', json_encode([
            'title' => 'Успех',
            'message' => $application->approvedNODSHP() ? 'Согласовано НОДШП' : 'Отменено согласование НОДШП'
        ]));
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

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Depot;

class DepotsController extends Controller
{
    public function index()
    {
        $depots = Depot::orderBy('id')->paginate(10);

        return view('backend.depots.index', compact('depots'));
    }

    public function create()
    {
        return view('backend.depots.create', ['depot' => $depot = new Depot()]);
    }

    public function store()
    {
        $this->validate(request(), [
            'name' => 'required|string|max:40|unique:depots',
        ]);

        Depot::create([
            'name' => request('name'),
        ]);

        return redirect()->route('backend.depots');
    }

    public function edit(Depot $depot)
    {
        session()->put('url.intended', url()->previous());

        return view('backend.depots.edit', compact('depot'));
    }

    /**
     * @param Depot $depot
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Depot $depot)
    {
        $this->validate(request(), [
            'name' => 'required|string|max:40|unique:depots,name,' . $depot->id,
        ]);

        $depot->update([
            'name' => request('name'),
        ]);

        return redirect()->intended();
    }

    /**
     * @param Depot $depot
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(Depot $depot)
    {
        session()->put('url.intended', url()->previous());

        $depot->delete();

        return redirect()->intended();
    }
}

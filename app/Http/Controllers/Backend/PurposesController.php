<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Purpose;

class PurposesController extends Controller
{
    public function index()
    {
        $purposes = Purpose::paginate(10);

        return view('backend.purposes.index', compact('purposes'));
    }

    public function create()
    {
        return view('backend.purposes.create', ['purpose' => $purpose = new Purpose()]);
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store()
    {
        $this->validate(request(), [
            'name' => 'required|string|max:40',
        ]);

        Purpose::create([
            'name' => request('name'),
        ]);

        return redirect()->route('backend.purposes');
    }

    public function edit(Purpose $purpose)
    {
        session()->put('url.intended', url()->previous());

        return view('backend.purposes.edit', compact('purpose'));
    }

    /**
     * @param Purpose $purpose
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Purpose $purpose)
    {
        $this->validate(request(), [
            'name' => 'required|string|max:40',
        ]);

        $purpose->update([
            'name' => request('name'),
        ]);

        return redirect()->intended();
    }

    /**
     * @param Purpose $purpose
     *
     * @throws \Exception
     */
    public function remove(Purpose $purpose)
    {
        session()->put('url.intended', url()->previous());

        $purpose->delete();

        return redirect()->intended();
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Purpose;

class PurposesController extends Controller
{
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
    }

    /**
     * @param Purpose $purpose
     *
     * @throws \Exception
     */
    public function remove(Purpose $purpose)
    {
        $purpose->delete();
    }
}

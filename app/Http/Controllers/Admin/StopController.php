<?php

namespace App\Http\Controllers\Admin;

use App\Functions\Helper;
use App\Http\Controllers\Controller;
use App\Models\Stop;
use App\Models\Travel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Travel $travel)
    {
        $title = 'Aggiungi una tappa';
        $route = route('admin.stop.store');
        $method = 'POST';
        $stop= null;
        $button = 'Crea';

        session(['current_travel' => $travel->slug]);

        return view('admin.stops.create-edit', compact('title', 'route', 'method', 'stop', 'button', 'travel'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::id();

         // Recupera l'ID del travel dalla sessione
    $travelId = session('current_travel');

    // Assicurati di avere un travel ID valido
    if(!$travelId) {
        return redirect()->back()->with('error', 'Impossibile determinare il viaggio corrente.');
    }

    $data['travel_id'] = $travelId;

        // verifico l'esistenza della chiave 'photo' in $form_data
        if(array_key_exists('photo', $data)){
        // salvo l'immagine nello storage e ottengo il percorso
        $image_path = Storage::put('uploads', $data['photo']);

        $data['photo']= $image_path;

        }

        $stop = new Stop();
        $stop['slug'] = Helper::generateSlug($data['name'], Stop::class);
        $stop->fill($data);
        $stop->save();

        return redirect()->route('admin.travel.show',  $travelId)->with('success', 'La tappa è stata creata con successo');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

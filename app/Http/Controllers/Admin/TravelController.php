<?php

namespace App\Http\Controllers\Admin;

use App\Functions\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\TravelRequest;
use App\Models\Stop;
use App\Models\Travel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TravelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $travels = Travel::orderByDesc('start_date')->get();
        // dd($travels);
        return view('admin.home', compact('travels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Aggiungi un nuovo viaggio';
        $route = route('admin.travel.store');
        $method = 'POST';
        $travel= null;
        $button = 'Crea';

        return view('admin.travel.create-edit', compact('title', 'route', 'method', 'travel', 'button'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TravelRequest $request)
    {
        $val_data = $request->all();
        $val_data['user_id'] = Auth::id();

        // verifico l'esistenza della chiave 'photo' in $form_data
        if(array_key_exists('photo', $val_data)){
            // salvo l'immagine nello storage e ottengo il percorso
            $image_path = Storage::put('uploads', $val_data['photo']);

            $val_data['photo']= $image_path;

        }


        $travel = new Travel();
        $travel['slug'] = Helper::generateSlug($val_data['name'], Travel::class);
        $travel-> fill($val_data);
        $travel->save();

        return redirect()->route('admin.home')->with('success', 'Il viaggio è stato creato!');
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
    public function edit(Travel $travel)
    {
        $title = 'Modifica il viaggio';
        $route = route('admin.travel.update', $travel);
        $method = 'PUT';
        $button = 'Aggiorna';

        return view('admin.travel.create-edit', compact('title', 'route', 'method', 'travel', 'button'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TravelRequest $request, Travel $travel)
    {
        $val_data= $request->all();
        $val_data['user_id'] = Auth::id();

        // verifico l'esistenza della chiave 'photo' in $form_data
        if(array_key_exists('photo', $val_data)){
            // salvo l'immagine nello storage e ottengo il percorso
            $image_path = Storage::put('uploads', $val_data['photo']);

            $val_data['photo']= $image_path;

        }

        if($val_data['name'] === $travel->title){
            $val_data['slug'] = $travel->slug;
            }else{
                $val_data['slug'] = Helper::generateSlug($val_data['name'], Travel::class) ;
            }

        $travel->update($val_data);

        return redirect()->route('admin.home')->with('update', 'Il progetto è stato aggiornato');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

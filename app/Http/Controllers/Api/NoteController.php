<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Http\Resources\NoteCollection;
use App\Http\Resources\NoteResource;
use App\Models\Note;

class NoteController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \App\Http\Resources\NoteCollection
     */
    public function index()
    {
        return new NoteCollection(request()->user()->notes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(StoreNoteRequest $request){
        $note = new Note();
        $note->title = $request->title;
        $note->body = $request->body;
        $note->user_id = $request->user()->id;
        $note->save();
        return $note;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \App\Http\Resources\NoteResource
     */
    public function show(Note $note){
        if ($note->user_id == request()->user()->id) {
            return new NoteResource($note);
        } else {
            return abort(401, 'Unauthorized');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Note  $note
     * @return bool
     */
    public function update(UpdateNoteRequest $request, Note $note)
    {
        if ($note->user_id == request()->user()->id) {
            return $note->update($request->all());
        } else {
            return abort(401, 'Unauthorized');
        }
    }
    
    /**
     * remove the note 
     *
     * @param  Note $note
     * @return void
     */
    public function destroy(Note $note)
    {
        if ($note->user_id == request()->user()->id) {
            return $note->delete();
        } else {
            return abort(401, 'Unauthorized');
        }
    }
}

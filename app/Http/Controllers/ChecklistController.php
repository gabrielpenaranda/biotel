<?php

namespace App\Http\Controllers;

use App\Models\Checklist;
use App\Models\Element;
use App\Models\Log;
use Illuminate\Http\Request;

class ChecklistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $checklists = Checklist::orderBy('name', 'asc')->paginate(10);
        return view('admin.checklist.index', compact('checklists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $checklist = new Checklist;
        return view('admin.checklist.create', compact('checklist'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $checklist = new Checklist;
        /* $checklist->name = $request->name;
        $checklist->description = $request->description;
        $checklist->definition_date = $request->definition_date;
        $checklist->version = $request->version;
        $checklist->is_active = $request->is_active;
        $checklist->instructions = $request->instructions; */
        $checklist = $request->all->except('__csrf', '__method');
        $checklist->save();
        $log = new Log;
        $log->register($log, 'C', $checklist->name, $checklist->id, 'checklist', auth()->user()->id);
        session()->flash('message', __('Checklist has been created'));
        return redirect()->route('checklist.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Checklist  $checklist
     * @return \Illuminate\Http\Response
     */
    public function show(Checklist $checklist)
    {
        $elements = Element::where('checklist_id', $checklist->id);
        return view('admin.checklist.show', compact('checklist', 'elements'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Checklist  $checklist
     * @return \Illuminate\Http\Response
     */
    public function edit(Checklist $checklist)
    {
        return view('admin.checklist.edit', compact('checklist'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Checklist  $checklist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Checklist $checklist)
    {
        $checklist = new Checklist;
        /* $checklist->name = $request->name;
        $checklist->description = $request->description;
        $checklist->definition_date = $request->definition_date;
        $checklist->version = $request->version;
        $checklist->is_active = $request->is_active;
        $checklist->instructions = $request->instructions; */
        $checklist = $request->all->except('__csrf', '__method');
        $checklist->update();
        $log = new Log;
        $log->register($log, 'U', $checklist->name, $checklist->id, 'checklist', auth()->user()->id);
        session()->flash('message', __('Checklist has been updated'));
        return redirect()->route('checklist.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Checklist  $checklist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Checklist $checklist)
    {
        try {
            $checklist->delete();
            $log = new Log;
            $log->register($log, 'D', $checklist->name, $checklist->id, 'checklist', auth()->user()->id);
            session()->flash('message', 'Checklist deltted!');
            return redirect()->route('checklist.index');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == "23000") { //23000 is sql code for integrity constraint violation
                session()->flash('warning', __('Can not delete checklist, it has related information'));
                return redirect()->route('checklist.index');
            }
        }
    }
}

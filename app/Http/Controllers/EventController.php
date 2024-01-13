<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function view()
    {
        $events = Event::all();
        return view('events.view', ['events' => $events]);
    }

    public function create(Request $request)
    {
        $users = User::all();
        if($request->isMethod('post')){
            $request->validate($this->rules());

            $model = new Event();
            $model->title = $request->input('title');
            $model->description = $request->input('description');
            $model->dt_start = date('Y-m-d H:i:s', strtotime($request->input('dt_start')));
            $model->dt_end = date('Y-m-d H:i:s', strtotime($request->input('dt_end')));
            if($request->input('user_id') !== null){
                $model->user_id = $request->input('user_id');
            }
            if($model->save()){
                return redirect(route('event.view'));
            }
        }
        return view('events.create', ['users' => $users]);
    }


    public function update(Request $request, $id)
    {
        $event = Event::where('id', $id)->first();
        $users = User::all();

        if($request->isMethod('post')){
            $request->validate($this->rules());
            $event->update($request->all());
            return redirect(route('event.update', ['id' => $id]));
        }
        return view('events.update', ['event' => $event, 'users' => $users]);
    }


    public function delete(Request $request, $id)
    {
        if($request->isMethod('get')){
            Event::find($id)->delete();
        }
        return redirect(route('event.view'));
    }



    protected function rules(): array
    {
        return [
            'title' => ['required', 'string'],
            'description' => ['string'],
            'dt_start' => ['required'],
            'dt_end' => ['required']
        ];
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventCollection;
use App\Http\Resources\EventResource;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function all(): EventCollection
    {
        return new EventCollection(Event::all());
    }

    public function one(Request $request, $id)
    {
        return new EventResource(Event::where('id', $id)->first());
    }

    public function create(Request $request)
    {
       if($request->isMethod('post')){
           if(!$request->input('title') || !$request->input('dt_start') || !$request->input('dt_end')){
               return response('Error', 400);
           }
           $data = $request->validate($this->rules());
           return new EventResource(Event::create($request->all()));
       }

    }

    public function update(Request $request)
    {
        if($request->isMethod('post')){
            if(!$request->input('id') || $event = Event::where('id', $request->input('id')->first())){
                return response('Error', 400);
            }
            $data = $request->validate($this->rules());
            return new EventResource($event->update($request->all()));

        }
    }



    protected function rules()
    {
        return [
            'title' => ['string'],
            'description' => ['string'],
            'user_id' => ['integer'],
            'dt_start' => ['date_format:datetime'],
            'dt_end' => ['date_format:datetime']
        ];
    }
}

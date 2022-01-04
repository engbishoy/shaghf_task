<?php

namespace Modules\Provider\Http\Controllers\Front;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Lang;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Validator;
use Modules\Core\Http\Controllers\AppController;
use Modules\Provider\Entities\Location;

class LocationController extends AppController
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $this->setMessages([
            //swal
            'swal-delete-prompt' => Lang::get('core::global.swal.swal-delete-prompt'),
            'swal-delete-prompt-single' => Lang::get('core::global.swal.swal-delete-prompt-single'),
            'swal-hard-delete-prompt' => Lang::get('core::global.swal.swal-hard-delete-prompt'),
            'swal-hard-delete-prompt-single' => Lang::get('core::global.swal.swal-hard-delete-prompt-single'),
            'swal-delete-btn-confirm' => Lang::get('core::global.swal.swal-delete-btn-confirm'),
            'swal-delete-btn-discard' => Lang::get('core::global.swal.swal-delete-btn-discard'),

            'swal-restore-prompt' => Lang::get('core::global.swal.swal-restore-prompt'),
            'swal-restore-prompt-single' => Lang::get('core::global.swal.swal-restore-prompt-single'),
            'swal-restore-btn-confirm' => Lang::get('core::global.swal.swal-restore-btn-confirm'),
            'swal-restore-btn-discard' => Lang::get('core::global.swal.swal-restore-btn-discard'),
        ]);

        return view('provider::front.locations.index');
    }



    public function create()
    {
        $this->setAjaxParams([
            'dt_modal_request_type' => 'POST',
            'dt_modal_submit_url' => route('provider.location.store')
        ]);
       
        return view('provider::front.locations.modals.add');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {

        $validate=Validator::make($request->all(),[
            'latitude'=>'required|numeric',
            'longitude'=>'required|numeric',
        ]);

        if($validate->fails()){
            return response()->json(['errors'=>$validate->errors()],422);
        }
        $location_limit=Location::where('provider_id',auth()->user()->id)->get();

        if(count($location_limit)>=5){
            return response()->json(['errors'=>['Sorry, the limit has been exceeded']],422);
        }

        $location = Location::create([
            'latitude'=>$request->latitude,
            'longitude'=>$request->longitude,
            'provider_id'=>auth()->user()->id,
        ]);
        
        return response()->json(['message' => Lang::get('core::global.toastr.toastr-added-row')],201);
    }

    
    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Location $location)
    {
        $this->setAjaxParams([
            'dt_modal_request_type' => 'PUT',
            'dt_modal_submit_url' => route('provider.location.update', [$location->id]),
        ]);
            return view('provider::front.locations.modals.edit', compact('location'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, Location $location)
    {
        $validate=Validator::make($request->all(),[
            'latitude'=>'required|numeric',
            'longitude'=>'required|numeric',
        ]);

        if($validate->fails()){
            return response()->json(['errors'=>$validate->errors()],422);
        }
        
        $location->latitude=$request->latitude;
        $location->longitude=$request->longitude;
        $location->save();
        return response()->json(['message' => Lang::get('core::global.toastr.toastr-updated-row')],200);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Location $location)
    {
        $location->delete();
        return response()->json(['message' => Lang::get('core::global.toastr.toastr-deleted-row')], 200);
    }


    public function destroyMany(Request $request){
        Location::destroy($request->ids);
        return response()->json(['message' => Lang::get('core::global.toastr.toastr-deleted-rows')],200);
    }

 
}

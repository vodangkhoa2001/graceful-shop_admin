<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Slide;
use App\Http\Requests\StoreSlideRequest;
use App\Http\Requests\UpdateSlideRequest;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSlideDetailRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slides = Slide::all();
        // dd($slides);
        return view('component.slide.list-slide',compact('slides'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
        return view('component.slide.create-slide');
    }
    public function postCreate(StoreSlideDetailRequest $request)
    {
        $image = $request->file('picture');
        $namewithextension = $image->getClientOriginalName();
        $fileName = explode('.', $namewithextension)[0];
        $extension = $image->getClientOriginalExtension();
        $fileNew = $fileName. '-' . Str::random(10) . '.' . $extension;
        $destinationPath = public_path('/assets/img/slideshows/');
        $image->move($destinationPath,$fileNew);

        $slide = new Slide();
        $slide->picture = $fileNew;
        $slide->description = $request->description;
        $slide->status=1;
        $success = $slide->save();
        return view('component.slide.create-slide',compact('success'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSlideRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSlideRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $slide = Slide::find($id);
        return view('component.slide.detail-slide',compact('slide'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function edit(Slide $slide)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSlideRequest  $request
     * @param  \App\Models\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSlideRequest $request, Slide $slide)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slide $slide)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Developer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DeveloperController extends Controller
{
    public function index()
    {
        $developers = Developer::get();
        return view('index', compact('developers'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50|min:5',
            'email' => 'required|email',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gender' => 'required'
        ]);

        $input = $request->only('name', 'email', 'gender');
        $input['skills'] = $request->input('skills');
        if ($image = $request->file('image')) {
            $destinationPath = 'uploads/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        } else {
            unset($input['image']);
        }

        Developer::create($input);

        return redirect('/developers');
    }

    public function show(Developer $developer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Developer $developer)
    {
        $developers = Developer::get();
        return view('index', compact('developers', 'developer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Developer $developer)
    {
        $request->validate([
            'name' => 'required|max:50|min:5',
            'email' => 'required|email',
            'image' => 'required|image|mimes:jpeg,png,pdf,jpg,gif,svg|max:2048',
            'gender' => 'required'
        ]);
        if ($request->hasFile('image')) {
            $destinationPath = 'uploads/' . $developer->image;
            if (File::exists($destinationPath)) {
                File::delete($destinationPath);
            }

            $input = $request->all();
            $input['skills'] = $request->input('skills');
            if ($image = $request->file('image')) {
                $destinationPath = 'uploads/';
                $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $profileImage);
                $input['image'] = "$profileImage";
            } else {
                unset($input['image']);
            }
        }

        $developer->update($input);
        return redirect('/developers')->with("msg", "Update Successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Developer $developer)
    {
        $developer->delete();
        return redirect('/developers');
    }
}

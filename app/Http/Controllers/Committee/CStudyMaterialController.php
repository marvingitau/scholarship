<?php

namespace App\Http\Controllers\Committee;

use Illuminate\Http\Request;
use App\Models\Admin\StudyMaterial;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudyMaterialRequest;
use App\Http\Requests\UpdateStudyMaterialRequest;
use Illuminate\Support\Facades\File;

class CStudyMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $studyres = StudyMaterial::all();
        return view('committee.studymaterial.index', compact('studyres'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('committee.studymaterial.file-upload');
    }

    public function fileUpload(Request $req)
    {
        $req->validate([
            'file' => 'required|mimes:jpeg,png,jpg,csv,txt,xlx,xls,pdf|max:2048'
        ]);
        $fileModel = new StudyMaterial;
        if ($req->file()) {
            $fileName = time() . '_' . $req->file->getClientOriginalName();
            $filePath = $req->file('file')->storeAs('uploads', $fileName, 'public');
            $fileModel->name = $req->file->getClientOriginalName();
            $fileModel->name_unique = time() . '_' . $req->file->getClientOriginalName();
            $fileModel->file_path = $filePath;
            // $fileModel->file_path = '/storage/' . $filePath;
            $fileModel->category = $req->category;
            $fileModel->save();

            activity()->log("Study Material Upload: " . $fileName);
            alert('UPLOAD', 'Study Material Uploaded', 'success')->autoClose(10000);
            return back();

            // return back()
            // ->with('success','File has been uploaded.')
            // ->with('file', $fileName);
        }
    }

    public function download($id)
    {
        $path = StudyMaterial::where('id', $id)->first()->file_path;
        // dd(storage_path('app/public/'.$path));
        return response()->download(storage_path('app/public/' . $path));
    }

    public function deltefile($id)
    {
        $path = StudyMaterial::where('id', $id)->first();

        File::delete(storage_path('app/public/' . $path->file_path));
        activity()->log("Study Material Deleted: " . $path->name);
        alert('DELETED', 'Study Material DELETED', 'success')->autoClose(10000);
        $path->delete();
        return back();
    }


    public function mailedmaterials()
    {
        $studyres = StudyMaterial::all();
        return view('committee.studymaterial.mailed', compact('studyres'));
    }

    public function mailmaterials($id)
    {
        $cat = StudyMaterial::where('id', $id)->first();
        $details = [
            'category' => $cat->category,
            'id' => $id,
        ];

        $job = (new \App\Jobs\SendQueueEmail($details))
            ->delay(now()->addSeconds(2));

        dispatch($job);
        $cat->mailed = 1;
        $cat->save();

        activity()->log("Study Material Mailed: " . $cat->category);
        alert('MAILED', 'Study Material MAILED', 'success')->autoClose(10000);
        return back();
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStudyMaterialRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudyMaterialRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\StudyMaterial  $studyMaterial
     * @return \Illuminate\Http\Response
     */
    public function show(StudyMaterial $studyMaterial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\StudyMaterial  $studyMaterial
     * @return \Illuminate\Http\Response
     */
    public function edit(StudyMaterial $studyMaterial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStudyMaterialRequest  $request
     * @param  \App\Models\Admin\StudyMaterial  $studyMaterial
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudyMaterialRequest $request, StudyMaterial $studyMaterial)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\StudyMaterial  $studyMaterial
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudyMaterial $studyMaterial)
    {
        //
    }
}

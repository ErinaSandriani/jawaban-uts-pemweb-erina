<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySupirRequest;
use App\Http\Requests\StoreSupirRequest;
use App\Http\Requests\UpdateSupirRequest;
use App\Models\Supir;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class SupirController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('supir_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $supirs = Supir::with(['media'])->get();

        return view('admin.supirs.index', compact('supirs'));
    }

    public function create()
    {
        abort_if(Gate::denies('supir_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.supirs.create');
    }

    public function store(StoreSupirRequest $request)
    {
        $supir = Supir::create($request->all());

        if ($request->input('image', false)) {
            $supir->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $supir->id]);
        }

        return redirect()->route('admin.supirs.index');
    }

    public function edit(Supir $supir)
    {
        abort_if(Gate::denies('supir_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.supirs.edit', compact('supir'));
    }

    public function update(UpdateSupirRequest $request, Supir $supir)
    {
        $supir->update($request->all());

        if ($request->input('image', false)) {
            if (! $supir->image || $request->input('image') !== $supir->image->file_name) {
                if ($supir->image) {
                    $supir->image->delete();
                }
                $supir->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
            }
        } elseif ($supir->image) {
            $supir->image->delete();
        }

        return redirect()->route('admin.supirs.index');
    }

    public function show(Supir $supir)
    {
        abort_if(Gate::denies('supir_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.supirs.show', compact('supir'));
    }

    public function destroy(Supir $supir)
    {
        abort_if(Gate::denies('supir_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $supir->delete();

        return back();
    }

    public function massDestroy(MassDestroySupirRequest $request)
    {
        $supirs = Supir::find(request('ids'));

        foreach ($supirs as $supir) {
            $supir->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('supir_create') && Gate::denies('supir_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Supir();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

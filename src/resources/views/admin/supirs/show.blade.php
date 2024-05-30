@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.supir.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.supirs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.supir.fields.id') }}
                        </th>
                        <td>
                            {{ $supir->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supir.fields.name') }}
                        </th>
                        <td>
                            {{ $supir->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supir.fields.alamat') }}
                        </th>
                        <td>
                            {{ $supir->alamat }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.supir.fields.no') }}
                        </th>
                        <td>
                            {{ $supir->no }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.supirs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
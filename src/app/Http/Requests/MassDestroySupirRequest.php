<?php

namespace App\Http\Requests;

use App\Models\Supir;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySupirRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('supir_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:supirs,id',
        ];
    }
}

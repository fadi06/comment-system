<?php

namespace Fawad\LaravelComments\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'content'          => 'required|string|max:1000',
            'parent_id'        => 'nullable|integer|exists:comments,id',
            'attachments'      => 'nullable|array',
            'attachments.*'    => 'string', // stored file paths
        ];
    }
}

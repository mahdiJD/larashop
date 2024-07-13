<?php

namespace App\Http\Requests;

use App\Models\Blog;
use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        
        $result = [
            'title' => 'nullable',
            'short' => 'nullable',
            'body' => 'nullable',
            'tags' => 'nullable',
        ];
        if($this->method() == 'PUT'){
            return $result;
        }
        else return $result + ['file' => 'required|image'];
    }

    public function getData(){
        $data = $this->validated() + [
                'user_id' => $this->user()->id,
            ];
        if ($this->hasFile('file')){
            $directory = Blog::makeDirectory();
            $data['file'] = $this->file->store($directory);
        }
        return $data;
    }
}

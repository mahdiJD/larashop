<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class ProducRequest extends FormRequest
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
        return [
            'file' => 'required|image',
            'name' => 'nullable',
            'bio' => 'nullable',
            'description' => 'nullable',
            'categorie' => 'nullable',
            'price' => 'nullable|integer',
            'weight' => 'nullable|integer',
        ];
    }
    public function getData(){
        $data = $this->validated() + [
                'user_id' => $this->user()->id,
            ];
        if ($this->hasFile('file')){
            $directory = Product::makeDirectory();
            $data['file'] = $this->file->store($directory);
        }
        return $data;
    }
}

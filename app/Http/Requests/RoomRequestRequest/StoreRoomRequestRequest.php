<?php

namespace App\Http\Requests\RoomRequestRequest;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoomRequestRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'hospital_room_id' => 'required',
            // 'occupant_id' => 'required',
            // 'status' => 'nullable',
            // 'type' => 'nullable',
        ];
    }
}

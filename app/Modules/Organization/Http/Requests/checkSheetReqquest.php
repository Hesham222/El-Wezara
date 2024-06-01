<?php

namespace Organization\Http\Requests;

use Organization\Http\Requests\BaseRequest;

class checkSheetReqquest extends BaseRequest
{

    public function rules()
    {
        return [
            'point_id' => 'required|exists:point_of_sales,id',
        ];
    }

}

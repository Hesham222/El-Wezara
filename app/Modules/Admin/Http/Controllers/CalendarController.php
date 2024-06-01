<?php

namespace Admin\Http\Controllers;


class CalendarController extends JsonResponse
{
    public function __invoke()
    {
        return view('Admin::calendar.index');
    }
}

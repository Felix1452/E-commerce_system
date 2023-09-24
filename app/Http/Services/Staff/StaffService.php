<?php

namespace App\Http\Services\Staff;
use App\Models\Staff;

class StaffService
{
    public function get(){
        return Staff::orderByDesc('id')->paginate(10);
    }
}

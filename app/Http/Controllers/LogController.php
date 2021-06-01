<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use Yajra\DataTables\DataTables;

class LogController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        return view('log.index');
    }

    public function index_json()
    {
        $query = Activity::latest()->get();

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('causer', function ($query) {
                if ($query->causer_type != null && $query->causer_type == 'App\User') {
                    $causer = User::find($query->causer_id);
                    return $causer ? $causer->name : '-';
                } else
                    return '-';
            })
            ->addColumn('action', function ($query) {
                $url = route('user.destroy', $query->id);
                $input_csrf = csrf_field();
                $input_delete = method_field('delete');

                $delete = '<a href="javascript:void(0)" onclick="hapusData(\'' . $query->id . '\')" class="p-1" data-toggle="tooltip" data-placement="right" title="Hapus">
                    <i class="fa fa-trash text-danger font-medium-3"></i>
                </a>
                <form id="user-' . $query->id . '" action="' . $url . '" method="post" style="display:none;">
                    ' . $input_csrf . ' ' . $input_delete . '
                    <input type="hidden" name="idUser-' . $query->id . '" value="">
                    <input type="submit" value="OK">
                </form>';

                return $delete;
            })
            ->escapeColumns([])
            ->make(true);
    }
}

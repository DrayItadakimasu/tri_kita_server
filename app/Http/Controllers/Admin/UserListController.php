<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

use Auth;
use App\User;


class UserListController extends Controller
{


    public function show(Request $request)
    {

        $users = User::
        when($request->get('phone'), function ($q) use ($request) {
            $q->where('phone', $request->get('phone'));
        })
            ->when($request->get('last_name'), function ($q) use ($request) {
                $q->where('last_name', $request->get('last_name'));
            })
            ->when($request->get('middle_name'), function ($q) use ($request) {
                $q->where('middle_name', $request->get('middle_name'));
            })
            ->when($request->get('name'), function ($q) use ($request) {
                $q->where('name', $request->get('name'));
            })
            ->when($request->get('group'), function ($q) use ($request) {
                $q->where('group_id', $request->get('group'));
            })
            ->when($request->get('org'), function ($q) use ($request) {
                $q->where('org', 'like', '%' . $request->get('org') . '%');
            })
            ->paginate(50);
        //dd($users);

        //die();
        return view('admin.userlist', [
            'users' => $users
        ]);
    }

    public function export(Request $request)
    {

        $users = User::
        when($request->get('phone'), function ($q) use ($request) {
            $q->where('phone', $request->get('phone'));
        })
            ->when($request->get('last_name'), function ($q) use ($request) {
                $q->where('last_name', $request->get('last_name'));
            })
            ->when($request->get('middle_name'), function ($q) use ($request) {
                $q->where('middle_name', $request->get('middle_name'));
            })
            ->when($request->get('name'), function ($q) use ($request) {
                $q->where('name', $request->get('name'));
            })
            ->when($request->get('group'), function ($q) use ($request) {
                $q->where('group_id', $request->get('group'));
            })
            ->when($request->get('org'), function ($q) use ($request) {
                $q->where('org', 'like', '%' . $request->get('org') . '%');
            })->select(["last_name", "name", "middle_name", "phone", "email", "reg_address", "org", "inn", "work_with_nds", "group_id", "created_at"])->get();

        return Excel::download(new ExportUsers($users), 'userlist-' . Carbon::now() . '.xlsx');

    }


}

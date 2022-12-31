<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{

    public function upload(Request $request)
    {
        $data = new Employee();
        $data->username = $request->username;
        $data->email = $request->email;
        $data->phone = $request->phone;

        $data->save();

        $get = $data->all();
        return view('allrecords', compact('get'));
    }


    public function display(Request $request)
    {
        $data = new Employee();
        $get = $data->all();
        return view('allrecords', compact('get'));
    }

    public function update()
    {
        $id = $_GET['id'];
        $update = Employee::find($id);
        // return view('allrecords',compact('update'));
        return $update;
    }

    public function updatedata(Request $request)
    {
        $data = Employee::where('username', '=', $request->olduser)
            ->where('email', '=', $request->oldemail)
            ->where('phone', '=', $request->oldphone)
            ->pluck('id');

        $get = Employee::find($data);
        $get[0]->username = $request->username;
        $get[0]->email = $request->email;
        $get[0]->phone = $request->phone;

        $get[0]->save();
        $get = Employee::all();
        return redirect()->back();
    }

    public function delete_data($id)
    {
        $data = Employee::find($id);
        $data->delete();
        return redirect()->back();
    }

    public function search(Request $request)
    {
        $output = "";
        $data = Employee::where('username', 'like', '%' . $request->search . '%')->get();
        if ($data) {
            foreach ($data as $v1) {
                $output .= '<tr>' .
                    '<td>' . $v1->id . '</td>' .
                    '<td>' . $v1->username . '</td>' .
                    '<td>' . $v1->email . '</td>' .
                    '<td>' . $v1->phone. '</td>' .
                    '<td><a href="'.url("/datadelete",$v1->id).'" class="btn btn-danger"><i class="fa-solid fa-trash"></i> Delete</a></td>' .
                    '<td><a class="btn btn-success" onclick="updatedata('.$v1->id.')"
                    data-toggle="modal" data-target="#update"><i class="fa-regular fa-pen-to-square"></i> Update</a></td>' .
                    '</tr>';
            }
        }
        return Response($output);
    }
}

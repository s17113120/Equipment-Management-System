<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Device;
use Illuminate\Support\Facades\Hash;
class DeviceController extends Controller
{

    public function index()
    {

            $posts = DB::table('devices')
            ->join('device_status', 'device_status.id', '=', 'devices.device_status')
            ->orderByDesc('devices.created_at')
            ->paginate(5);

            // $posts = Device::join('device_status', 'devices.device_status', '=', 'device_status.id');
            // orderBy('device.id','desc')->paginate(5); // paginate(2) 分頁(幾個一頁) ，view 需加 {{ $posts->links() }}
            $data = array(
                'title' => '查詢設備',
                'posts' =>  $posts
            );
            return view('devices.searchDevice')->with($data);


    }

    public function create()
    {
        $title = '新增設備';
        return view('devices.createDevice')->with('title', $title);
    }

    public function store(Request $request) {

        $this->validate($request, [
            'device_no' => 'required',
            'device_name' => 'required',
        ]);

        $check_device_id = Device::where('device_id', '=', $request->device_no)->first();

        if ($check_device_id) {
            return redirect()->back()->with('error', '產編已申請過');
        } else {
            $device = new Device;
            $device->device_id = $request->device_no;
            $device->device_name = $request->device_name;
            $device->device_model = $request->device_model;
            $device->device_remarks = $request->device_remarks;
            $device->device_status = 1;

            $device->save();

            return redirect('devices/create')->with('success', '新增成功');
        }
    }

    public function search(Request $request, $data) {

        $posts = DB::table('devices')
        ->join('device_status', 'device_status.id', '=', 'devices.device_status')
        ->where('devices.id', 'like', '%'.$data.'%')
        ->orWhere('devices.device_id', 'like', '%'.$data.'%')
        ->orWhere('devices.device_name', 'like', '%'.$data.'%')
        ->orWhere('devices.device_model', 'like', '%'.$data.'%')
        ->orWhere('device_remarks', 'like', '%'.$data.'%')
        ->orWhere('device_status.device_status_content', 'like', '%'.$data.'%')
        ->paginate(5)
        ;

        $data_arr = array(
            'title' => '查詢設備',
            'posts' =>  $posts
        );

        return view('devices.searchDevice')->with($data_arr);

    }


}

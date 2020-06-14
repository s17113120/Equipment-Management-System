<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Record;
use App\Device;
use DB;
use Carbon\Carbon;
class RecordController extends Controller
{
    // public function index() {

    // }

    public function create() {
        $title = '設備借出';
        return view('records.createRecord')->with('title', $title);
    }
    public function searchLend() {
        $title = '查詢借出狀況';
        $timezone = 'Asia/Taipei';
        $dt = Carbon::now();
        $today = $dt->year . '-0' . $dt->month . '-' . $dt->day;

        $posts = DB::table('records')
        ->join('devices', 'devices.id', '=', 'records.device_id')
        ->join('device_status', 'device_status.device_status_id', '=', 'devices.device_status')
        ->join('record_status', 'record_status.record_status_id', '=', 'records.record_status')
        ->where('records.user_id', '=', session('userdata')->user_id)
        ->where(function ($query) {
            $query->where('records.record_status', '=', 1)
                    ->orWhere('records.record_dateOfTake', '>=', Carbon::now()->year . '-' . str_pad(Carbon::now()->month, 2, "0", STR_PAD_LEFT) . '-' . Carbon::now()->day);
        })
        // ->where('records.record_status', '=', 1)
        // ->orWhere('records.record_dateOfTake', '=', $today)
        ->orderBy('records.record_dateOfTake', 'asc')
        ->paginate(3);

        $data = array(
            'title' => $title,
            'posts' => $posts,
        );
        return view('records.searchLend')->with($data);
    }
    public function searchLendHistory() {
        $title = '查詢借出紀錄';
        $timezone = 'Asia/Taipei';
        $dt = Carbon::now();
        $today = $dt->year . '-0' . $dt->month . '-' . $dt->day;


        $posts = DB::table('records')
        ->join('devices', 'devices.id', '=', 'records.device_id')
        ->join('device_status', 'device_status.device_status_id', '=', 'devices.device_status')
        ->join('record_status', 'record_status.record_status_id', '=', 'records.record_status')
        ->where('records.user_id', '=', session('userdata')->user_id)
        ->where(function ($query) {
            $query->where('records.record_status', '!=', 1)
                    ->Where('records.record_dateOfTake', '<', Carbon::now()->year . '-' . str_pad(Carbon::now()->month, 2, "0", STR_PAD_LEFT) . '-' . Carbon::now()->day);
        })
        ->orderBy('records.record_dateOfTake', 'desc')
        ->paginate(3);

        // ->where('records.record_status', '!=', 1)
        // ->where('records.record_dateOfTake', '!=', $today)


        $data = array(
            'title' => $title,
            'posts' => $posts,
        );
        return view('records.searchLend')->with($data);
    }
    public function checkLend() {
        $title = '借出審核';

        $posts = DB::table('records')
        ->join('devices', 'devices.id', '=', 'records.device_id')
        ->join('device_status', 'device_status.device_status_id', '=', 'devices.device_status')
        ->join('record_status', 'record_status.record_status_id', '=', 'records.record_status')
        ->join('users', 'users.user_id', '=', 'records.user_id')
        ->where('records.record_status', '=', 1)

        ->paginate(3);

        $data = array(
            'title' => $title,
            'posts' => $posts,
        );

        return view('records.checkLend')->with($data);
    }

    public function store(Request $request) {

        $this->validate($request, [
            'device_id' => 'required',
            'returnDate' => 'required',
        ]); // 檢查並顯示空資訊


        // 取設備資料
        $check_device_id = DB::table('devices')
        ->join('device_status', 'device_status.device_status_id', '=', 'devices.device_status')
        ->where('device_id', '=' ,$request->device_id)
        ->get();

        if ($check_device_id) {

            if ($check_device_id[0]->device_status_content == "未借出") {

                // 借出紀錄
                $record = new Record;
                $record->user_id = session('userdata')->user_id;
                $record->device_id = $check_device_id[0]->id;
                $record->record_amount = 1;
                $record->record_dateOfTake = $request->outDate;
                $record->record_dateOfReturn = $request->returnDate;
                $record->record_content = $request->body;
                $record->record_status = 1;
                $record->save();

                return redirect('records/create')->with('success', '已成功申請，審核時間為1天左右，等待審核結果');
            } else {
                return redirect('records/create')->with('error', '設備'.$check_device_id[0]->device_status_content.'，無法借此設備');
            }
            return redirect('records/create')->with('error', 'error，請通知管理者');
        } else {
            return redirect('records/create')->with('error', '沒有此設備');
        }
    }

    public function updateLend(Request $request) {

        $type = $request->form_type;
        $id = $request->record_id;

        $find = Record::find($id);
        if ($type == 'agree') {

            $find->record_status = '2';
            $find->auditors_id = session('userdata')->user_id;

            $device = Device::find($find->device_id);

            if ($find->record_dateOfTake == (Carbon::now()->year . '-' . str_pad(Carbon::now()->month, 2, "0", STR_PAD_LEFT) . '-' . Carbon::now()->day)) {
                $device->device_status = "5";
            } else {
                $device->device_status = "3";
            }

            $find->save();
            $device->save();

            return redirect('records/checkLend')->with('success', '已成功審核，結果為同意');
        } else if ($type == 'disagree') {

            $find->record_status = '3';
            $find->auditors_id = session('userdata')->user_id;
            $find->save();

            return redirect('records/checkLend')->with('success', '已成功審核，結果為不同意');
        }
    }
    public function lendHistory() {
        $title = '審核紀錄';
        $posts = DB::table('records')
        ->join('devices', 'devices.id', '=', 'records.device_id')
        ->join('device_status', 'device_status.device_status_id', '=', 'devices.device_status')
        ->join('record_status', 'record_status.record_status_id', '=', 'records.record_status')
        ->join('users', 'users.user_id', '=', 'records.user_id')

        ->where('record_status', '!=' , 1)
        ->paginate(3);

        // $posts = Record::where('record_status', '!=' , 1)->paginate(3);

        $data = array(
            'title' => $title,
            'posts' => $posts,
        );


        return view('records.lendHistory')->with($data);
    }

    public function search(Request $request, $data) {

        session()->put('searchdata', $data);

        $posts = DB::table('records')
        ->join('devices', 'devices.id', '=', 'records.device_id')
        ->join('device_status', 'device_status.device_status_id', '=', 'devices.device_status')
        ->join('record_status', 'record_status.record_status_id', '=', 'records.record_status')
        ->join('users', 'users.user_id', '=', 'records.user_id')

        ->where('record_status', '!=' , 1)
        ->where(function ($query) {
            $query->orWhere('records.record_id', 'like', '%'.session('searchdata').'%')
                ->orWhere('users.user_name', 'like', '%'.session('searchdata').'%')
                ->orWhere('devices.device_id', 'like', '%'.session('searchdata').'%')
                ->orWhere('devices.device_name', 'like', '%'.session('searchdata').'%')
                ->orWhere('records.record_dateOfTake', 'like', '%'.session('searchdata').'%')
                ->orWhere('records.record_dateOfReturn', 'like', '%'.session('searchdata').'%')
                ->orWhere('record_status.record_status_content', 'like', session('searchdata'))
                ->orWhere('records.record_content', 'like', '%'.session('searchdata').'%');
        })

        ->paginate(3);

        $data_arr = array(
            'title' => '查詢設備',
            'posts' =>  $posts
        );

        return view('records.lendHistory')->with($data_arr);

    }

    public function deviceBack() {

        $title = '歸回設備';
        $posts = DB::table('records')
        ->join('devices', 'devices.id', '=', 'records.device_id')
        ->join('device_status', 'device_status.device_status_id', '=', 'devices.device_status')
        ->join('record_status', 'record_status.record_status_id', '=', 'records.record_status')
        ->join('users', 'users.user_id', '=', 'records.user_id')
        ->whereIn('record_status', [2])
        ->paginate(3);

        $data_arr = array(
            'title' => $title,
            'posts' => $posts
        );
        return view('records.deviceBack')->with($data_arr);
    }
    public function deviceback_update(Request $request) {
        $record = Record::find($request->record_id);
        $record->record_status = 4;
        $record->save();


        $device = Device::find($record->device_id);
        $device->device_status = 1;
        $device->save();

        return redirect('records/deviceBack')->with('success', '已成功歸還');
    }

    public function searchDeviceBack($data) {


        session()->put('searchdata', $data);

        $posts = DB::table('records')
        ->join('devices', 'devices.id', '=', 'records.device_id')
        ->join('device_status', 'device_status.device_status_id', '=', 'devices.device_status')
        ->join('record_status', 'record_status.record_status_id', '=', 'records.record_status')
        ->join('users', 'users.user_id', '=', 'records.user_id')

        ->where('record_status', '=' , 2)
        ->where(function ($query) {
            $query->orWhere('records.record_id', 'like', '%'.session('searchdata').'%')
                ->orWhere('users.user_name', 'like', '%'.session('searchdata').'%')
                ->orWhere('devices.device_id', 'like', '%'.session('searchdata').'%')
                ->orWhere('devices.device_name', 'like', '%'.session('searchdata').'%')
                ->orWhere('records.record_dateOfTake', 'like', '%'.session('searchdata').'%')
                ->orWhere('records.record_dateOfReturn', 'like', '%'.session('searchdata').'%')
                ->orWhere('record_status.record_status_content', 'like', session('searchdata'))
                ->orWhere('records.record_content', 'like', '%'.session('searchdata').'%');
        })

        ->paginate(3);

        $data_arr = array(
            'title' => '歸回設備',
            'posts' =>  $posts
        );


        return view('records.deviceBack')->with($data_arr);
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Record;
use App\Device;
use DB;
class RecordController extends Controller
{
    // public function index() {

    // }

    public function create() {
        $title = '設備借出';
        return view('records.createRecord')->with('title', $title);
    }
    public function searchLend() {
        $title = '查詢個人狀況';
        return view('records.searchLend')->with('title', $title);
    }
    public function checkLend() {
        $title = '審核借出';
        return view('records.checkLend')->with('title', $title);
    }

    public function store(Request $request) {

        $this->validate($request, [
            'device_id' => 'required',
            'returnDate' => 'required',
        ]); // 顯示空資訊



        $check_device_id = DB::table('devices')
        ->join('device_status', 'device_status.id', '=', 'devices.device_status')
        ->where('device_id', '=' ,$request->device_id)
        ->get();


        if ($check_device_id) {

            if ($check_device_id[0]->device_status_content == "未借出") {
                $record = new Record;
                $record->user_id = session('userdata')->user_id;
                $record->device_id = $request->device_id;
                $record->record_amount = 1;
                $record->record_dateOfReturn = $request->returnDate;
                $record->record_content = $request->body;
                $record->save();

                return redirect('records/create')->with('success', '已成功申請，審核時間為1天左右，等待審核結果');
            } else {
                return redirect('records/create')->with('error', '設備'.$check_device_id[0]->device_status_content.'，無法借此設備');
            }
            return redirect('records/create')->with('error', 'error，請通知管理者');
        } else {
            return redirect('records/create')->with('error', '沒有此設備');
        }
        // return gettype($request->returnDate);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecordController extends Controller
{
    public function index() {

    }

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
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use DB;
// use Facade\FlareClient\Http\Response;

class UserPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = User::orderBy('created_at','desc')->paginate(2); // paginate(2) 分頁(幾個一頁) ，view 需加 {{ $posts->links() }}
        // return view('management.checkUsers')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('posts.createForm');
        // return 123;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'no' => 'required',
            'name' => 'required',
            'account' => 'required',
            'password' => 'required',
        ]);

        $check_student_id = User::where('user_student_id', '=', $request->no)->first();
        $checkAccount = User::where('user_account', '=', $request->account)->first();

        if ($checkAccount) {
            return redirect('/addUser')->with('error', '帳號已申請過');
        } else if ($check_student_id){
            return redirect('/addUser')->with('error', '學號已申請過');
        } else {
            $user = new User;
            $user->user_student_id = $request->input('no');
            $user->user_name = $request->input('name');
            $user->user_account = $request->input('account');
            $user->user_password = Hash::make($request->input('password'));
            $user->user_authority = "user";

            $user->save();

            return redirect('/addUser')->with('success', '新增成功');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
    }

    public function login (Request $request) {
        $title = "登入";
        $account = $request->account;
        $user = User::where(['user_account' => $request->account])->first();

        if (count((array)$user) > 0) {
            if (Hash::check($request->password, $user->user_password)) {
                session()->put('userdata', $user);
            } else {
                return redirect()->back()->with('error', '帳號密碼錯誤');
            }
        } else {
            return redirect()->back()->with('error', '帳號密碼錯誤');
        }

        return redirect('/');
    }

    public function logout(Request $request) {
        $title = 'Welcome To Laravel';
        session()->flush();
        return  redirect('/');

    }

}

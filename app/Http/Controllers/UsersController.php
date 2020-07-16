<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Calendar;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    //ログイン
    public function login()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            //認証に成功したときトークンをセットしてjsonで返す
            $user = Auth::user();
            $success['token'] = $user->createToken('appToken')->accessToken;
            return response()->json([
              'success' => true,
              'token' => $success,
              'user' => $user
          ]);
        } else {
          return response()->json([
            'success' => false,
            'message' => 'Invalid Email or Password',
        ], 401);
        }
    }

    //登録
    public function register(Request $request)
    {
        // 入力チェック
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
          return response()->json([
            'success' => false,
            'message' => $validator->errors(),
          ], 401);
        }

        $input = $request->all();

        DB::transaction(function () use($input){
          $input['password'] = bcrypt($input['password']);
          $user = User::create($input);
          $success['token'] = $user->createToken('appToken')->accessToken;

          //登録した時に最初のカレンダーを作る
          Calendar::create([
            'cal_name' => '基本のカレンダー',
            'user_id' => $user->id
          ]);

          return response()->json([
            'success' => true,
            'token' => $success,
            'user' => $user
          ]);
        });
    }

    //ログアウト(アプリ実装なし)
    public function logout(Request $res)
    {
      if (Auth::user()) {
        $user = Auth::user()->token();
        $user->revoke();

        return response()->json([
          'success' => true,
          'message' => 'Logout successfully'
      ]);
      }else {
        return response()->json([
          'success' => false,
          'message' => 'Unable to Logout'
        ]);
      }
     }

}

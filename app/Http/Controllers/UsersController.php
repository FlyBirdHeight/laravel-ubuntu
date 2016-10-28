<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
class UsersController extends Controller
{
    public function register(){
        return view('users.register');
    }

    public function login(){
        return view('users.login');
    }

    public function signin(Requests\UserLoginRequest $request){
        if(Auth::attempt(['email'=>$request->get('email'),'password'=>$request->get('password')])){
            return redirect('/');
        }
        Session::flash('user_login_failed','密码不正确');
        return redirect('/user/login')->withInput();
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }

    public function avatar(){
        return view('users.avatar');
    }

    public function changeavatar(Request $request){
        $file = $request->file('avatar');
        $input = array('image' => $file);
        $rules = array(
            'image' => 'image'
        );
        $validator = Validator::make($input, $rules);
        if ( $validator->fails() ) {
            $data = ['success' => false,
                'errors' => $validator->getMessageBag()->toArray(),
            ];
            return json_encode($data);
        }
        $destinationPath = 'uploads/';
        $filename = Auth::user()->id.'_'.time().$file->getClientOriginalName();
        $file->move($destinationPath, $filename);
        Image::make($destinationPath.$filename)->fit(400)->save();

        $data1 = [
            'success' => true,
            'avatar' => asset($destinationPath.$filename),
            'image' => $destinationPath.$filename,
        ];
        return json_encode($data1);
    }

    public function cropAvatar(Request $request){
        $photo = $request->get('photo');
        $width = (int) $request->get('w');
        $height = (int) $request->get('h');
        $xAlign = (int) $request->get('x');
        $yAlign = (int) $request->get('y');

        Image::make($photo)->crop($width,$height,$xAlign,$yAlign)->save();

        $user = Auth::user();
        $user->avatar = asset($photo);
        $user->save();

        return redirect('/user/avatar');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\UserRegisterRequest $request)
    {
        $data = [
            'confirm_code'=>str_random(48),
            'avatar'=>'/asset/images/timg.jpg'
        ];
        $user =  User::create(array_merge($request->all(),$data));
        
        //send mail
        //subject view confirm_code email
//        $subject = 'Confirm Your Email';
//        $view = 'emails.test';
//        Mail::send($view,$data,function ($message) use ($user,$subject){
//            $message->to($user->email)->subject($subject);
//        });
        return redirect('/');
    }

    public function confirmEmail($confirm_code){
        $user = User::where('confirm_code',$confirm_code)->first();
        if(is_null($user)){
            return redirect('/');
        }
        $user->is_confirm = 1;
        $user->confirm_code = str_random(48);
        $user->save();
        return redirect('user/login');
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
    public function destroy($id)
    {
        //
    }
}

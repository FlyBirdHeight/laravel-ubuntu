<?php

namespace App\Http\Controllers;

use App\Discussion;
use App\Favourite;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Flashy;
use Overtrue\Socialite\SocialiteManager;

class UsersController extends Controller
{
    protected $config = [
        'github' => [
            'client_id'     => '4134fde8d827602dea8a',
            'client_secret' => 'e4a15db57cb160c4c3ad6007cdc8c94e4a805c2f',
            'redirect'      => 'http://localhost:8000/github/login',
        ],
    ];

    public function register(){
        return view('users.register');
    }

    public function login(){
        return view('users.login');
    }

    public function github(){
        $socialite = new SocialiteManager($this->config);

        return $socialite->driver('github')->redirect();
    }
    public function githublogin(){
        $socialite = new SocialiteManager($this->config);
        $githubUser = $socialite->driver('github')->user();
        dd($githubUser);
    }

    public function signin(Requests\UserLoginRequest $request){
        $field = filter_var($request->get('login'),FILTER_VALIDATE_EMAIL)?'email':'name';
        $request->merge([$field=>$request->get('login')]);
        if(Auth::attempt($request->only($field,'password'))){
            Flashy::message('Welcome Adsion社区!', 'http://adsionli.top');
            return redirect('/');
        }
        Session::flash('user_login_failed','邮箱/用户名或密码不正确');
        return redirect('/user/login')->withInput();
    }

    public function logout(){
        Auth::logout();
        Flashy::message('欢迎下次来到Adsion社区!', 'http://your-awesome-link.com');
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
    
    public function infor(Requests\InforRequest $request){
        $user = User::findOrFail(Auth::user()->id);
        $user->update($request->all());
        return redirect()->back();
    }

    public function changepassword(){
        return view('users.changepassword');
    }
    
    public function passwordchange(Requests\PasswordRequest $request){
        if (\Hash::check($request->get('password_old'),Auth::user()->password)){
            $data = User::findOrFail(Auth::user()->id);
            $data->password = $request->get('password');
            $data->save();
            Auth::login($data);
            Flashy::success('修改密码成功!', '#');
            return redirect('/');
        }else{
            Session::flash('user_password_failed','原密码不正确');
            return redirect('/user/password');
        }
    }
    
    public function search(Requests\SearchRequest $request){
        $name = $request->get('search');
        $discussions = Discussion::where('title','like','%'.$name.'%')->get();
        if (Auth::check()){
            $favourites = Favourite::where('user_id',Auth::user()->id)
                ->lists('discussion_id')->ToArray();
            return view('forum.search',compact('discussions','favourites'));
        }else{
            return view('forum.search',compact('discussions'));
        }
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
        Auth::login($user);
        //send mail
        //subject view confirm_code email
//        $subject = 'Confirm Your Email';
//        $view = 'emails.test';
//        Mail::send($view,$data,function ($message) use ($user,$subject){
//            $message->to($user->email)->subject($subject);
//        });
        Flashy::message('欢迎来到Adsion社区!', 'http://your-awesome-link.com');
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

<?php

namespace App\Http\Controllers;

use App\Models\CreditUnion;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $creditUnion=CreditUnion::all();
        return view('admin.user.addUser')->with('creditUnion',$creditUnion);
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
    public function store(Request $request)
    {
        $request->validate([
            'first_name'=>'required|alpha|max:255',
            'last_name'=>'required|alpha|max:255',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:7',
            'role'=>'required',
            'image'=>'required|image'
        ]);

        try {

            $image=$request->file('image');
            if (isset($image)) {
                $image_name=$image->getClientOriginalName();
                $image_name=str_replace("",'_',time().$image_name);
                $image_path='upload/assets/';

                $image->move($image_path,$image_name);

                $user_image=$image_path.$image_name;
            }
            else{
                $user_image=null;
            }

            $obj=new User();
            $obj->first_name=$request->first_name;
            $obj->last_name=$request->last_name;
            $obj->credit_id=$request->credit_id;//
            $obj->email=$request->email;
            $obj->password=bcrypt($request->password);
            $obj->role=$request->role;
            $obj->image=$user_image;
            $obj->save();

            // return $obj;
            return redirect()->route('user.show');
        } catch (Exception $ex) {

            return back()->withError($ex->getMessage());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
        $show=User::all();
        return view('admin.user.showUser')->with('show',$show);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit=User::find($id);
        // return response()->json($edit);
        return view('admin.user.editUser')->with('edit',$edit);
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
        $request->validate([
            'first_name'=>'required|alpha|max:255',
            'last_name'=>'required|alpha|max:255',
            'email'=>'required|email',
            'role'=>'required',
            'image'=>'required'
        ]);

        try {

            $image=$request->file('image');
            if (isset($image)) {
                $image_name=$image->getClientOriginalName();
                $image_name=str_replace("",'_',time().$image_name);
                $image_path='upload/assets/';

                $image->move($image_path,$image_name);

                $user_image=$image_path.$image_name;
            }
            else{
                $user_image=$request->previous_image;
            }


            // User::find($id)->update([
            //     'first_name'=>$request->first_name,
            //     'last_name'=>$request->last_name,
            //     'email'=>$request->email,
            //     'role'=>$request->role,
            //     'image'=>$user_image,
            // ]);
            $obj=User::find($id);
            $obj->first_name=$request->first_name;
            $obj->last_name=$request->last_name;
            $obj->email=$request->email;
            $obj->role=$request->role;
            $obj->image=$user_image;
            $obj->save();

            // return $obj;
            return redirect()->route('user.show');
        } catch (Exception $ex) {

            return back()->withError($ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy=User::find($id)->delete();
        return redirect()->route('user.show');
    }

    public function loginView()
    {
        return view('admin.user.login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);
        try {
            $is_exists=User::where('email',$request->email)->first();
            if ($is_exists->role=='admin') {
                if($is_exists)
                {
                   if(Hash::check($request->password,$is_exists->password))
                   {
                       session([
                           'admin_id'=>$is_exists->id,
                           'image'=>$is_exists->image,
                           'first_name'=>$is_exists->first_name,
                            'last_name' => $is_exists->last_name,
                           'email'=>$is_exists->email,
                           'role'=>'admin'
                       ]);
                       return redirect()->route('dashboard.index');
                   }
                   else
                   {
                       return back()->withError('Oops ! you have entered invalid email..')->withInput();
                   }
                }
                else{
                    return back()->withError('Oops ! you have entered invalid email..')->withInput();
                }
            }
            elseif ($is_exists->role=='Client') {
                if ($is_exists) {
                    if (Hash::check($request->password,$is_exists->password)) {
                        session([
                            'admin_id'=>$is_exists->id,
                            'image'=>$is_exists->image,
                            'first_name'=>$is_exists->first_name,
                            'last_name' => $is_exists->last_name,
                            'credit_union'=>$is_exists->credit_id,
                            'email'=>$is_exists->email,
                            'role'=>'Client'
                        ]);
                        return redirect()->route('dashboard.index');
                    } else {
                        return back()->withError('Oops ! you have entered invalid password..')->withInput();
                    }

                } else {
                    return back()->withError('Oops ! you have entered invalid email..')->withInput();
                }

            }
            else
            {
                return back()->withError('You are not registered as an admin so please contact support team');
            }
            // if ($is_exists) {
            //     if (Hash::check($request->password, $is_exists->password)) {
            //         session([
            //             'admin_id'=>$request->id,
            //         ]);
            //         return redirect()->route('user.index');
            //     } else {
            //         return back()->withError('Password did not Match');
            //     }

            // } else {
            //     return back()->withError('Email dit not match');
            // }

        } catch (Exception $ex) {
            return back()->withError($ex->getMessage());
        }

    }
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('user.login');
    }
    public function editSetting(Request $request)
    {
        $editSetting=User::where('id',session('admin_id'))->first();
        return view('admin.accountSetting.account')->with('editSetting',$editSetting);
    }

    public function masterPage()
    {
        $masterPage=User::where('id',session('admin_id'))->first();
        return view('admin.master')->with('masterPage',$masterPage);
    }
    public function storeSetting(Request $request)
    {
        $request->validate([
            'first_name'=>'required|alpha',
            'last_name'=>'required|alpha',
            'email'=>'required|email'
        ]);
        try {
            $storeSetting=User::where('id',session('admin_id'))->first();
            $storeSetting->first_name=$request->first_name;
            $storeSetting->last_name=$request->last_name;
            $storeSetting->email=$request->email;
            $storeSetting->save();
        } catch (Exception $ex) {
            return back()->withError($ex->getMessage());
        }


        return redirect()->route('setting.editSetting');
        //return $storeSetting;
    }
    public function settingImage(Request $request)
    {
        $request->validate([
            'image'=>'required|image'
        ]);
        try {
            $image=$request->file('image');
            if (isset($image)) {
                $image_name=$image->getClientOriginalName();
                $image_name=str_replace("",'_',time().$image_name);
                $image_path='upload/assets/';

                $image->move($image_path,$image_name);

                $user_image=$image_path.$image_name;
            }
            else{
                $user_image=$request->previous_image;
            }

            $settingImage=User::where('id',session('admin_id'))->first();
            $settingImage->image=$user_image;
            $settingImage->save();

            return redirect()->route('setting.editSetting');

        } catch (Exception $ex) {
            return back()->withError($ex->getMessage());
        }

    }

    public function settingPassword(Request $request)
    {
        $request->validate([
            'old_password'=>'required',
            'new_password'=>'required|min:7',
            'confirmed_password'=>'required|same:new_password'
        ]);
        //$is_exists=User::where('email',$request->email)->first();
        $is_exists=User::where('id',session('admin_id'))->first();


        //if(Hash::check($request->password,$is_exists->password))
        if (Hash::check($request->old_password,$is_exists->password)) {

            $obj=User::find($is_exists->id);
            $obj->password=bcrypt($request->new_password);
            $obj->save();

            return back()->with('old_password','Password successfully update.');
        }else{
            return back()->with('old_password','Old Password does not matched.');
        }

    }
}

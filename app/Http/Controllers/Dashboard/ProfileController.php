<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Languages;

class ProfileController extends Controller
{

    public function edit(){
        $user=Auth::user();    // Auth::user()==$request->user()
        $countries = Countries::getNames('en');
        $languages = Languages::getNames();

        return view('dashboard.profile.edit',compact('user','countries','languages'));
    }
    public function update(Request $request){
//        $request->validate([
//            'first_name'=>['require','string','max:255'],
//            'last_name'=>['require','string','max:255'],
//            'birthday'=>['nullable','date','before:today'],
//            'gender'=>['in:male,female'],
//            'country'=>['require','string','size:2']
//        ]);
        $user=Auth::user();
//        $user->profile->fill($request->all())->save();
        return redirect()->route('profile.edit')
            ->with('success','profile has added');
//        $profile=$user->profile;
//        if($profile->first_name){
//            $user->profile->update($request->all());
//        }else{
////            $request->merge([
////                'user_id'=>$user->id
////            ]);
////            Profile::create($request->all());
//            $user->profile()->create($request->all());
//            //من خلال العلاقة هيجيب الاي دي الخاص بالعلاقة
//        }
    }
}

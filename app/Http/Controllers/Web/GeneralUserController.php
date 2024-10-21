<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Enum\RoleEnum;
use App\Http\Controllers\Auth\LoginController;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\VarDumper\VarDumper;

class GeneralUserController extends Controller
{
    // Profile
    public function showMyProfile(Request $request) {
        $user = $request->user();
        return view('profile.show', compact('user'));
    }

    // profile edit page
    public function editMyProfile(Request $request) {
        $user = $request->user();
        return view('profile.edit', compact('user'));
    }

    // profile update
    public function updateMyProfile(Request $request) {
        // $this->profileUpdateAvatar($request);
        // return;
        switch ($request->user()->role->id) {
            case RoleEnum::ADMIN->id():
                echo "admin";
                break;
            
            case RoleEnum::MEDIS->id(): 
                return $this->profileUpdateMedis($request); 
                break;

            case RoleEnum::PASIEN->id():  
                return $this->profileUpdatePasien($request);
                break;

            default:
            echo "nothin";
                # code...
                break;
        }
        
    }

    public function profileUpdateAvatar(Request $request){
        $user = $request->user();
        if(!$request->hasFile('imgAvatar')){  
            return false;
        }

        
        // try to move file
        $fileExt = $request->file('imgAvatar')->getClientOriginalExtension();
        $filenameHash = uniqid("avatar_".time());
        $filenameWithExt = $filenameHash.'.'.$fileExt;
 
        // check folder
        if(!File::isDirectory(env('PATH_USER_AVATAR'))){
            File::makeDirectory(env('PATH_USER_AVATAR'));
        }

        // store
        if(!$request->file('imgAvatar')->storeAs(env('PATH_USER_AVATAR'), $filenameWithExt)){
            // return false;

            return redirect()
                ->to(route('myProfile.edit'))
                ->with('messageSuccess', 'Failed storing file.');
 
        }


        // delete previous file 
        if($user->avatar){
            $oldAvatarPath = env('PATH_USER_AVATAR').'/'.$user->avatar;
            if(File::exists($oldAvatarPath)){ 
                if(!Storage::delete($oldAvatarPath)){
                    Storage::delete(env('PATH_USER_AVATAR').'/'.$filenameWithExt);
                    return false;

                    return redirect()
                    ->to(route('myProfile.edit'))
                    ->with('messageSuccess', 'Failed deleting old avatar.'); 
                }
            }
        }

        // save filepath to user
        $user->avatar = $filenameWithExt;
        if(!$user->save()){
            return redirect()
            ->to(route('myProfile.edit'))
            ->with('messageSuccess', 'Failed saving user data.');  
        }

    }
    
    public function profileUpdatePasien(Request $request){
        $user = $request->user();
        $pasien = $user->getPasien();
  
        $validator = false;

        $validator = Validator::make($request->all(), [
            'inpName' => 'required|string|max:255|min:3',
            'inpGender' => 'required|numeric|between:1,2',
            'inpBorn' => 'required|date_format:d/m/Y', 
            'inpWeight' => 'required|numeric', 
            'inpHeight' => 'required|numeric', 
        ]);

        if($validator->fails()){ 
            return redirect()
            ->back()
            ->withInput()
            ->withErrors($validator->errors());
        }

        $user->name = $request->input('inpName');

        DB::beginTransaction();

        if(!$user->save()){
            DB::rollBack();
            return redirect()
            ->back()
            ->withInput()
            ->withErrors([
                'messageError' => 'Gagal mengupdate data pasien.'
            ]);
        }

        $bornDate = Carbon::createFromFormat('d/m/Y', $request->input('inpBorn'))->format('Y-m-d');

        $pasien->gender = $request->input('inpGender')==1?true:false;
        $pasien->born = $bornDate;
        $pasien->weight = $request->input('inpWeight');
        $pasien->height = $request->input('inpHeight');

        if(!$pasien->save()){
            DB::rollBack();

            return redirect()
            ->back()
            ->withInput()
            ->withErrors([
                'messageError' => 'Gagal mengupdate data pasien.'
            ]); 
        }

        try {
            DB::commit();
            return redirect()
                ->to(route('myProfile.edit'))
                ->with('messageSuccess', 'Berhasil mengupdate data profil.');
        } catch (\Throwable $th) {
            return redirect()
            ->back()
            ->withInput()
            ->withErrors([
                'messageError' => 'Gagal mengupdate data profil.'
            ]); 
        }
    }

    public function profileUpdateMedis(Request $request){
        $user = $request->user();
        $medis = $user->getMedis();
  
        $validator = false;

        $validator = Validator::make($request->all(), [
            'inpName' => 'required|string|max:255|min:3',
        ]);

        if($validator->fails()){  
            return redirect()
            ->back()
            ->withInput()
            ->withErrors($validator->errors());
        }

        $user->name = $request->input('inpName');

        DB::beginTransaction();

        if(!$user->save()){
            DB::rollBack();
            return redirect()
            ->back()
            ->withInput()
            ->withErrors([
                'messageError' => 'Gagal mengupdate data pasien.'
            ]);
        }

        try {
            DB::commit();
            return redirect()
                ->to(route('myProfile.edit'))
                ->with('messageSuccess', 'Berhasil mengupdate data profil.');
        } catch (\Throwable $th) {
            return redirect()
            ->back()
            ->withInput()
            ->withErrors([
                'messageError' => 'Gagal mengupdate data profil.'
            ]); 
        }
    }


    // password edit page
    public function editMyPassword() {
        
    }

    // password update
    public function updateMyPassword() {
        
    }
}

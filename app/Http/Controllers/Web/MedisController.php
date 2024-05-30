<?php

namespace App\Http\Controllers\Web;

use App\Enum\RoleEnum;
use App\Http\Controllers\Controller;
use App\Models\Pasien;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;
use Symfony\Component\HttpFoundation\InputBag;
use Illuminate\Support\Str;

class MedisController extends Controller
{
    # TODO: medis dashboard
    public function index()
    {
        return view('medis.dashboard');
    }

    // PASIEN
    # TODO: patient create
    public function newPasien() {
        return view('medis.pasienNew');
    }

    public function createPasien(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'inpName' => 'required|string|max:255|min:3',
            'inpEmail' => 'required|string|email|unique:users,email',
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

        $user = new User([
            'name' => $request->input('inpName'),
            'email' => $request->input('inpEmail'),
            'role_id' => RoleEnum::PASIEN,
            'email_verified_at' => now(),
            'password' => $request->input('inpName'), // password
            'remember_token' => Str::random(10),
        ]);

        DB::beginTransaction();
        if(!$user->save()){
            DB::rollBack();
            return redirect()
            ->back()
            ->withInput()
            ->withErrors([
                'messageError' => 'Gagal menambahkan pasien.'
            ]); 
        }

        $bornDate = Carbon::createFromFormat('d/m/Y', $request->input('inpBorn'))->format('Y-m-d');

        $pasien = new Pasien([
            'born' => $bornDate,
            'weight' => $request->input('inpWeight'),
            'height' => $request->input('inpHeight'),
            'gender'=> $request->input('inpGender')==1?true:false,
            'user_id' => $user->id
        ]);

        if(!$pasien->save()){
            DB::rollBack();
            return redirect()
            ->back()
            ->withInput()
            ->withErrors([
                'messageError' => 'Gagal menambahkan pasien.'
            ]);
        }

        try {
            DB::commit();
            return redirect()
                ->to(route('medis.pasienList'))
                ->with('messageSuccess', 'Berhasil menambahkan pasien.');
        } catch (\Throwable $th) {
            return redirect()
            ->back()
            ->withInput()
            ->withErrors([
                'messageError' => 'Gagal menambahkan pasien.'
            ]);
        }
 
    }

    # TODO: pasien list
    public function pasienList()
    {
        $pasiens = Pasien::all();
        return view('medis.pasienList', compact('pasiens'));
    }

    #TODO: show pasien
    public function showPasien(Pasien $pasien){ 
        return view('medis.pasienDetail', compact('pasien'));
    }

    #: edit pasien
    public function editPasien(Pasien $pasien){
        return view('medis.pasienEdit', compact('pasien'));
    }

    #: update pasien
    public function updatePasien(Pasien $pasien, Request $request){ 
 
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
 
        $pasien->user->name = $request->input('inpName');

        DB::beginTransaction();

        if(!$pasien->user->save()){
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
                ->to(route('medis.pasienEdit', $pasien))
                ->with('messageSuccess', 'Berhasil mengupdate data pasien.');
        } catch (\Throwable $th) {
            return redirect()
            ->back()
            ->withInput()
            ->withErrors([
                'messageError' => 'Gagal mengupdate data pasien.'
            ]); 
        }

    }

    #: delete pasien
    public function deletePasien(Pasien $pasien){
        
        DB::beginTransaction();

        // TODO: delete another pasien data
        if(!$pasien->delete()){
            DB::rollBack();

            return redirect()
            ->back() 
            ->withErrors([
                'messageError' => 'Gagal menghapus pasien.'
            ]);  
        }

        if(!$pasien->user->delete()){
            DB::rollBack();
            return redirect()
            ->back() 
            ->withErrors([
                'messageError' => 'Gagal menghapus data pasien.'
            ]); 
        }

        try {
            DB::commit();
            return redirect(route('medis.pasienList'))
                ->with('messageSuccess', 'Berhasil menghapus data pasien.');

        } catch (\Throwable $th) {
            return redirect()
                ->back()
                ->withErrors([
                    'messageError' => 'Gagal menghapus data pasien.'
                ]);  
        }  
    }

    public function resetPassword(Pasien $pasien) {
        if(!$pasien){
            return redirect()
                ->to(route('medis.pasienList', $pasien))
                ->with('messageError', 'Pasien tidak ditemukan.'); 
        }

        $password = env("USER_DEFAULT_PASSWORD", "PASSWORD");
        $pasien->user->password = Hash::make($password);

        if(!$pasien->user->save()){
            return redirect()
                ->to(route('medis.pasienShow', $pasien))
                ->with('messageError', 'Gagal mereset password pasien.'); 
        }

        return redirect()
            ->to(route('medis.pasienShow', $pasien))
            ->with('messageSuccess', 'Berhasil mereset password.');
    }

    # TODO: patient's teraphy history
    public function patientTeraphyHistory(User $user)
    {
        return 'medis: patientTeraphyHistory';
    }


    # TODO: patient store
    public function storePasien()
    {
        return 'medis: storePasien';
    }

    // RIWAYAT
    # TODO: record index
    public function riwayatList()
    {
        $pasiens = Pasien::all();
        return view('medis.riwayatList', compact('pasiens'));
    }

    # TODO: show detail riwayat
    public function riwayatPasienList(Pasien $pasien){

    }
}

<?php

namespace App\Http\Controllers\Web;

use App\Enum\RoleEnum;
use App\Http\Controllers\Controller;
use App\Models\Device;
use App\Models\MonitoringRecord;
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
        $jumlahPasien = Pasien::count();
        $jumlahPasienLaki = Pasien::where('gender', 1)->count();
        $jumlahPasienPerempuan = Pasien::where('gender', 0)->count();

        return view('medis.dashboard', compact('jumlahPasien', 'jumlahPasienLaki', 'jumlahPasienPerempuan'));
    }

    // PASIEN
    # TODO: patient create
    public function pasienCreate() {
        return view('medis.pasien.create');
    }

    public function pasienStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'inpName' => 'required|string|max:255|min:3',
            'inpEmail' => 'required|string|email|unique:users,email',
            'inpGender' => 'required|numeric|between:1,2',
            'inpBorn' => 'required|date_format:d/m/Y',
            'inpWeight' => 'required|numeric',
            'inpHeight' => 'required|numeric',
            'inpIllnessHistory' => 'string'
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
            'password' => Hash::make(config('igoniometer.user_default_password')), // password
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
            'user_id' => $user->id,
            'illnessHistory' => $request->input('inpIllnessHistory')
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
                ->to(route('medis.pasien.list'))
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
        return view('medis.pasien.list', compact('pasiens'));
    }

    #TODO: show pasien
    public function showPasien(Pasien $pasien){
        return view('medis.pasien.detail', compact('pasien'));
    }

    #: edit pasien
    public function pasienEdit(Pasien $pasien){
        return view('medis.pasien.edit', compact('pasien'));
    }

    #: update pasien
    public function pasienUpdate(Pasien $pasien, Request $request){

        $validator = Validator::make($request->all(), [
            'inpName' => 'required|string|max:255|min:3',
            'inpGender' => 'required|numeric|between:1,2',
            'inpBorn' => 'required|date_format:d/m/Y',
            'inpWeight' => 'required|numeric',
            'inpHeight' => 'required|numeric',
            'inpIllnessHistory' => 'string'
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
        $pasien->illnessHistory = $request->input('inpIllnessHistory');

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
                ->to(route('medis.pasien.edit', $pasien))
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
    public function pasienDelete(Pasien $pasien){

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
            return redirect(route('medis.pasien.list'))
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
                ->to(route('medis.pasien.list', $pasien))
                ->with('messageError', 'Pasien tidak ditemukan.');
        }

        $password = env("USER_DEFAULT_PASSWORD", "PASSWORD");
        $pasien->user->password = Hash::make($password);

        if(!$pasien->user->save()){
            return redirect()
                ->to(route('medis.pasien.list', $pasien))
                ->with('messageError', 'Gagal mereset password pasien.');
        }

        return redirect()
            ->to(route('medis.pasien.show', $pasien))
            ->with('messageSuccess', 'Berhasil mereset password.');
    }

    // RIWAYAT
    public function monitoringIndex()
    {
        $pasiens = Pasien::all();
        return view('medis.monitoring.index', compact('pasiens'));
    }

    public function monitoringShowPasien(Pasien $pasien)
    {
        return view('medis.monitoring.showPasien', compact('pasien'));
    }

    // menampilkan daftar pasien
    public function reportHistoryIndex()
    {
        $pasiens = Pasien::all();
        return view('medis.report.index', compact('pasiens'));
    }

    // menampilkan data per pasien
    public function reportHistoryShowPasien(Pasien $pasien)
    {
        $groupBy = '';

        $recordDates = [];
        switch($groupBy){
            default:
                $recordDates = $pasien->getMonitoringRecordDates();
            break;
        }
        return view('medis.report.showPasien', compact('pasien', 'recordDates'));
    }

    // DEVICES
    public function devices() {
        $devices = Device::all();
        return view('medis.device.index', compact('devices'));
    }

    public function deviceDetail(Device $device){
        return view('medis.device.show', compact('device'));
    }

    public function deviceRegister() {
        return view('medis.device.create');
    }

    public function deviceCreate(Request $request) {
        $validator = Validator::make($request->all(), [
            'deviceSerial' => 'required|string|max:255|min:15',
        ]);

        if($validator->fails()){
            return redirect()
            ->back()
            ->withInput()
            ->withErrors($validator->errors());
        }

        $device = new Device([
            'serialNumber' => $request->input('deviceSerial')
        ]);

        if(!$device->save()){
            return redirect()
            ->back()
            ->withInput()
            ->withErrors([
                'messageError' => 'Gagal menyimpan data perangkat.'
            ]);
        }

        return redirect(route('medis.devices'));
    }

    public function pasienAssignDevice(Pasien $pasien) {
        $devices = Device::all();

        return view('medis.pasien.assignDevice', compact('pasien', 'devices'));
    }

    public function deviceAssignPasien(Device $device){
        $pasiens = Pasien::all();
        return view('medis.device.assignPasien', compact('pasiens', 'device'));
    }


    // APIS
    public function pasienAssignDeviceStore(Request $request){
        $deviceId = $request->input('deviceId');
        $pasienId = $request->input('pasienId');

        $device = Device::find($deviceId);
        $pasien = Pasien::find($pasienId);

        if(!$device || !$pasien){
            return response()->json([
                'message' => 'invalid input'
            ], 422);
        }

        $pasien->ownedDeviceId = $device->id;

        if(!$pasien->save()){
            return response()->json([
                'message' => 'unexpected error'
            ], 500);
        }

        return response()->json([
            'message' => 'ok'
        ], 200);
    }

    public function pasienUnassignDeviceStore(Request $request){
        $pasienId = $request->input('pasienId');

        $pasien = Pasien::find($pasienId);

        if(!$pasien){
            return response()->json([
                'message' => 'invalid input'
            ], 422);
        }

        $pasien->ownedDeviceId = null;

        if(!$pasien->save()){
            return response()->json([
                'message' => 'unexpected error'
            ], 500);
        }

        return response()->json([
            'message' => 'ok'
        ], 200);
    }
}

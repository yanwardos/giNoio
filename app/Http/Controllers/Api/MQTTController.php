<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Device;
use App\Models\MonitoringRecord;
use Illuminate\Http\Request;

class MQTTController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function recordStore(Request $request){
        $request = $request->all([
            'topic',
            'payload'
        ]);

        $topic = explode('/', $request['topic']);

        $clientId = $topic[1];

        $device = Device::where('serialNumber', $clientId)->first();
        
        if(!$device){
            return response()->json([
                'status' => 'error',
                'message' => 'Device not found' 
            ], 404);
        }
        
        if(!$device->pasien){
            return response()->json([
                'status' => 'error',
                'message' => 'Device has no patient' 
            ], 404); 
        }

        $record = new MonitoringRecord([
            'deviceId' => $device->id,
            'pasienId' => $device->pasien->id,
            'data' => json_encode($request['payload'])
        ]);

        if(!$record->save()){
            return response()->json([
                'status' => 'error',
                'message' => 'Faile saving record'
            ], 500);
        } 
        return response()->json([
            'message' => 'ok'
        ], 200);
    }
}

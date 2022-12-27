<?php


namespace App\Http\Controllers;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: *');

use App\Http\Requests\FreeShipAdd;
use App\Http\Requests\FreeShipUpdate;
use App\Models\FreeShip;
use App\Models\History;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class FreeShipController extends Controller
{
    public function index(Request $request){
        $numberFreeShipPerPage = (int) $request->input('perPage', 20);
        $query = FreeShip::with('user');
        if(!empty($request->province)){
            $query->where('province', 'like', '%'.$request->province.'%');
        }
        if(!empty($request->sortProvince)){
            $query->orderBy('province', $request->sortProvince);
        }
        $count = $query->get()->count();
        $data = $query->orderBy('id', 'desc')->paginate($numberFreeShipPerPage);

        return response()->json([
            'numberFreeShipPerPage' => $numberFreeShipPerPage,
            'count' =>$count,
            'data' =>$data->getCollection(),
            'paginate' => $data,
            ], 200);
        
    }

    public function getFreeshipInfo($id) {
        $data = FreeShip::where('id', $id)->first();
        return response()->json([
            'data' => $data,
        ], 200);
    }

    public function update(FreeShipUpdate $request)
    {
        $user_id = User::all()->random()->id;
        $update = FreeShip::where('id', $request->id)->first();

        if(is_null($update)){
            return response()->json([
                'msg'=> 'Fail. Id Not Exist'
            ], 400);
        }

        $update->minimum_spent = $request->minimum_spent;
        $update->remark = $request->remark;
        $update->valid_date = Carbon::parse($request->valid_date)->format('Y-m-d');
        $update->expired_at = Carbon::parse($request->expired_at)->format('Y-m-d');
        $update->user_id = $user_id;

        $update->save();

        $operation = 'Edit the record <br> id : '
        .$update->id.' <br> province : '
        .$update->province.' <br> minimum_spent : '
        .$update->minimum_spent.' <br> remark : '
        .$update->remark.' <br> valid_date : '
        .$update->valid_date.' <br> expired_at : '
        .$update->expired_at;
        
        $this->history($operation);
 
        return response()->json([
            'msg' => 'Update Success '.$request->id,
        ], 200);
    }

    public function store(FreeShipAdd $request) {
        $count = count($request->province);
        $Id = '';
        $user_id = User::all()->random()->id;
        for($i = 0; $i < $count; $i++){
            $freeShip = new FreeShip();
            $freeShip->province = $request->province[$i];
            $freeShip->minimum_spent = $request->min_spent[$i];
            $freeShip->remark = $request->remark[$i];
            $freeShip->valid_date = Carbon::parse($request->valid[$i])->format('Y-m-d');
            $freeShip->expired_at = Carbon::parse($request->experied[$i])->format('Y-m-d');
            $freeShip->user_id = $user_id;

            $freeShip->save();

            $operation = 'Insert <br>Province id:'.$freeShip->id.' Data insert:<br>'.json_encode($freeShip);
            $this->history($operation);
            $Id = $Id.' '.$freeShip->id;
        }
        return response()->json([
            'msg' => 'Add Success ID: '.$Id,
        ],200);
    }

    public function delete($id) {
        $freeShip = FreeShip::find($id);
        if(is_null($freeShip)) {
            return response()->json([
                'msg' => 'Delete '.$id.' Fail',
                'error' => 'The '.$id.' Not Exist'
            ],400);
        }
        $result = $freeShip->delete();

        if($result) {
            $operation = 'Delete the record <br> ID : '.$id;
            $this->history($operation);

            return response()->json([
                'msg' => 'Delete '.$id.' Success'
            ],200);
        }
        return response()->json([
            'msg' => 'Delete '.$id.' Success',
            'error' => 'No Permission'
        ],400);
    }


    private function history($operation) {
        $user_id = User::all()->random()->id;
        $history = new History();
        $history->module = 'Free Shipping Management';
        $history->operation = $operation;
        $history->user_id = $user_id;
        $history->save();
    }

}

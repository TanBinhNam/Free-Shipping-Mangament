<?php

namespace App\Http\Controllers;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: *');

use App\Models\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index(Request $request) {
        $numberHistoryPerPage = $request->input('perPage', 20);
        // $query = History::with('user');
        $query = History::select('histories.*', 'users.name')->join('users', 'users.id', '=', 'histories.user_id');
        $filters = $this->filters($request);
        
        $query->filterHistory($filters);
   
        $count = $query->get()->count();
        $data = $query->orderBy('id', 'desc')->paginate($numberHistoryPerPage);

        return response()->json([
            'numberHistoryPerPage' => $numberHistoryPerPage,
            'count' =>$count,
            'data' =>$data->getCollection(),
            'paginate' => $data,
            ], 200);
    }

    private function filters(Request $request){
        $filters = [];

        if($request->has('sortModule') && !is_null($request->sortModule))
        {
            $filters['sortModule'] = $request->sortModule;
        } 

        if($request->has('sortOperation') && !is_null($request->sortOperation))
        {
            $filters['sortOperation'] = $request->sortOperation;
        } 

        if($request->has('sortCreateDate') && !is_null($request->sortCreateDate))
        {
            $filters['sortCreateDate'] = $request->sortCreateDate;
        } 

        if($request->has('sortUser') && !is_null($request->sortUser))
        {
            $filters['sortUser'] = $request->sortUser;
        } 
        return $filters;
    }
}

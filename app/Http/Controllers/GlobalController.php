<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use Illuminate\Contracts\Validation\ValidationException;
use App\Models\TblGlobal as Keyword;

class GlobalController extends Controller
{
    /**
     * Fetch Global Keywords
     * 
     * This endpoint retrieves all Global Keyword
     *
     * @group Global Keyword
     * @queryParam id Specific Global Keyword you want to retrieve. No-example
     * @queryParam name Search by Global Keyword No-example
     * @queryParam total Number of Global Keyword you want to retrieve. Defaults to 20. Example: 5
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = $request->id;
        $name = $request->name;
        $total = ($request->total? $request->total: 20); //default 20

        $query = Keyword::select('id','name');
        if($id)
            $query->where('id','=', $id);

        if($name)
            $query->where('name','like', '%'.$name.'%');

        return $result = response()->json(['data' => $query->limit($total)->get()]);
    }

    /**
     * Add Global Keyword
     * 
     * This endpoint use to create a global keyword
     * 
     * @group Global Keyword
     * 
     * @bodyParam name string required Name of the Global word. Example: News-Report
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:tbl_globals',
        ]);

        if($validator->fails())
        {
            return response()->json(['errors' => $validator->errors()->first()], 422);
        }
        else{
            $keywords = Keyword::create($request->all());
            return response()->json([
                'message' => 'Global Keyword insert successfully',
                'data' => $keywords
            ]);
        }
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
     * Update Global Keyword
     * Update the specified  Global Keyword in storage.
     * Use this api to Update  Global Keyword.
     * 
     * @group  Global Keyword
     * 
     * @urlParam id int required Id of the global keyword. Example: 2
     * @bodyParam name string Name of the global keyword. Example: dubai-traffic
     * 
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Keyword $keyword)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:tbl_globals,name,'.$keyword->id
        ]);

        if($validator->fails())
        {
            return response()->json(['errors' => $validator->errors()->first()], 422);
        }
        else{
            $keyword->update($request->all());
            return response()->json([
                'message' => 'Global Keyword updated successfully',
                'data' => $keyword,
            ]);
        }  
    }

    /**
     * Delete Global Keyword
     * 
     * Use this api to Delete specific Global Keyword.
     * @group Global Keyword
     * 
     * @urlParam id required The id of the specific Global Keyword.
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $keyword = Keyword::findOrFail($id);
            $keyword->delete();

            return response()->json([
                'message' => 'Global Keyword deleted successfully',
                'data' => $keyword,
             ]);
        }catch (\Exception $e){
            return response()->json(['error' => 'Bad Request'], 400);
        }

       
    }
}

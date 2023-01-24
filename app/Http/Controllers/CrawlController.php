<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use DB;
use Illuminate\Contracts\Validation\ValidationException;
use App\Models\TblCrawlLog as Crawl;




class CrawlController extends Controller
{
    /**
     * Fetch Crawl Logs
     * 
     * This endpoint retrieves all crawl logs
     *
     * @group Crawl Logs
     * 
     * @queryParam total Number of crawl_logs you want to retrieve. Defaults to 20. Example: 2
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        DB::connection()->enableQueryLog();
        $total = ($request->total? $request->total: 20); //default 20

        $query = Crawl::select('id', 'description', 'date_time');

        return $result = response()->json(['data' => $query->orderby('id', 'DESC')->limit($total)->get()]);
    }
}
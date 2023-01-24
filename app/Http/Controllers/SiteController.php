<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use DB;
use Illuminate\Contracts\Validation\ValidationException;
use App\Models\TblSite as Site;




class SiteController extends Controller
{
    /**
     * Fetch Sites
     * 
     * This endpoint retrieves all sites along with categories
     *
     * @group Site
     * 
     * @queryParam id Specific site you want to retrieve by id. No-example
     * @queryParam name Search by site name No-example
     * @queryParam depth Search by crawl depth of site No-example
     * @queryParam total Number of sites you want to retrieve. Defaults to 20. Example: 2
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { 
        DB::connection()->enableQueryLog();
        $total = ($request->total? $request->total: 20); //default 20

        $query = Site::with('categories');

        if($request->id)
            $query->where('tbl_sites.id', $request->id);
        
        if($request->name)
            $query->where('tbl_sites.name','like', '%'.$request->name.'%');

        if($request->depth)
            $query->where('tbl_sites.depth', $request->depth);
            
        return $result = response()->json(['data' => $query->limit($total)->get()]);
    }

    /**
     * Add Site
     * 
     * This endpoint use to create a Site
     * 
     * @group Site
     * 
     * @bodyParam url url required url of the site. Example: https://www.google.com/
     * @bodyParam name string required name of the site. Example: News-Report
     * @bodyParam crawl string required Crawl Status of Site. Example: active|inactive
     * @bodyParam site_color string required This should be hex code of color for site Exp: #000, #ff0000, #d41bd4. Example: #ff0000
     * @bodyParam site_type string required define type of site either (rss) or (normal) Exp: rss, normal. Example: normal
     * @bodyParam interval integer required  add crawl interval in minutes
     * @bodyParam depth integer add crawl depth 1 (Glance), 2 (Moderate), 3 (Deep). Example: 2
     * @bodyParam site_selector string define selector type Exp: class, id, tag. Example: tag
     * @bodyParam selector_value string define selector value which site use to contain their posts. Example: article
     * @bodyParam categories[0][category_id] array Associate any category to site by category_id. Example: 1
     * @bodyParam categories[1][category_id] array Associate any category to site by category_id. Example: 2
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        $validator = Validator::make($request->all(), [
            'url' => 'required|url|unique:tbl_sites',
            'name' => 'required|unique:tbl_sites',
            'crawl' => 'required',
            'interval' => 'required|integer',
            'site_color' => 'required|color_hex',
            'depth' => 'integer|between:1,3',
            'site_type' => 'required|in:rss,normal',
            'site_selector' => 'string|in:class,id,tag',
            'categories' => 'array'
        ]);

        if($validator->fails())
        {
            return response()->json(['errors' => $validator->errors()->first()], 422);
        }
        else{
            $site = new Site();
            $insertQuery = $site::create([
                'url' => $request->url,
                'name' => $request->name,
                'crawl' => $request->crawl,
                'depth' => ($request->depth != ''? $request->depth: 1),
                'interval' => $request->interval,
                'site_color' => $request->site_color,
                'site_type' => $request->site_type,
                'site_selector' => ($request->site_selector != ''? $request->site_selector: null),
                'selector_value' => $request->selector_value,
                'external' => 1
            ]);
            
            if($request->categories && is_array($request->categories)){
                if(count($request->categories) > 0){
                    $insertQuery->site_categories()->createMany($request->categories);
                }
            }
            
            return response()->json([
                'message' => 'Site insert successfully',
                'data' => $insertQuery
            ]);
        }
    }

    /**
     * update Site
     * 
     * This endpoint use to update a Site
     * 
     * @group Site
     * 
     * @bodyParam url url required url of the site. Example: https://www.google.com/
     * @bodyParam name string required name of the site. Example: News-Report
     * @bodyParam crawl string required Crawl Status of Site. Example: active|inactive
     * @bodyParam site_color string required This should be hex code of color for site Exp: #000, #ff0000, #d41bd4. Example: #ff0000
     * @bodyParam site_type string required define type of site either (rss) or (normal) Exp: rss, normal. Example: normal
     * @bodyParam interval integer required  add crawl interval in minutes
     * @bodyParam depth integer add crawl depth 1 (Glance), 2 (Moderate), 3 (Deep). Example: 2
     * @bodyParam site_selector string define selector type Exp: class, id, tag. Example: tag
     * @bodyParam selector_value string define selector value which site use to contain their posts. Example: article
     * @bodyParam categories[0][category_id] array Associate any category to site by category_id. Example: 1
     * @bodyParam categories[1][category_id] array Associate any category to site by category_id. Example: 2
     * 
     */
    public function update(Request $request, Site $site)
    { 
        $validator = Validator::make($request->all(), [
            'url' => 'required|url|unique:tbl_sites,url,'.$site->id,
            'name' => 'required|unique:tbl_sites,name,'.$site->id,
            'crawl' => 'required',
            'depth' => 'integer|between:1,3',
            'interval' => 'required|integer',
            'site_color' => 'required|color_hex',
            'site_type' => 'required|in:rss,normal',
            'site_selector' => 'string|in:class,id,tag',
            'categories' => 'array'
        ]);
        if($validator->fails())
        {
            return response()->json(['errors' => $validator->errors()->first()], 422);
        }
        else{
            $updateQuery = $site->update($request->all());
            $categories = $request->categories;
            $site->site_categories()->delete($site->id);

            if($request->categories && is_array($request->categories)){
                if(count($request->categories) > 0){
                    $site->site_categories()->createMany($request->categories);
                }
            }

            return response()->json([
                'message' => 'Site '.$site->id.' updated successfully',
            ]);
        }  
    }

    /**
     * Delete Event
     * 
     * Use this api to Delete specific Event.
     * @group Site
     * 
     * @urlParam id required The id of the specific Event.
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $topic = Site::findOrFail($id);
            $topic->site_categories()->delete($id);
            $topic->delete($id);

            return response()->json([
                'message' => 'Event '.$topic->id.' deleted successfully',
             ]);
        }catch (\Exception $e){
            return response()->json(['error' => 'Bad Request'], 400);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use DB;
use Illuminate\Contracts\Validation\ValidationException;
use App\Models\TblTopic as Topic;
use App\Models\TblCrawlJob as CrawlJob;




class EventController extends Controller
{
    /**
     * Fetch Events
     * 
     * This endpoint retrieves all events along with categories
     *
     * @group Event
     * 
     * @queryParam id Specific event you want to retrieve by id. No-example
     * @queryParam name Search by event name No-example
     * @queryParam total Number of events you want to retrieve. Defaults to 20. Example: 2
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { 
        $total = ($request->total? $request->total: 20); //default 20

        $query = Topic::with('categories');

        if($request->id)
            $query->where('tbl_topics.id', $request->id);
        
        if($request->name)
            $query->where('tbl_topics.name','like', '%'.$request->name.'%');
        
        return $result = response()->json(['data' => $query->limit($total)->get()]);
    }

    /**
     * Add Event
     * 
     * This endpoint use to create an event
     * 
     * @group Event
     * 
     * @bodyParam name string required name of the event. Example: News-Report
     * @bodyParam keywords string required You can add multiple keywords comma (,) seperated. Example: dubai-traffic, dubai-airport
     * @bodyParam google_keywords string You can add multiple keywords comma (,) seperated. Example: crime, politics
     * @bodyParam categories[0][category_id] array Associate any category to event by category_id. Example: 1
     * @bodyParam categories[1][category_id] array Associate any category to event by category_id. Example: 2
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:tbl_topics',
            'match_condition' => 'required',
            'crawl_type' => 'required',
            'id' => 'required'
        ]);

        if($validator->fails())
        {
            return response()->json(['errors' => $validator->errors()->first()], 422);
        }
        else{
            $topic = new Topic();
            $insertQuery = $topic::create([
                'name' => $request->name,
                'match_condition' => $request->match_condition,
                'crawl_type' => $request->crawl_type,
                'google_keywords' => ($request->google_keywords ? $request->google_keywords: ''),
                'external'  =>  $request->id
            ]);
            
            if($request->categories)
                $insertQuery->topic_categories()->createMany($request->categories);
            
            return response()->json([
                'message' => 'Event insert successfully',
                'data' => $insertQuery
            ]);
        }
    }

    /**
     * Update Event
     * 
     * This endpoint use to update an event
     * 
     * @group Event
     * 
     * @bodyParam name string required name of the event. Example: News-Report
     * @bodyParam keywords string required You can add multiple keywords comma (,) seperated. Example: dubai-traffic, dubai-airport
     * @bodyParam google_keywords string You can add multiple keywords comma (,) seperated. Example: crime, politics
     * @bodyParam categories[0][category_id] array Associate any category to event by category_id. Example: 1
     * @bodyParam categories[1][category_id] array Associate any category to event by category_id. Example: 2
     * 
     */
    public function update(Request $request, Topic $event)
    {  
        if(!$request->google_keywords){
            $request->google_keywords = '';
        }
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:tbl_topics,name,'.$event->id,
            'match_condition' => 'required',
            'crawl_type' => 'required'
        ]);
        if($validator->fails())
        {
            return response()->json(['errors' => $validator->errors()->first()], 422);
        }
        else{
            $updateQuery = $event->update($request->all());
            $categories = $request->categories;
            $event->topic_categories()->delete($event->id);

            if($request->categories)
                $event->topic_categories()->createMany($categories);

            return response()->json([
                'message' => 'Event '.$event->id.' updated successfully',
            ]);
        }  
    }

    /**
     * Delete Event
     * 
     * Use this api to Delete specific Event.
     * @group Event
     * 
     * @urlParam id required The id of the specific Event.
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $topic = Topic::findOrFail($id);
            $topic->topic_categories()->delete($id);
            $topic->delete($id);

            return response()->json([
                'message' => 'Event '.$topic->id.' deleted successfully',
             ]);
        }catch (\Exception $e){
            return response()->json(['error' => 'Bad Request'], 400);
        }
    }


    /**
     * Immediate Crawl Event
     * 
     * Use this api to perform immediate crawl on event.
     * @group Event
     
     * @param  \Illuminate\Http\Request  $request
     * @bodyParam event_id required The id of the specific Event. Example: 1
     * 
     * @return \Illuminate\Http\Response
     */
    public function crawl_job(Request $request)
    {
        try{
            $event = Topic::with(['departments.topic_sites'])->where('id', $request->event_id)->where('event_lock', '0')->firstOrFail();
        
            $sites = [];
            foreach($event->departments as $key => $department){
                $sites = array_merge($sites, $department->topic_sites->pluck('url')->toArray());
            }
            $sites = array_unique($sites);
            
            if($event){
                if($event->update(['event_lock' => 1])){
                    $event_log = [
                        'topic_id' => $event->id,
                        'status' => 'in_queue',
                        'no_of_sites' => count($sites)
                    ];
                    if($crawlJob = CrawlJob::Create($event_log)){
                        return response()->json([
                            'status' => 'Success',
                            'message' => 'Event crawl started',
                            'data' => $crawlJob
                        ], 200);
                    }
                    else{
                        return response()->json('Error - something went wrong on immediate crawl',302);
                    }
                }else{
                    return response()->json('Event Crawl already in process, wait for sometime',302);
                }
            }else{
                return response()->json('Event not found',302);
            }      
        }catch (\Exception $e){
            return response()->json(['error' => 'Bad Request', 'message' => $e], 400);
        }
    }

    /**
     * Crawl Job Status
     * 
     * Use this api to perform immediate crawl on event.
     * @group Event
     
     * @param  \Illuminate\Http\Request  $request
     * @queryParam id required The id of the specific crawl Job. Example: 1
     * 
     * @return \Illuminate\Http\Response
     */
    public function crawl_status($id){
        $crawl_result = CrawlJob::where('id', $id)->latest()->first();
        return response()->json([
            'data' => $crawl_result
        ], 200);
    }

    /**
     * Crawl Multiple Job Status
     * 
     * Use this api to perform immediate crawl on event.
     * @group Event
     
     * @param  \Illuminate\Http\Request  $request
     * @bodyParam jobs required The jobs of the multiple id in array. Example: [1, 5, 11]
     * 
     * @return \Illuminate\Http\Response
     */
    public function crawl_multiple_status(Request $request){
        
        $crawl_result = CrawlJob::whereIn('id', $request->jobs)->get();
        //dd(DB::getQueryLog()); // Show results of log
        return response()->json([
            'data' => $crawl_result
        ], 200);
    }
}

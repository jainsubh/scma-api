<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Validator;
use App\Models\TblCategory as Category;
use App\Models\TblSiteCategory as SiteCategory;
use App\Models\TblTopicCategory as TopicCategory;

class CategoryController extends Controller
{

    /**
     * Fetch Categories
     * 
     * This endpoint retrieves all Categories
     *
     * @group Category
     * @queryParam id Specific category you want to retrieve. No-example
     * @queryParam name Search by category name No-example
     * @queryParam total Number of categories you want to retrieve. Defaults to 20. Example: 5
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = $request->id;
        $name = $request->name;
        $total = ($request->total? $request->total: 20); //default 20

        $query = Category::select('id','name');
        if($id)
            $query->where('id','=', $id);

        if($name)
            $query->where('name','like', '%'.$name.'%');

        return $result = response()->json(['data' => $query->limit($total)->get()]);
    }

    /**
     * Add Category
     * 
     * This endpoint use to create a category
     * 
     * @group Category
     * 
     * @bodyParam name string required Name of the category. Example: News-Report
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:tbl_categories',
        ]);

        if($validator->fails())
        {
            return response()->json(['errors' => $validator->errors()->first()], 422);
        }
        else{
            $category = Category::create($request->all());
            return response()->json([
                'message' => 'Category insert successfully',
                'data' => $category
            ]);
        }
    }

    /**
     * Update Category 
     * Update the specified Category in storage.
     * Use this api to Update category.
     * 
     * @group Category
     * 
     * @urlParam id int required Id of the category. Example: 2
     * @bodyParam name string Name of the category. Example: News-Report
     * 
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {  
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:tbl_categories,name,'.$category->id
        ]);

        if($validator->fails())
        {
            return response()->json(['errors' => $validator->errors()->first()], 422);
        }
        else{
            $category->update($request->all());
            
            return response()->json([
                'message' => 'Category updated successfully',
                'data' => $category,
            ]);
        }  
    }

    /**
     * Delete Category
     * 
     * Use this api to Delete specific category.
     * @group Category
     * 
     * @urlParam id required The id of the specific Category.
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $category = category::findOrFail($id);
            $category->delete();

            return response()->json([
                'message' => 'Category deleted successfully',
                'data' => $category,
             ]);
        }catch (\Exception $e){
            return response()->json(['error' => 'Bad Request'], 400);
        }
    }

    /**
     * Move Catgory Data
     * 
     * Use this api to re-assign any other category to events and sites
     * 
     * @group Category
     * 
     * @bodyParam old_department_id int required Id of category you want to replace. Example: 3
     * @bodyParam department_id int required Id of category you want data to move in. Example: 2
     * 
     * @return \Illuminate\Http\Response
     */
    public function changeCategory(Request $request)
    {
        try{
            $topicCategories = TopicCategory::where('category_id', $request->old_department_id)->get();
                
            if($topicCategories)
            foreach($topicCategories as $topicCategory){
                if(!TopicCategory::where([
                    ['category_id', $request->department_id],
                    ['topic_id', $topicCategory->topic_id],
                ])->exists()){
                    echo 'Record update for Category ID -> '.$request->department_id.' and topic id ->'.$topicCategory->topic_id.'<br />';
                    TopicCategory::where([
                        ['category_id', $request->old_department_id],
                        ['topic_id', $topicCategory->topic_id]
                    ])->update(['category_id' => $request->department_id]);
                }else{
                    echo 'Data exists for Category ID -> '.$request->department_id.' and topic id ->'.$topicCategory->topic_id.'<br />';
                    TopicCategory::where([
                        ['category_id', $request->old_department_id],
                        ['topic_id', $topicCategory->topic_id]
                    ])->delete();
                }
            }

            $siteCategories = SiteCategory::where('category_id', $request->old_department_id)->get();
                
            if($siteCategories)
            foreach($siteCategories as $siteCategory){
                if(!SiteCategory::where([
                    ['category_id', $request->department_id],
                    ['site_id', $siteCategory->site_id],
                ])->exists()){
                    echo 'Record update for Department ID -> '.$request->department_id.' and event id ->'.$siteCategory->site_id.'<br />';
                    SiteCategory::where([
                        ['category_id', $request->old_department_id],
                        ['site_id', $siteDepartment->site_id]
                    ])->update(['category_id' => $request->department_id]);
                }else{
                    echo 'Data exists for Department ID -> '.$request->department_id.' and event id ->'.$siteCategory->site_id.'<br />';
                    SiteCategory::where([
                        ['category_id', $request->old_department_id],
                        ['site_id', $siteCategory->site_id]
                    ])->delete();
                }
            }

            return response()->json([
                'message' => 'Categories reassign successfully',
            ]);
        }catch (\Exception $e){
            return response()->json(['error' => 'Bad Request'], 400);
        }
    }
}
<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\qna_topic;
use App\Models\qna_post;
class QnAController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function topiclist()
    {

        $topics = qna_topic::all();
        return $topics;
    }
    public function postlist()
    {

        $posts = qna_post::all();
        return $posts;
    }
 
    public function newtopic(Request $request)
    {
        $request->validate([
    
            'topic_title'=>'required',
    
            'topic_description'=>'required',
    
            'user_id'=>'required',
    
            
    
              ]);
    
        
    
              return  qna_topic::create($request->all());
    }
    public function newpost(Request $request)
    {
        $request->validate([
    
            'topic_id'=>'required',
    
            'user_id'=>'required',
    
            'post_text'=>'required',
    
            
    
              ]);
        
    
              return  qna_post::create($request->all());
    }

    public function topic_posts($id){
        $topic = qna_topic::where('id', $id)->firstOrFail();
    
    
    
            $topic_post = $topic->qna_posts;
    
         
    
            return response()->json($topic_post, 200, [], JSON_PRETTY_PRINT);
    }


    public function destroy_post($qna_post)
    {
        $qna_posts=qna_post::destroy($qna_post);
    
        return response()->json($qna_posts,204);
    
    }

    public function destroy_topic($qna_topic)
{
    $qna_topics=qna_topic::destroy($qna_topic);

    return response()->json($qna_topics,204);

}
public function update_post(Request $request, $qna_post)
{
      
    $qna_posts= qna_post::find($qna_post);
        $qna_posts->update($request->all());
        return  $qna_posts;
}

public function update_topic(Request $request, $qna_topic)
{
      
    $qna_topics= qna_topic::find($qna_topic);
        $qna_topics->update($request->all());
        return  $qna_topics;
}


public function topic_search(Request $request, $topic_title)
{
    $result = qna_topic::where('topic_title', 'LIKE', '%'. $topic_title. '%')->get();
    if(count($result)){
     return Response()->json($result);
    }
    else
    {
    return response()->json(['Result' => 'No topics found'], 404);
  }
}
}
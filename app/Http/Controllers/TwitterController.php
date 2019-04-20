<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repo\TwitterRepo;
use App\User;
use Illuminate\Support\Facades\Auth;

class TwitterController extends Controller
{   
    /**
     * Create new object from twitter class
     * 
     */
    
    public function __construct()
    {
        $this->twitter = new TwitterRepo();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function search(Request $request){
        if (Auth::check()) {
            try {
                $data = $this->twitter->search($request);
                return $this->sendResponse($data['result'], 'Search Results');
            } catch (\Exception $e) {
                return $this->sendError('Server Error.', $e->getMessage());
            }  
                return $this->sendError('Unauthenticated', "",401); 
        }  
    }

    public function follow(Request $request){
           if (Auth::check()) {
                try {
                    $data = $this->twitter->follow($request);
                    return $this->sendResponse($data['result'], $data['message'],$data['responseCode']);
                } catch (\Exception $e) {
                    return $this->sendError('Server Error.', $e->getMessage(),500);
                }  
                 return $this->sendError('Unauthenticated', "",401); 
            } 
    }

    public function tweet(Request $request){
        if (Auth::check()) {
            try {
                $data = $this->twitter->tweet($request);
                return $this->sendResponse($data['result'], $data['message'],$data['responseCode']);
            } catch (\Exception $e) {
                return $this->sendError('Server Error.', $e->getMessage(),500);
            }  
                return $this->sendError('Unauthenticated', "",401); 
        } 
    }
    public function likeTweet(Request $request){
      if (Auth::check()) {
            try {
                $data = $this->twitter->likeTweet($request);
                return $this->sendResponse($data['result'], $data['message'],$data['responseCode']);
            } catch (\Exception $e) {
               return $this->sendError('Server Error.', $e->getMessage(),500);
            }  
               return $this->sendError('Unauthenticated', "",401); 
        } 
    }
    public function deleteTweet(Request $request){
        if (Auth::check()) {
            try {
                $data = $this->twitter->deleteTweet($request);
                return $this->sendResponse($data['result'], $data['message'],$data['responseCode']);
            } catch (\Exception $e) {
               return $this->sendError('Server Error.', $e->getMessage(),500);
            }  
               return $this->sendError('Unauthenticated', "",401); 
        }    
    }
    public function mention(Request $request){
        if (Auth::check()) {
            try {
                $data = $this->twitter->mention($request);
                return $this->sendResponse($data['result'], $data['message'],$data['responseCode']);
            } catch (\Exception $e) {
               return $this->sendError('Server Error.', $e->getMessage(),500);
            }  
               return $this->sendError('Unauthenticated', "",401); 
        } 
    }
    public function newsFeeds(Request $request){
        if (Auth::check()) {
            try {
                $data = $this->twitter->newsFeeds($request);
                return $this->sendResponse($data['result'], $data['message'],$data['responseCode']);
            } catch (\Exception $e) {
               return $this->sendError('Server Error.', $e->getMessage(),500);
            }  
               return $this->sendError('Unauthenticated', "",401); 
        } 
    }
    public function activityFeeds(Request $request){
        if (Auth::check()) {
            try {
                $data = $this->twitter->activityFeeds($request);
                return $this->sendResponse($data['result'], $data['message'],$data['responseCode']);
            } catch (\Exception $e) {
               return $this->sendError('Server Error.', $e->getMessage(),500);
            }  
               return $this->sendError('Unauthenticated', "",401); 
        } 
    }
}

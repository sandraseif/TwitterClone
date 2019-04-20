<?php

namespace App\Repo;
use Illuminate\Http\Request;
use App\User;
use App\Followers;
use App\Tweets;
use App\TweetsLikes;
use App\ActivityFeeds;
use App\Mentions;
use Illuminate\Support\Facades\Auth;

class TwitterRepo 
{   
    public function search(Request $request){
         $request->validate([
            'username' => 'required',
        ]);
        $username       =   $request->input('username');
        $userSearch     =   User::query()
                            ->where('name', 'LIKE', "%{$username}%") 
                            ->get();  
        foreach ($userSearch as $user => $userInfo) {
            $data['result']['users'][$user]['name']   =   $userInfo->name; 
            $data['result']['users'][$user]['id']     =   $userInfo->id;
        }
        $data['result']['searchName']   =   $username; 
        $data['message']                =  "Search results.";
        $data['responseCode']           =  200;
    
        return $data;   
    }
    public function follow(Request $request){
        $request->validate([
            'userID' => 'required',
        ]);
        $followerID         =   $request->user()->id;
        $userID             =   $request->input('userID');
        if($followerID == $userID){
            $data['result']         = [];
            $data['message']        =  "You can not follow your account.";
            $data['responseCode']   =  200;
        }else{
            $followedUser       = User::where('id',$userID)->first();
            if(empty($followedUser)){
                $data['result']         = [];
                $data['message']        =  "User not found";
                $data['responseCode']   =  404;
            }else{
                $alreadyFollowed    =   Followers::query()
                                                            ->where('userID', '=', $userID ) 
                                                            ->where('followerID','=',$followerID)
                                                            ->first(); 
                if(!empty($alreadyFollowed)){
                    $id = $alreadyFollowed->id;
                    $data['result']         = Followers::where('id',$id)->delete();
                    $data['message']        =  "You have unfollowed this user.";
                    $data['responseCode']   =  200;
                }else{
                    $follow             =   new Followers;
                    $follow->followerID =   $followerID;
                    $follow->userID     =   $userID;
            
                    if($follow->save()){
                        $data['result']         =   $follow;
                        $data['message']        =  "Success.";
                        $data['responseCode']   =   200;
                    }else{
                        $data['result']         =   [];
                        $data['message']        =  "Error following this user.";
                        $data['responseCode']   =   500;
                    }                   
                }
            }  
        }  
        return $data;                         
    }
    public function tweet(Request $request){
        $request->validate([
            'tweet' => 'required',
        ]);
        $userID            =   $request->user()->id;         
        $tweet             =   new Tweets;
        $tweet->tweet      =   $request->input('tweet');
        $tweet->userID     =   $userID;
        
        if($tweet->save()){
            $activity               = new ActivityFeeds();
            $activity->userID       = $userID;
            $activity->followingID  = 0;
            $activity->tweetID      = $tweet->id;
            $activity->activity     = 'tweeted';
            $activity->save();
            $data['result']         =   $tweet;
            $data['message']        =  "Success.";
            $data['responseCode']   =   200;
        }else{
            $data['result']         =   [];
            $data['message']        =  "Error creating tweet.";
            $data['responseCode']   =   500;
        }     
        
        return $data;
    }
    public function likeTweet(Request $request){
        //validating the request; tweet ID is required
        $request->validate([
            'tweetID' => 'required',
        ]);
        //another way to get current user using user token
        $currToken  =   $request->bearerToken();
        $tweetID    =   $request->input('tweetID');
        $currUser   =   User::query()
                        ->where('api_token', 'Like', $currToken ) 
                        ->first();
        $userID     =   $currUser->id;  
        $tweet      =   Tweets::query()
                            ->where('id', '=', $tweetID ) 
                            ->first();
        if(empty($tweet)){
            $data['result']         =   [];
            $data['responseCode']   =   404;
            $data['message']        =   "This tweet doesn't exist.";  
        }else{
            $alreadyLiked           =   TweetsLikes::query()
                                        ->where('userID', '=', $userID ) 
                                        ->where('tweetID','=',$tweetID)
                                        ->first();   
            if(!empty($alreadyLiked)){
                $id                     = $alreadyLiked->id;
                $data['result']         = TweetsLikes::where('id',$id)->delete();
                $data['responseCode']   = 200;
                $data['message']        = "You are have unliked this tweet.";
            }else{
                $likeTweet           =   new TweetsLikes;
                $likeTweet->tweetID  =   $tweetID;
                $likeTweet->userID   =   $userID;
                if($likeTweet->save()){
                    $tweetUserID            =  $tweet->userID;
                    $activity               = new ActivityFeeds();
                    $activity->userID       = $userID;
                    $activity->followingID  = $tweetUserID;
                    $activity->tweetID      = $tweetID;
                    $activity->activity     = 'like';
                    $activity->save();
                    $data['result']        =   $likeTweet;
                    $data['responseCode']  =   200;
                    $data['message']       =   "Success";
                }else{
                    $data['result']        =   [];
                    $data['responseCode']  =   500;
                    $data['message']       =   "Internal server error";
                } 
            }
        }
        return $data;                                            
    }
    public function deleteTweet(Request $request){
         //validating the request; tweet ID is required
        $request->validate([
            'tweetID' => 'required',
        ]);
        $currToken  =   $request->bearerToken();
        $currUser   =   User::query()
                        ->where('api_token', 'Like', $currToken ) 
                        ->first();
        $tweetID    =   $request->input('tweetID');                
        $userID     =   $currUser->id;  
        $tweet      =   Tweets::query()
                        ->where('userID', '=', $userID )
                        ->where('id', '=', $tweetID )  
                        ->first(); 
        if($tweet){
            $tweet->delete();
            $data['result']         =   [];
            $data['responseCode']   =   200;
            $data['message']        =   "Success";
        }else{
            $data['result']         =   [];
            $data['responseCode']   =   200;
            $data['message']        =   "You can not delete tweet not yours";
        }                  
                       
       return $data; 
    }
    public function mention(Request $request){
         $request->validate([
            'tweetID' => 'required',
            'username' => 'required',
        ]);
        $userID    =   $request->user()->id;  
        $username  =   $request->input('username');
        $tweetID   =   $request->input('tweetID'); 
        $tweet     =   Tweets::query()
                            ->where('id', '=', $tweetID ) 
                            ->first();
        if(empty($tweet)){
            $data['result']         =   [];
            $data['responseCode']   =   404;
            $data['message']        =   "This tweet doesn't exist";  
        }else{
            $mentionedUser      =   User::query()
                                    ->where('name', 'LIKE', "$username") 
                                    ->first();                     
            if(empty($mentionedUser)){
                $data['result']         =   [];
                $data['responseCode']   =   404;
                $data['message']        =   "User not found.";   
            }else{
                $mentionedUserID    =   $mentionedUser->id;  
                if($mentionedUserID == $userID){
                    $data['result']         =   [];
                    $data['responseCode']   =   200;
                    $data['message']        =   "You can not mention yourself";  
                }else{
                    $isFollowing    =   Followers::where('userID','=',$mentionedUserID)
                                                    ->where('followerID','=',$userID)
                                                    ->first(); 
                    if(empty($isFollowing)){
                        $data['result']         =   [];
                        $data['responseCode']   =   200;
                        $data['message']        =   "You are not following this user.";    
                    }else{
                        $mentionExist           =   Mentions::where('userID','=',$userID)
                                                    ->where('mentionedUserID','=',$mentionedUserID)
                                                    ->where('tweetID','=',$tweetID)
                                                    ->first(); 
                        if(!empty($mentionExist)){
                            $data['result']         =   [];
                            $data['responseCode']   =   200;
                            $data['message']        =   "You mentioned this username before in this tweet.";   
                        }else{
                            $mention                    = new Mentions();
                            $mention->userID            = $userID;
                            $mention->mentionedUserID   = $mentionedUserID;
                            $mention->tweetID           = $tweetID;
                            if($mention->save()){
                                $activity               = new ActivityFeeds();
                                $activity->userID       = $userID;
                                $activity->followingID  = $mentionedUserID;
                                $activity->tweetID      = $tweetID;
                                $activity->activity     = 'mention';
                                $activity->save();
                                $data['result']         =  $mention;
                                $data['responseCode']   =  200;
                                $data['message']        =  "Success";
                            }else{
                                $data['result']        =  [];
                                $data['responseCode']  =  500;
                                $data['message']       =  "Internal server error";
                            }    
                        } 
                    }                                                    
                }
            }                      
        }                                                                                               
        return $data;
    }
    public function newsFeeds(Request $request){
        $currToken  =   $request->bearerToken();
        $currUser   =   User::query()
                        ->where('api_token', 'Like', $currToken ) 
                        ->first();
        $userID           =   $currUser->id;
        $followersTweets  =   Tweets::select('tweets.tweet','users.name','users.id')
                                ->join('users', 'users.id', '=', 'tweets.userID')
                                ->join('followers', 'followers.userID', '=', 'tweets.userID')
                                ->where('followers.followerID','=',$userID)
                                ->get(); 
        $myTweets         =   Tweets::select('tweets.tweet','users.name','users.id')
                                ->join('users', 'users.id', '=', 'tweets.userID')
                                ->where('tweets.userID','=',$userID)
                                ->get(); 
        $result                 = array_merge($followersTweets->toArray(), $myTweets->toArray()); 
        $data['result']         =   $result;                                              
        $data['responseCode']   =   200;
        $data['message']        =   "Success";                            
        
        return $data;
    }
    public function activityFeeds(Request $request){
        $currToken      =   $request->bearerToken();
        $currUser       =   User::query()
                            ->where('api_token', 'Like', $currToken ) 
                            ->first();
        $userID         =   $currUser->id;
        $activityFeeds  =   ActivityFeeds::select('activity_feeds.userID AS userFollowedByMe',
                                                   'activity_feeds.followingID AS userFollowedByUserFollowedByMe',
                                                   'tweets.tweet','activity_feeds.activity')
                                ->join('followers', 'followers.userID', '=', 'activity_feeds.userID')
                                ->join('tweets', 'activity_feeds.tweetID', '=', 'tweets.id')
                                ->where('followers.followerID','=',$userID)
                                ->get(); 
        $data['result']         =   $activityFeeds;
        $data['responseCode']   =   200;
        $data['message']        =   "Success";                            
        
        return $data;
    }
}

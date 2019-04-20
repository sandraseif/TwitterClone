<?php
namespace Tests\Feature;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Tweets;

class BasicTest extends TestCase
{
    public function testTweets()
    {
        $tweet = new Tweets();
        $tweet->userID  =   "10";
        $tweet->tweet   =   "testing";
        $this->assertTrue();
        $this->assertFalse();
    }

}
?>
<?php

namespace App\Http\Controllers;

// i have added
use App\Models\User;
use App\Models\Phone;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Mechanic;
use App\Models\Project;
use App\Models\Role;
use DB;

use Illuminate\Http\Request;

class TestController extends Controller
{
    //

    public function test()
    {

        # one to one relations, table used users, phones

        //$users_with_phone_relations = User::with('phone')->get();
        // foreach($users_with_phone_relations as $v) {

        //     echo $v->name."<br>";
        //     echo (isset($v->phone->phone))?$v->phone->phone:"";
        //     echo "<br>";

        // }

        //dd($users_with_phone_relations);

        //$phone = User::find(1)->phone;

        //dd($phone);

        //$user_with_phone = Phone::find(1)->with('user')->first();

        //echo $user_with_phone->user->name;

        //$user = Phone::find(1)->user();

        //dd($user);


        # one to many table used posts, comments
        // $comments = Post::find(1)->comments;

        // foreach ($comments as $comment) {
        //     //
        // }

        // dd($comments);

        // $comment = Post::find(1)->comments
        //     ->where('title', 'comment one')
        //     ->first();

        // dd($comment);

        // equal results as top one

        // $comment = Post::find(1)->comments()
        //     ->where('title', 'comment one')
        //     ->first();

        // dd($comment);


        // $post_comments = Post::find(1)->where('title', 'post one')->with('comments')
        //     ->first();

        // dd($post_comments);

        //$comment = Comment::find(1);
        //echo $comment->post->title;

        //$comment = Comment::find(1)->post;
        //dd($comment);

        //$user = Post::find(4)->user;

        //dd($user);

        #Has One Of Many table used users, orders

        // find latest order of users id 1
        //$latestOrder = User::find(1)->latestOrder;
        //dd($latestOrder);

        // find oldrest order of users id 1
        //$oldestOrder = User::find(1)->oldestOrder;
        //dd($oldestOrder);

        // find largest order by price of users id 1
        //$largestOrder = User::find(1)->largestOrder;
        //dd($largestOrder);

        #Advanced Has One Of Many Relationships,  table used products, prices

        //$productCurrentPrice = Product::find(1)->currentPricing;

        //dd($productCurrentPrice);


        #Has One Through table used mechanics, cars, owners

        //$carOwner = Mechanic::find(1)->carOwner;

        //dd($carOwner);

        #Has Many Through table used, projects, environments, deployments

        //$deployments = Project::find(1)->deployments;

        //dd($deployments);


        #Many To Many Relationships users, roles, role_user

        //$user = User::find(1);

        // foreach ($user->roles as $role) {
        //     //
        // }

        //dd($user);

        //$roles = User::find(1)->roles()->orderBy('name')->get();

        //dd($roles);

        //$role = Role::find(2);

        //dd($role);

        // $users = Role::find(2)->users;

        // dd($users);



        // tested relations

        //$post_user = Post::with(['user','user.roles'])->get();

        // $post_user = Post::with([
        //     'user'=> function ($query) {
        //         $query->where('id','=','1');
        //     },
        //     'user.roles'=> function ($query) {
        //     $query->where('user_id','=','1');
        // }])->get();


        // dd($post_user);


        // fetch user which have posts
        // $user_id = 1;
        // $user_posts = User::whereHas('posts', function ($query) use ($user_id) {

        //     //$query->where('user_id', '=', $user_id);
        // })->orderBy('users.id', 'desc')->get();

        // dd($user_posts);

        // ata je users table er id 1 ache tar data and post relation e user id 1 tar data tulbe
        // $user_id = 1;
        // $user_posts = User::with('posts')->whereHas('posts', function ($query) use ($user_id) {

        //     //$query->where('user_id', '=', $user_id);
        // })->orderBy('users.id', 'desc')->get();

        //dd($user_posts);


        // // ata user table er sob data dakhabe r relation post e post id 1 er data dakhabe
        // $user_id = 1;
        // $user_posts = User::with(['posts'=>function ($query) use ($user_id) {

        //     //$query->where('user_id', '=', $user_id);
        //     $query->where('id', '=', "1");
        // }])->whereHas('posts', function ($query) use ($user_id) {

        //     //$query->where('user_id', '=', $user_id);
        //     //$query->where('id', '=', "1");
        // })->orderBy('users.id', 'desc')->get();


        // dd($user_posts);


        // // ata post table er id 1 je user id ache tar data dakhabe r post relation e post 1 er data dakhabe
        // $user_id = 1;
        // $user_posts = User::with(['posts'=>function ($query) use ($user_id) {

        //     //$query->where('user_id', '=', $user_id);
        //     $query->where('id', '=', "1");
        // }])->whereHas('posts', function ($query) use ($user_id) {

        //     //$query->where('user_id', '=', $user_id);
        //     $query->where('id', '=', "1");
        // })->orderBy('users.id', 'desc')->get();


        // dd($user_posts);


        // ata user table er sei user id tulbe jeta post table er id 2 er shate link user_id r post table er 
        // sob data tulbe jeta user table er id er shate link
        //DB::enableQueryLog(); // Enable query log
        $user_id = 1;
        $user_posts = User::with(['posts'=>function ($query) use ($user_id) {

            //$query->where('user_id', '=', $user_id);
            //$query->where('id', '=', "1");
        }])->whereHas('posts', function ($query) use ($user_id) {

            //$query->where('user_id', '=', $user_id);
            $query->where('posts.id', '=', "2");
        })->orderBy('users.id', 'desc')->get();
        
        //dd(\DB::getQueryLog()); // Show results of log
        
        //dd($user_posts[0]->posts);


    }
}

<?php
namespace App\Views\Composer;

use Illuminate\View\View;
use App\Category;
use App\Post;

class NavigationComposer{
    public function compose(View $view)
    {
        $this->composerCategories($view);

        $this->composerPopularPosts($view);
    }

    private function composerCategories(View $view)
    {
        $categories = Category::with(['posts' => function($query){
            $query->published();
        }])->orderBy('title','asc')->get();
        $view->with('categories',$categories);
    }

    private function composerPopularPosts(View $view)
    {
        $popularPosts = Post::published()->popular()->take(3)->get();
        $view->with('popularPosts',$popularPosts);
    }
}
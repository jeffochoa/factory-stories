## Laravel Model Factory Stories ##
This package allows You to create complex model factories in separated classes reusable among Your tests classes.

inspired by the [Model Factories podcast](http://twentypercent.fm/model-factories) on [twentypercent.fm](http://twentypercent.fm)

## Installing ##

```bash
$ composer require jeffochoa/factory-stories
```

Add the servic provider to the app.php file

```php
FactoryStories\Providers\StoryFactoryServiceProvider::class
```

## The problem ##
Let's say You have to do some tests over articles created with certain conditions like:

```
// Active articles, from Active Users, with tags attached
```

You may end creating something like

```php
$user = factory(User::class)->states('active');
$tags = factory(Taxonomy::class, 3)->states('tag')->create();
$article = factory(Article::class)->create([
    user_id => $user->id
]);
$article->tags()->attach($tags->pluck('id')->toArray());
```

... or something like that.

Of course, You allways can extract this to it's own method in a helper class, but sometimes You may want to have each of this kind of "stories" in it's own class, even  more when you need to add some extra methods to generate more complex data.

## Creating new Factory Stories ##

After install You'll have access to a a new artisan command

```bash
$ php artisan make:factory-story SomeClassName
```

After run this command You should see the new file under the "database/" directory

```php
<?php

use App\Models\User;
use FactoryStories\FactoryStory;

class TestStory extends FactoryStory
{
    public function build($params = [])
    {
        // here you can add your complex model factories with their relationships
        return factory(User::class)->create();
    }

    // and You can add custom methods if You need to
}
```

## Using Factory Stories ##
Consider this UserTestClass.php

```php
<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ManageUsersTest extends TestCase
{
    use DatabaseMigrations;

    /** @test **/
    public function your_test_method()
    {
         //
    }

}
```

You just need to create a new instance of the Story Class and call the create() method on it

```php
<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ManageUsersTest extends TestCase
{
    use DatabaseMigrations;

    /** @test **/
    public function your_test_method()
    {
         $article = (new ActiveUserArticleWithTags)
            ->times(5)->create();
    }
}
```

This will return a collection of 5 items  with the object that You return in the build() method of the custom story class.

Laravel 5.4 includes "Real time facades", this allows you to use the Story Class as a facade as well Just by adding the `use Facades\{YourClassName}` at the top of your file

```php
<?php

namespace Tests\Feature;

use Tests\TestCase;
use Facades\ActiveUserArticleWithTags;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ManageUsersTest extends TestCase
{
    use DatabaseMigrations;

    /** @test **/
    public function your_test_method()
    {
         $article = ActiveUserArticleWithTags::times(5)->create();
    }
}
```

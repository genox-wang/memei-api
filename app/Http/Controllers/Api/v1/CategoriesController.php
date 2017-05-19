<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

use Dingo\Api\Routing\Helpers;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
    use Helpers;

    public function store(Request $r)
    {
        $category = [
            'name' => $r->name,
        ];
        Category::create($category);
    }

    public function index()
    {
        return Category::all();
    }

    public function show($id)
    {
        return Category::findOrFail($id);
    }

    public function update($id,Request $r)
    {
        $new_category = [
            'name' => $r->name,
        ];
        Category::findOrFail($id)->update($new_category);
    }

    public function delete($id)
    {
        Category::findOrFail($id)->delete();
    }

    public function authors($id){
        return Category::findOrFail($id)->authors()->get();
    }

    public function cards($id)
    {
        return DB::select('select a.title,a.id as card_id,b.name,b.id as author_id,c.name,c.id as category_id from cards a, authors b, categories c where a.author_id = b.id and b.category_id = c.id and c.id = ?',[$id]);
    }
}

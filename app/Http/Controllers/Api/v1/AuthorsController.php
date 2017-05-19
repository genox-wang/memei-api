<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Author;

class AuthorsController extends Controller
{
    public function store(Request $r)
    {
        $author = [
            'name' => $r->name,
            'category_id' => $r->category_id,
            'avatar' => $r->avatar,
        ];
        Author::create($author);
    }

    public function index()
    {
        return Author::all();
    }

    public function show($id)
    {
        return Author::findOrFail($id);
    }

    public function update($id, Request $r)
    {
        $new_author = [
            'name' => $r->name,
            'category_id' => $r->category_id,
            'avatar' => $r->avatar,
        ];
        Author::findOrFail($id)->update($new_author);
    }

    public function delete($id)
    {
        Author::findOrFail($id)->delete();
    }

    public function cards($id)
    {
        return Author::findOrFail($id)->cards()->get();
    }
}

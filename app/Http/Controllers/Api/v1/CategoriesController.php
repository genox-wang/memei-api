<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
    /**
     * @apiDefine 200Success
     *
     * @apiSuccessExample {json} Success-Response:
     * HTTP/1.1 200 OK
     */

    /**
     * @api {post} /categories/ Store
     * @apiGroup Categories
     *
     * @apiParam {String} name Name for category
     *
     * @apiUse 200Success
     */
    public function store(Request $r)
    {
        $category = [
            'name' => $r->name,
        ];
        Category::create($category);
    }

    /**
     * @api {get} /categories/ Index
     * @apiGroup Categories
     *
     * @apiSuccess (200) {Object[]} categories List for categories
     * @apiSuccess (200) {Number} categories.id Id for category
     * @apiSuccess (200) {String} categories.name Name for category
     */
    public function index()
    {
        return Category::all();
    }

    /**
     * @api {get} /categories/:id Show
     * @apiGroup Categories
     *
     * @apiSuccess (200) {Object} category Information for category
     * @apiSuccess (200) {Number} category.id Id for category
     * @apiSuccess (200) {String} category.name Name for category
     */
    public function show($id)
    {
        return Category::findOrFail($id);
    }

    /**
     * @api {put} /categories/ Update
     * @apiGroup Categories
     *
     * @apiParam {String} name Name for category
     *
     * @apiUse 200Success
     */
    public function update($id,Request $r)
    {
        $new_category = [
            'name' => $r->name,
        ];
        Category::findOrFail($id)->update($new_category);
    }

    /**
     * @api {delete} /categories/:id Delete
     * @apiGroup Categories
     *
     * @apiUse 200Success
     */
    public function delete($id)
    {
        Category::destroy($id);
    }

    /**
     * @api {get} /categories/:id/authors Authors
     * @apiGroup Categories
     *
     * @apiSuccess (200) {Object[]} authors List for authors
     * @apiSuccess (200) {Number}   authors.id Id for author
     * @apiSuccess (200) {String}   authors.name Name for author
     * @apiSuccess (200) {String}   authors.avatar Avatar key for author
     */
    public function authors($id){
        return Category::findOrFail($id)->authors()->get();
    }

    /**
     * @api {get} /categories/:id/catds Cards
     * @apiGroup Categories
     *
     * @apiSuccessExample {json} Success-Response:
     * HTTP/1.1 200 OK
     * [
     *  {
     *    "title": "Ottilie Hahn DVM",
     *    "card_id": 5,
     *    "name": "Prof. Savannah Marks IV",
     *    "author_id": 18,
     *    "category_id": 2
     *  },
     * ]
     */
    public function cards($id)
    {
        return DB::select('select a.title,a.id as card_id,b.name,b.id as author_id,c.name,c.id as category_id from cards a, authors b, categories c where a.author_id = b.id and b.category_id = c.id and c.id = ?',[$id]);
    }
}

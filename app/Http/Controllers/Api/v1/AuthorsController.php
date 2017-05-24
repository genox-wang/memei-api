<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Author;

class AuthorsController extends Controller
{

    /**
     * @apiDefine 200Success
     *
     * @apiSuccessExample {json} Success-Response:
     * HTTP/1.1 200 OK
     */

    /**
     * @api {post} /authors/ Store
     * @apiGroup Authors
     *
     * @apiParam {String} name Author's name
     * @apiParam {Number} category_id Id for author's category
     * @apiParam {String} avatar Image key for avatar
     *
     * @apiUse 200Success
     */
    public function store(Request $r)
    {
        $author = [
            'name' => $r->name,
            'category_id' => $r->category_id,
            'avatar' => $r->avatar,
        ];
        Author::create($author);
    }

    /**
     * @api {get} /authors/ Index
     * @apiGroup Authors
     *
     * @apiSuccess (200) {Object[]} authors List of authors
     * @apiSuccess (200) {Number} authors.id Id of author
     * @apiSuccess (200) {Number} authors.category_id Id of author's category
     * @apiSuccess (200) {String} authors.name Name of author
     * @apiSuccess (200) {String} authors.avatar Image key of author
     */
    public function index()
    {
        return Author::all();
    }

    /**
     * @api {get} /authors/:id Show
     * @apiGroup Authors
     *
     * @apiSuccess (200) {Object} author Author information
     * @apiSuccess (200) {Number} author.id Id of author
     * @apiSuccess (200) {Number} author.category_id Id of author's category
     * @apiSuccess (200) {String} author.name Name of author
     * @apiSuccess (200) {String} author.avatar Image key of author
     *
     * @apiErrorExample {json} Error-Response:
     * HTTP/1.1 500 Internal Server Error
     * {
     *   "message": "No query results for model [App\\Models\\Author] 1",
     *   "status_code": 500,
     * }
     */
    public function show($id)
    {
        return Author::findOrFail($id);
    }

    /**
     * @api {put} /authors/:id Update
     * @apiGroup Authors
     *
     * @apiParam {String} name Author's name
     * @apiParam {Number} category_id Id for author's category
     * @apiParam {String} avatar Image key for avatar
     *
     * @apiUse 200Success
     */
    public function update($id, Request $r)
    {
        $new_author = [
            'name' => $r->name,
            'category_id' => $r->category_id,
            'avatar' => $r->avatar,
        ];
        Author::findOrFail($id)->update($new_author);
    }

    /**
     * @api {delete} /authors/:id Delete
     * @apiGroup Authors
     *
     * @apiUse 200Success
     */
    public function delete($id)
    {
        Author::destroy($id);
    }

    /**
     * @api {get} /authors/:id/cards Cards
     * @apiGroup Authors
     *
     * @apiSuccess (200) {Object[]} cards List of cards
     * @apiSuccess (200) {Number} cards.id Id of cards
     * @apiSuccess (200) {Number} cards.author_id Id of card's author
     * @apiSuccess (200) {String} cards.title Title of card
     * @apiSuccess (200) {Number} cards.favorite Favorite count of card
     * @apiSuccess (200) {Number} cards.created_at Create time of card
     * @apiSuccess (200) {Number} cards.updated_at Update time of of card
     */
    public function cards($id)
    {
        return Author::findOrFail($id)->cards()->get();
    }
}

<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Card;

class CardsController extends Controller
{
    /**
     * @apiDefine 200Success
     *
     * @apiSuccessExample {json} Success-Response:
     * HTTP/1.1 200 OK
     */

    /**
     * @api {post} /cards/ Store
     * @apiGroup Cards
     *
     * @apiParam {String} title Card Title
     * @apiParam {Number} author_id Id for card's author
     * @apiParam {Number} favorite Favorite count of card
     *
     * @apiUse 200Success
     */
    public function store(Request $r)
    {
        $card = [
            'title' => $r->title,
            'author_id' => $r->author_id,
            'favorite' => $r->favorite,
        ];
        Card::create($card);
    }

    /**
     * @api {get} /cards/
     *   Index
     * @apiGroup Cards
     *
     * @apiSuccess (200) {Object[]} cards List of cards
     * @apiSuccess (200) {Number} cards.id Id of cards
     * @apiSuccess (200) {Number} cards.author_id Id of card's author
     * @apiSuccess (200) {String} cards.title Title of card
     * @apiSuccess (200) {Number} cards.favorite Favorite count of card
     * @apiSuccess (200) {Number} cards.created_at Create time of card
     * @apiSuccess (200) {Number} cards.updated_at Update time of of card
     */
    public function index()
    {
        return Card::all();
    }

    /**
     * @api {get} /cards/  Show
     * @apiGroup Cards
     *
     * @apiSuccess (200) {Object} card Information of card
     * @apiSuccess (200) {Number} card.id Id of card
     * @apiSuccess (200) {Number} card.author_id Id of author
     * @apiSuccess (200) {String} card.title Title of card
     * @apiSuccess (200) {Number} card.favorite Favorite count of card
     * @apiSuccess (200) {Number} card.created_at Create time of card
     * @apiSuccess (200) {Number} card.updated_at Update time of of card
     */
    public function show($id)
    {
        return Card::findOrFail($id);
    }

    /**
     * @api {put} /cards/:id Update
     * @apiGroup Cards
     *
     * @apiParam {String} title Card Title
     * @apiParam {Number} author_id Id for card's author
     * @apiParam {Number} favorite Favorite count of card
     *
     * @apiUse 200Success
     */
    public function update($id, Request $r)
    {
        $new_card = [
            'title' => $r->title,
            'author_id' => $r->author_id,
            'favorite' => $r->favorite,
        ];
        Card::findOrFail($id)->update($new_card);
    }


    /**
     * @api {delete} /cards/:id Delete
     * @apiGroup Cards
     *
     * @apiUse 200Success
     */
    public function delete($id)
    {
        Card::destroy($id);
    }

    /**
     * @api {get} /cards/:id/photos Photos
     * @apiGroup Cards
     *
     * @apiSuccess (200) {Object[]} photos Photos for card
     * @apiSuccess (200) {Number} id Id for photo
     * @apiSuccess (200) {Number} card_id for photo's card
     * @apiSuccess (200) {String} key Image key for photo
     *
     */
    public function photos($id)
    {
        return Card::findOrFail($id)->photos()->get();
    }
}

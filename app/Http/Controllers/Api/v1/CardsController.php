<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Card;

class CardsController extends Controller
{
    /**
     * @api {get} /user/:id Request User information
     * @apiName GetUser
     * @apiGroup User
     *
     * @apiParam {Number} id Users unique ID.
     *
     * @apiSuccess {String} firstname Firstname of the User.
     * @apiSuccess {String} lastname  Lastname of the User.
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

    public function index()
    {
        return Card::all();
    }

    public function show($id)
    {
        return Card::findOrFail($id);
    }

    public function update($id, Request $r)
    {
        $new_card = [
            'title' => $r->title,
            'author_id' => $r->author_id,
            'favorite' => $r->favorite,
        ];
        Card::findOrFail($id)->update($new_card);
    }

    public function delete($id)
    {
        return Card::destroy($id);
    }

    public function photos($id)
    {
        return Card::findOrFail($id)->photos()->get();
    }
}

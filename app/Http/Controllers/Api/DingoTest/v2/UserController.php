<?php

namespace App\Http\Controllers\Api\DingoTest\v2;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Dingo\Api\Routing\Helpers;
use App\User;


/**
 * User resource representation.
 *
 * @Resource("Users", uri="/users")
 */
class UserController extends Controller
{
  use Helpers;

/**
 * Show all users
 * Get a JSON representation of all the registered users.
 * @Get("/")
 * @Versions({"v2"})
 * @Transaction({
 *      @Request({"username": "foo", "password": "bar"}),
 *      @Response(200, body={"id": 10, "username": "foo"}),
 *      @Response(422, body={"error": {"username": {"Username is already taken."}}})
 * })
 * @Parameters({
 *      @Parameter("page", description="The page of results to view.", default=1),
 *      @Parameter("limit", description="The amount of results per page.", default=10)
 * })
 */
  public function index() {
    return User::all();
  }

  public function show($id) {
    return User::findOrFail($id);
  }

  public function array() {
    return $this->response->array(User::all()->toArray());
  }

  public function paginate()
  {
    return User::paginate(25);
  }

  public function error404()
  {
    return $this->response->error('This is an error.', 404);
  }

  public function notfound()
  {
    return $this->response->errorNotFound();
  }

  public function badrequest()
  {
    return $this->response->errorBadRequest();
  }

  public function forbidden()
  {
    return $this->response->errorForbidden();
  }

  public function internal()
  {
    return $this->response->errorInternal();
  }

  public function unauthorized()
  {
    return $this->response->errorUnauthorized();
  }

}

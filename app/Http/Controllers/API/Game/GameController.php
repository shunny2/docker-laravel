<?php

namespace App\Http\Controllers\API\Game;

use App\Http\Controllers\Controller;
use App\Http\Requests\Game\StoreGameRequest;
use App\Models\Game;
use Exception;
use Illuminate\Http\Request;

class GameController extends Controller
{
    protected $game;

    public function __construct(Game $game)
    {
        $this->middleware('auth:api');
        $this->game = $game;
    }

    /**
     * @OA\Get(
     *     path="/api/v1/game",
     *     summary="Listing all games",
     *     description="This route is responsible for listing the games.",
     *     tags={"Games"},
     *     security={{ "bearerAuth": {} }},
     *     @OA\Response(
     *         response=200,
     *         description="Ok: Successful Operation",
     *         @OA\JsonContent(
     *              type="array",
     *              @OA\Items(ref="#/components/schemas/Game")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Client Error: Unauthorized"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server Error: Internal Server Error"
     *     )
     * )
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $games = $this->game->paginate(15)->all();

            return response()->json($games);
        } catch (Exception $e) {
            return response($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @OA\Post(
     *     path="/api/v1/game",
     *     summary="Store new game",
     *     description="This route is responsible for storing a new game.",
     *     tags={"Games"},
     *     security={{ "bearerAuth": {} }},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="name",
     *                  type="string"
     *              ),
     *              @OA\Property(
     *                  property="cost",
     *                  type="number"
     *              ),
     *              @OA\Property(
     *                  property="description",
     *                  type="string"
     *              ),
     *              @OA\Examples(
     *                  summary="Game",
     *                  example="GameExample",
     *                  value = {
     *                      "name": "Perfect World",
     *                      "cost": 0,
     *                      "description": "Perfect World is a 3D fantasy adventure MMORPG with traditional Chinese settings."
     *                  }
     *              )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Created: New game created"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Client Error: Bad Request"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Client Error: Unauthorized"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server Error: Internal Server Error"
     *     )
     * )
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGameRequest $request)
    {
        try {
            $data = $request->all();
            $this->game->create($data);

            return response()->json('Successfully registered!', 201);
        } catch (Exception $e) {
            return response($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @OA\Get(
     *     path="/api/v1/game/{id}",
     *     summary="Search for a game by ID",
     *     description="This route is responsible for searching a game by ID.",
     *     tags={"Games"},
     *     security={{ "bearerAuth": {} }},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of game that needs to be fetched",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *             maximum=10000000,
     *             minimum=1
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Ok: Successful Operation",
     *         @OA\JsonContent(
     *              type="object",
     *              ref="#/components/schemas/Game"
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Client Error: Unauthorized"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Client Error: Not found"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server Error: Internal Server Error"
     *     )
     * )
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $game = $this->game->find($id);

            return response()->json($game);
        } catch (Exception $e) {
            return response($e->getMessage());
        }
    }

    /**
     * @OA\Get(
     *     path="/api/v1/game/{id}/edit",
     *     summary="Get a game by ID",
     *     description="Get a game by ID to update the game.",
     *     tags={"Games"},
     *     security={{ "bearerAuth": {} }},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of game that needs to be fetched",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *             maximum=10000000,
     *             minimum=1
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Ok: Successful Operation",
     *         @OA\JsonContent(
     *              type="object",
     *              ref="#/components/schemas/Game"
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Client Error: Unauthorized"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Client Error: Not found"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server Error: Internal Server Error"
     *     )
     * )
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $game = $this->game->find($id);

            return response()->json($game);
        } catch (Exception $e) {
            return response($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @OA\Put(
     *     path="/api/v1/game/{id}",
     *     summary="Update a game",
     *     description="This route is responsible for updating a specific game in storage.",
     *     tags={"Games"},
     *     security={{ "bearerAuth": {} }},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of game that needs to be fetched",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *             maximum=10000000,
     *             minimum=1
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="name",
     *                  type="string"
     *              ),
     *              @OA\Property(
     *                  property="cost",
     *                  type="number"
     *              ),
     *              @OA\Property(
     *                  property="description",
     *                  type="string"
     *              ),
     *              @OA\Examples(
     *                  summary="Game",
     *                  example="GameExample",
     *                  value = {
     *                      "name": "Perfect World Updated",
     *                      "cost": 20,
     *                      "description": "Perfect World Description Updated"
     *                  }
     *              )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Ok: Successful Operation"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Client Error: Unauthorized"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Client Error: Not found"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server Error: Internal Server Error"
     *     )
     * )
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $data = $request->all();
            $game = $this->game->find($id);
            $updated = $game->update($data);

            return response()->json($updated);
        } catch (Exception $e) {
            return response($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @OA\Delete(
     *     path="/api/v1/game/{id}",
     *     summary="Delete a game",
     *     description="This route is responsible for deleting a specific game.",
     *     tags={"Games"},
     *     security={{ "bearerAuth": {} }},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of game that needs to be fetched",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *             maximum=10000000,
     *             minimum=1
     *         )
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Ok: Successful Operation"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Client Error: Unauthorized"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Client Error: Not found"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server Error: Internal Server Error"
     *     )
     * )
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $game = $this->game->find($id);
            $game->delete();

            return response()->json('Successfully deleted!', 204);
        } catch (Exception $e) {
            return response($e->getMessage(), $e->getCode());
        }
    }
}

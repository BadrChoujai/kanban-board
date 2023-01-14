<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Column;
use App\Repositories\Column\ColumnRepository;
use Illuminate\Http\Request;

class ColumnController extends Controller
{
    /**
     * @var ColumnRepository
     */
    private $columnRepository;

    /**
     * Controller constructor
     *
     * @param ColumnRepository $columnRepository
     */
    public function __construct(ColumnRepository $columnRepository)
    {
        $this->columnRepository = $columnRepository;
    }

    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $created_at = $request->created_at;
        $cards_status = $request->cards_status;
        $filters = ['created_at' => $created_at, 'hasCards' => $cards_status];

        $columns = $this->columnRepository->all($filters);

        return response()->json([
            'data' => $columns
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $column = $this->columnRepository->create($request->get('data'));
        $column->cards = [];

        return response()->json($column, 200);
    }

    /**
     * get the column cards.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getCards(Request $request)
    {
        $column = Column::find($request->get('id'));

        return response()->json($column->cards, 200);
    }

    /**
     * store the column cards.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeColumns(Request $request)
    {
        $columns = $request->get('data');
        $allColumns = [];

        foreach ($columns as $column) {
            $col = $this->columnRepository->update($column);
            array_push($allColumns, $col);
        }

        return response()->json($allColumns, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->columnRepository->delete($id);

            return response()->json("Deleted Successfully", 200);
        } catch (\Throwable $th) {
            return response()->json("Error while deleting: $th", 500);
        }
    }
}

<?php

namespace App\Repositories\Column;

use App\Models\Card;
use App\Models\Column;
use Carbon\Carbon;

class EloquentColumn implements ColumnRepository
{
    /**
     * Get all columns
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all($filters = [])
    {
        if ((bool) $filters['hasCards'] === true && $filters['hasCards'] !== 'all') {
            return Column::has('cards')->with('cards')->whereDate('created_at', '=', Carbon::parse($filters['created_at'])->format('Y-m-d'))->get();
        } else if ((bool) $filters['hasCards'] === false && $filters['hasCards'] !== 'all') {
            return Column::doesntHave('cards')->with('cards')->whereDate('created_at', '=', Carbon::parse($filters['created_at'])->format('Y-m-d'))->get();
        }

        return Column::with('cards')->whereDate('created_at', '=', Carbon::parse($filters['created_at'])->format('Y-m-d'))->get();
    }

    /**
     * Find a column by id
     *
     * @param int $id
     * @return \App\Models\Column
     */
    public function find(int $id)
    {
        return Column::with('cards')->find($id);
    }

    /**
     * Create a new column
     *
     * @param array $data
     * @return \App\Models\Column
     */
    public function create(array $data)
    {
        return Column::create($data);
    }

    /**
     * Update a column
     *
     * @param array $data
     * @return \App\Models\Column
     */
    public function update(array $data)
    {
        foreach ($data['cards'] as $card) {
            Card::updateOrCreate(
                ['id' =>  $card['id']],
                [
                    'title' => $card['title'],
                    'description' => $card['description'],
                    'column_id' => $data['id']
                ]
            );
        }

        $column = $this->find($data['id']);

        return $column;
    }

    /**
     * Delete a column
     *
     * @param int $id
     * @return bool|null
     */
    public function delete(int $id)
    {
        return Column::find($id)->delete();
    }
}

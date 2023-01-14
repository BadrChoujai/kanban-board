<?php

namespace App\Repositories\Column;

interface ColumnRepository
{
    /**
     * Get all columns
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all($filters = []);

    /**
     * Find a column by id
     *
     * @param int $id
     * @return \App\Models\Column
     */
    public function find(int $id);

    /**
     * Create a new column
     *
     * @param array $data
     * @return \App\Models\Column
     */
    public function create(array $data);

    /**
     * Update a column
     *
     * @param array $data
     * @return \App\Models\Column
     */
    public function update(array $data);

    /**
     * Delete a column
     *
     * @param int $id
     * @return bool|null
     */
    public function delete(int $id);
}

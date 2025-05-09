<?php


namespace App\Interfaces;


interface BasicRepositoryInterface
{


    public function getPaginate($per_page);
    public function getAll();
    public function getSoftDelete();
    public function getById($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function final_delete($id);
    public function restore($id);
    public function getBywhere(array $conditions);
    public function getWithRelations($relations = []);
    public function getLastFieldValue($field);
    public function getLastFieldValue_2($field);
    public function getWithRelationsAndWhere(array $relations, string $column, $value);
    public function deleteWhere( $column, $value);
    public function countWhere(array $conditions);
    public function getModel();
    public function deleteWhere_arr(array $conditions);

}

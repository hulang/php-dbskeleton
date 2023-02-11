<?php

declare(strict_types=1);

namespace php\dbskeleton;

use php\dbskeleton\mysql\TableModel;
use php\dbskeleton\mysql\ColumnModel;

interface ISkeleton
{
    /**
     * 创建表
     * @param $tableModel TableModel
     * @param $columnModels
     * @return mixed
     */
    public function createTable(TableModel $tableModel,  array $columnModels);

    /**
     * 修改表
     * @return mixed
     */
    public function alterTable(TableModel $oldtableModel, TableModel $newtableModel);

    /**
     * 删除表
     * @return mixed
     */
    public function dropTable(TableModel $tableModel);

    /**
     * 添加字段
     * @return mixed
     */
    public function addColumn(TableModel $tableModel, ColumnModel $columnModel);

    /**
     * 修改字段
     * @return mixed
     */
    public function changeColumn(TableModel $tableModel, ColumnModel $oldcolumnModel, ColumnModel $newcolumnModel);

    /**
     * 删除字段
     * @return mixed
     */
    public function dropColumn(TableModel $tableModel, ColumnModel $columnModel);
}

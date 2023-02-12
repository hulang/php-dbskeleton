<?php

declare(strict_types=1);

namespace php\dbskeleton;

use php\dbskeleton\mysql\TableModel;
use php\dbskeleton\mysql\ColumnModel;

interface ISkeleton
{
    /**
     * 创建表
     * @access public
     * @param TableModel $tableModel 表模型
     * @param array $columnModels 字段生成模型
     * @return mixed|array
     */
    public function createTable(TableModel $tableModel, array $columnModels);

    /**
     * 修改表
     * @access public
     * @param TableModel $oldtableModel 需要修改表
     * @param TableModel $newtableModel 新表模型
     * @return mixed|array
     */
    public function alterTable(TableModel $oldtableModel, TableModel $newtableModel);

    /**
     * 删除表
     * @access public
     * @param TableModel $tableModel 表模型
     * @return mixed|array
     */
    public function dropTable(TableModel $tableModel);

    /**
     * 添加字段
     * @access public
     * @param TableModel $tableModel 表模型
     * @param ColumnModel $columnModel 字段生成模型
     * @return mixed|array
     */
    public function addColumn(TableModel $tableModel, ColumnModel $columnModel);

    /**
     * 修改字段
     * @access public
     * @param TableModel $tableModel 表模型
     * @param ColumnModel $oldcolumnModel 修改字段模型
     * @param ColumnModel $newcolumnModel 新字段模型
     * @return mixed|array
     */
    public function changeColumn(TableModel $tableModel, ColumnModel $oldcolumnModel, ColumnModel $newcolumnModel);

    /**
     * 删除字段
     * @access public
     * @param TableModel $tableModel 表模型
     * @param ColumnModel $columnModel 字段生成模型
     * @return mixed|array
     */
    public function dropColumn(TableModel $tableModel, ColumnModel $columnModel);
}

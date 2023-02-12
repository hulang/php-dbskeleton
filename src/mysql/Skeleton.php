<?php

declare(strict_types=1);

namespace php\dbskeleton\mysql;

use PDO;
use Exception;
use php\dbskeleton\ISkeleton;
use PDOException;

class Skeleton implements ISkeleton
{
    /**
     * 数据库连接对象
     * @var mixed|PDO
     */
    private $_connection;

    public function __construct($connection)
    {
        $this->_connection = $connection;
    }
    /**
     * 创建表
     * @access public
     * @param TableModel $tableModel 表模型
     * @param array $columnModels 字段生成模型
     * @return mixed|array
     */
    public function createTable(TableModel $tableModel, array $columnModels)
    {
        $arr = [];
        $arr['code'] = 0;
        $arr['msg'] = '';
        try {
            if (count($columnModels) == 0) {
                $arr['msg'] = '创建表时,必须包含一个列!';
            } else {
                $columnssql = ' ( ';
                foreach ($columnModels as $columnModel) {
                    $columnssql .= $columnModel->Generate();
                }
                $columnssql .= ' ) ';
                $sql = "CREATE TABLE `" . $tableModel->tablename . "` " . $columnssql . "  ENGINE=" . $tableModel->engine . " DEFAULT CHARSET=" . $tableModel->charset . " ROW_FORMAT=COMPACT COMMENT='" . $tableModel->comment . "';";
                $stmt = $this->_connection->prepare($sql);
                $stmt->execute();
                // 返回受上一个SQL语句影响的行数
                $count = $stmt->rowCount();
                $arr['code'] = $count;
                $arr['msg'] = '创建表成功!';
            }
        } catch (PDOException $ex) {
            $arr['msg'] = $ex->getMessage();
        }
        return $arr;
    }

    /**
     * 修改表
     * @access public
     * @param TableModel $oldtableModel 需要修改表
     * @param TableModel $newtableModel 新表模型
     * @return mixed|array
     */
    public function alterTable(TableModel $oldtableModel, TableModel $newtableModel)
    {
        $arr = [];
        $arr['code'] = 0;
        $arr['msg'] = '';
        try {
            $sql = 'ALTER TABLE ' . $oldtableModel->tablename . ' RENAME ' . $newtableModel->tablename;
            $stmt = $this->_connection->prepare($sql);
            $stmt->execute();
            // 返回受上一个SQL语句影响的行数
            $count = $stmt->rowCount();
            $arr['code'] = $count;
            $arr['msg'] = '修改表成功!';
        } catch (PDOException $ex) {
            $arr['msg'] = $ex->getMessage();
        }
        return $arr;
    }

    /**
     * 删除表
     * @access public
     * @param TableModel $tableModel 表模型
     * @return mixed|array
     */
    public function dropTable(TableModel $tableModel)
    {
        $arr = [];
        $arr['code'] = 0;
        $arr['msg'] = '';
        try {
            $sql = 'DROP TABLE ' . $tableModel->tablename . ';';
            $stmt = $this->_connection->prepare($sql);
            $stmt->execute();
            // 返回受上一个SQL语句影响的行数
            $count = $stmt->rowCount();
            $arr['code'] = $count;
            $arr['msg'] = '删除表成功!';
        } catch (PDOException $ex) {
            $arr['msg'] = $ex->getMessage();
        }
        return $arr;
    }

    /**
     * 添加字段
     * @access public
     * @param TableModel $tableModel 表模型
     * @param ColumnModel $columnModel 字段生成模型
     * @return mixed|array
     */
    public function addColumn(TableModel $tableModel, ColumnModel $columnModel)
    {
        $arr = [];
        $arr['code'] = 0;
        $arr['msg'] = '';
        try {
            $sql = 'alter table ' . $tableModel->tablename . ' add ' . $columnModel->Generate();
            $stmt = $this->_connection->prepare($sql);
            $stmt->execute();
            // 返回受上一个SQL语句影响的行数
            $count = $stmt->rowCount();
            $arr['code'] = $count;
            $arr['msg'] = '添加字段成功!';
        } catch (PDOException $ex) {
            $arr['msg'] = $ex->getMessage();
        }
        return $arr;
    }

    /**
     * 修改字段
     * @access public
     * @param TableModel $tableModel 表模型
     * @param ColumnModel $oldcolumnModel 修改字段模型
     * @param ColumnModel $newcolumnModel 新字段模型
     * @return mixed|array
     */
    public function changeColumn(TableModel $tableModel, ColumnModel $oldcolumnModel, ColumnModel $newcolumnModel)
    {
        $arr = [];
        $arr['code'] = 0;
        $arr['msg'] = '';
        try {
            $sql = '';
            if ($oldcolumnModel->name != $newcolumnModel->name) { //修改字段名
                $sql = 'alter table ' . $tableModel->tablename . ' change ' . $oldcolumnModel->name . ' ' . $newcolumnModel->Generate();
            } else { //修改其它
                $sql = 'ALTER TABLE ' . $tableModel->tablename . ' MODIFY COLUMN ' . $newcolumnModel->Generate();
            }
            $stmt = $this->_connection->prepare($sql);
            $stmt->execute();
            // 返回受上一个SQL语句影响的行数
            $count = $stmt->rowCount();
            $arr['code'] = $count;
            $arr['msg'] = '修改字段成功!';
        } catch (PDOException $ex) {
            $arr['msg'] = $ex->getMessage();
        }
        return $arr;
    }

    /**
     * 删除字段
     * @access public
     * @param TableModel $tableModel 表模型
     * @param ColumnModel $columnModel 字段生成模型
     * @return mixed|array
     */
    public function dropColumn(TableModel $tableModel, ColumnModel $columnModel)
    {
        $arr = [];
        $arr['code'] = 0;
        $arr['msg'] = '';
        try {
            $sql = 'ALTER TABLE ' . $tableModel->tablename . ' DROP COLUMN ' . $columnModel->name . ';';
            $stmt = $this->_connection->prepare($sql);
            $stmt->execute();
            // 返回受上一个SQL语句影响的行数
            $count = $stmt->rowCount();
            $arr['code'] = $count;
            $arr['msg'] = '删除字段成功!';
        } catch (Exception $ex) {
            $arr['msg'] = $ex->getMessage();
        }
        return $arr;
    }
}

<?php

namespace App\Helpers;

use DB;
use Illuminate\Support\Facades\Schema;

class DBHelper
{

    public static function updateBatch($table, $multipleData = [])
    {
        try {
            if (empty($multipleData)) {
                throw new \Exception("数据不能为空");
            }
            $tableName = DB::getTablePrefix() . $table; // 表名
            $firstRow = current($multipleData);

            $updateColumn = array_keys($firstRow);
            // 默认以id为条件更新，如果没有ID则以第一个字段为条件
            $referenceColumn = isset($firstRow['id']) ? 'id' : current($updateColumn);
            // 拼接sql语句
            $updateSql = "UPDATE " . $tableName . " SET ";
            $sets = [];
            $bindings = [];
            foreach ($updateColumn as $uColumn) {
                if ($uColumn == $referenceColumn) {
                    continue;
                }
                $setSql = "`" . $uColumn . "` = CASE ";
                foreach ($multipleData as $data) {
                    $setSql .= "WHEN `" . $referenceColumn . "` = ? THEN ? ";
                    $bindings[] = $data[$referenceColumn];
                    $bindings[] = $data[$uColumn];
                }
                $setSql .= "ELSE `" . $uColumn . "` END ";
                $sets[] = $setSql;
            }
            $updateSql .= implode(', ', $sets);
            $whereIn = collect($multipleData)->pluck($referenceColumn)->values()->all();
            $bindings = array_merge($bindings, $whereIn);
            $whereIn = rtrim(str_repeat('?,', count($whereIn)), ',');
            $updateSql = rtrim($updateSql, ", ") . " WHERE `" . $referenceColumn . "` IN (" . $whereIn . ")";
            // 传入预处理sql语句和对应绑定数据
            return DB::update($updateSql, $bindings);
        } catch (\Exception $e) {
            return false;
        }
    }

    public static function syncProject($table, $isNew, $projectId, $drafts, $extras = [])
    {
        $now = \Carbon\Carbon::now();
        $guards = ['project_draft_id', 'created_at', 'updated_at', 'deleted_at'];
        if (empty($drafts)) {
            return;
        }
        $adds = [];
        $updates = [];
        $deletes = [];
        if (!$isNew) {
            $publishs = DB::table($table)->where('project_id', $projectId)->where($extras)->select('id')->get();
            if (!empty($publishs)) {
                foreach ($publishs as $publishRow) {
                    $deletes[$publishRow->id] = 1;
                }
            }
        }

        foreach ($drafts as $draft) {
            $default = [
                'project_id' => $projectId,
                'created_at' => $now,
                'updated_at' => $now,
            ];
            $row = [];
            foreach ($draft->getAttributes() as $key => $value) {
                if (!in_array($key, $guards)) {
                    $row[$key] = $value;
                }
            }
            if (!empty($extras)) {
                $row = array_merge($row, $extras);
            }
            $row = array_merge($row, $default);
            if (isset($deletes[$draft->id])) {
                $updates[] = $row;
                unset($deletes[$draft->id]);
            } else {
                $adds[] = $row;
            }
        }
        if (!empty($adds)) {
            DB::table($table)->insert($adds);
        }
        if (!empty($updates)) {
            static::updateBatch($table, $updates);
        }
        if (!empty($deletes)) {
            $deleteIds = array_keys($deletes);
            if (Schema::hasColumn($table, 'deleted_at')) {
                DB::table($table)->whereIn('id', $deleteIds)->update(['deleted_at' => $now]);
            } else {
                DB::table($table)->whereIn('id', $deleteIds)->delete();
            }
        }
    }
}

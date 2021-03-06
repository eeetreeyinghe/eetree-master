<?php

namespace App\Helpers;

use Illuminate\Support\Collection;

class Tree
{
    public static function make($source, $parentId = 0)
    {
        $map = collect([]);
        if (empty($source) || $source->isEmpty()) {
            return $map;
        }
        $source->each(function ($item, $key) use ($map) {
            $k = 'map_' . $item->parent_id;
            if (!$map->has($k)) {
                $map->put($k, collect([]));
            }
            $map->get($k)->push($item);
        });
        $tree = static::makeTree($map, $parentId);
        return $tree ?: collect([]);
    }

    public static function children($tree, $id)
    {
        if (empty($tree) || $tree->isEmpty()) {
            return collect([]);
        }
        $result = collect([]);
        $tree->each(function ($item, $key) use ($id, &$result) {
            if ($item->id == $id) {
                if ($item->children && $item->children->isNotEmpty()) {
                    $result = $item->children;
                }
                return false;
            } elseif ($item->children && $item->children->isNotEmpty()) {
                $find = static::children($item->children, $id);
                if ($find && $find->isNotEmpty()) {
                    $result = $find;
                    return false;
                }
            }
        });
        return $result;
    }

    public static function parents($tree, $id, $parents = [])
    {
        if (empty($tree) || $tree->isEmpty()) {
            return false;
        }
        $find = false;
        $tree->each(function ($item, $key) use ($id, &$parents, &$find) {
            if ($item->id == $id) {
                unset($item->children);
                array_unshift($parents, $item);
                $find = true;
                return false;
            } elseif ($item->children && $item->children->isNotEmpty()) {
                $findChildren = static::parents($item->children, $id, $parents);
                if ($findChildren !== false) {
                    unset($item->children);
                    $parents = $findChildren;
                    array_unshift($parents, $item);
                    $find = true;
                    return false;
                }
            }
        });
        return $find ? $parents : false;
    }

    public static function siblings($tree, $node)
    {
        if (empty($tree) || $tree->isEmpty()) {
            return collect([]);
        }
        $result = collect([]);
        $tree->each(function ($item, $key) use ($node, &$result) {
            if ($node->parent_id == $item->parent_id) {
                if ($node->id != $item->id) {
                    $result->push($item);
                }
            } elseif ($item->id == $node->parent_id) {
                if ($item->children && $item->children->isNotEmpty()) {
                    $removeKey = $item->children->search(function ($sValue, $sKey) use ($node) {
                        return $sValue->id == $node->id;
                    });
                    $item->children->forget($removeKey);
                    $result = $item->children->values();
                }
                return false;
            } elseif ($item->children && $item->children->isNotEmpty()) {
                $find = static::siblings($item->children, $node);
                if ($find && $find->isNotEmpty()) {
                    $result = $find;
                    return false;
                }
            }
        });
        return $result;
    }

    public static function ids($tree, $recursive = true)
    {
        if (empty($tree) || $tree->isEmpty()) {
            return [];
        }
        $result = [];
        $tree->each(function ($item, $key) use ($recursive, &$result) {
            $result[] = $item->id;
            if ($recursive && $item->children && $item->children->isNotEmpty()) {
                $find = static::ids($item->children, $recursive);
                $result = array_merge($result, $find);
            }
        });
        return $result;
    }

    protected static function makeTree(Collection $map, $parentId = 0)
    {
        $k = 'map_' . $parentId;
        if ($map->has($k)) {
            $tree = $map->get($k);
            $tree->transform(function ($item, $key) use ($map) {
                if ($children = static::makeTree($map, $item->id)) {
                    $item->children = $children;
                }
                return $item;
            });
        } else {
            $tree = collect([]);
        }
        return $tree;
    }
}

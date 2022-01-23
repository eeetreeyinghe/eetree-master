<?php

namespace App\Helpers;

use App\Models\Doc;
use App\Models\Project;
use Jenssegers\Agent\Agent;

class Search
{
    public static function doc($params)
    {
        $agent = new Agent();
        $maxPage = config('eetree.maxSearchPage');
        $perPage = config('eetree.limit');
        $page = (int) request('page', 1);
        if ($page > $maxPage) {
            abort(404);
        }
        if ($page < 1) {
            $page = 1;
        }
        $searchParams = [
            'size' => $perPage,
            'from' => ($page - 1) * $perPage,
            'query' => [
                'bool' => [
                    'must' => [
                        'exists' => [
                            'field' => 'publish_at',
                        ],
                    ],
                    'filter' => [],
                ],
            ],
        ];
        if ($agent->isMobile()) {
            $searchParams['size']++;
        }
        if (isset($params['category_id'])) {
            $searchParams['query']['bool']['filter'][] = [
                'terms' => [
                    'category_id' => $params['category_id'],
                ],
            ];
        }
        if (isset($params['tag_id'])) {
            $searchParams['query']['bool']['filter'][] = [
                'term' => [
                    'tags' => $params['tag_id'],
                ],
            ];
        }
        if (isset($params['q'])) {
            $must = $searchParams['query']['bool']['must'];
            $searchParams['query']['bool']['must'] = [
                $must,
                [
                    'multi_match' => [
                        'query' => $params['q'],
                        'fields' => ['title^3', 'description^2', 'content'],
                        'fuzziness' => 'AUTO',
                        // 'tie_breaker' => 0.3
                    ],
                ],
            ];
        } else {
            $searchParams['sort'] = [
                'publish_at' => [
                    'order' => 'desc',
                ],
            ];
        }
        $searchResult = \App\Helpers\Elasticsearch::search($searchParams, config('eetree.es.index.doc'));
        $currentUrl = url()->current();
        if (isset($params['q'])) {
            $currentUrl .= '?q=' . urlencode($params['q']);
        }
        if ($searchResult) {
            $ids = [];
            foreach ($searchResult['hits'] as $row) {
                array_push($ids, $row['_id']);
            }
            $flip = array_flip($ids);
            $query = Doc::with('user:id,avatar,nickname')->whereIn('id', $ids)->whereNotNull('publish_at')->get();
            $query = $query->sortBy(function ($item, $key) use ($flip) {
                return $flip[$item->id];
            });
            $max = $perPage * $maxPage;
            $total = $searchResult['total'] < $max ? $searchResult['total'] : $max;
            if ($agent->isMobile()) {
                return new \Illuminate\Pagination\Paginator($query, $perPage, null, array('path' => $currentUrl));
            } else {
                return new \Illuminate\Pagination\LengthAwarePaginator($query, $total, $perPage, null, array('path' => $currentUrl));
            }
        } else {
            return new \Illuminate\Pagination\LengthAwarePaginator(collect(), 0, $perPage, null, array('path' => $currentUrl));
        }
    }

    public static function project($params)
    {
        $agent = new Agent();
        $maxPage = config('eetree.maxSearchPage');
        $perPage = config('eetree.limit');
        $page = (int) request('page', 1);
        if ($page > $maxPage) {
            abort(404);
        }
        if ($page < 1) {
            $page = 1;
        }
        $searchParams = [
            'size' => $perPage,
            'from' => ($page - 1) * $perPage,
            'query' => [
                'bool' => [
                    'must' => [
                        'exists' => [
                            'field' => 'publish_at',
                        ],
                    ],
                    'filter' => [],
                ],
            ],
        ];
        if ($agent->isMobile()) {
            $searchParams['size']++;
        }
        if (isset($params['platform_id'])) {
            $searchParams['query']['bool']['filter'][] = [
                'term' => [
                    'platform_id' => $params['platform_id'],
                ],
            ];
        }
        if (isset($params['type'])) {
            $searchParams['query']['bool']['filter'][] = [
                'term' => [
                    'type' => $params['type'],
                ],
            ];
        }
        if (isset($params['tag_id'])) {
            $searchParams['query']['bool']['filter'][] = [
                'term' => [
                    'tags' => $params['tag_id'],
                ],
            ];
        }
        if (isset($params['q'])) {
            $must = $searchParams['query']['bool']['must'];
            $searchParams['query']['bool']['must'] = [
                $must,
                [
                    'multi_match' => [
                        'query' => $params['q'],
                        'fields' => ['title^2', 'description'],
                        'fuzziness' => 'AUTO',
                        // 'tie_breaker' => 0.3
                    ],
                ],
            ];
        } else {
            $searchParams['query']['bool']['filter'][] = [
                'term' => [
                    'pid' => 0,
                ],
            ];
            $searchParams['sort'] = [
                'publish_at' => [
                    'order' => 'desc',
                ],
            ];
        }
        $searchResult = \App\Helpers\Elasticsearch::search($searchParams, config('eetree.es.index.project'));
        $currentUrl = url()->full();
        $currentUrl = preg_replace('/(page=\d+&)|(&page=\d+)/', '', $currentUrl);
        if ($searchResult) {
            $ids = [];
            foreach ($searchResult['hits'] as $row) {
                array_push($ids, $row['_id']);
            }
            $flip = array_flip($ids);
            $query = Project::with(['cloud', 'user:id,avatar,nickname'])->whereIn('id', $ids)->whereNotNull('last_publish_at')->get();
            $query = $query->sortBy(function ($item, $key) use ($flip) {
                return $flip[$item->id];
            });
            $max = $perPage * $maxPage;
            $total = $searchResult['total'] < $max ? $searchResult['total'] : $max;
            if ($agent->isMobile()) {
                return new \Illuminate\Pagination\Paginator($query, $perPage, null, array('path' => $currentUrl));
            } else {
                return new \Illuminate\Pagination\LengthAwarePaginator($query, $total, $perPage, null, array('path' => $currentUrl));
            }
        } else {
            return new \Illuminate\Pagination\LengthAwarePaginator(collect(), 0, $perPage, null, array('path' => $currentUrl));
        }
    }

    public static function relatedProjects($project, $size)
    {
        $searchParams = [
            'size' => $size,
            'query' => [
                'bool' => [
                    'must' => [
                        'exists' => [
                            'field' => 'publish_at',
                        ],
                    ],
                    'must_not' => [
                        'term' => [
                            '_id' => $project->id,
                        ],
                    ],
                    'should' => [
                        [
                            'multi_match' => [
                                'query' => $project->title,
                                'fields' => ['title^2', 'description'],
                                'fuzziness' => 'AUTO',
                                // 'tie_breaker' => 0.3
                            ],
                        ],
                    ],
                ],
            ],
        ];
        $tagIds = $project->tags->pluck('id')->toArray();
        if (!empty($tagIds)) {
            $searchParams['query']['bool']['should'][] = [
                'terms' => [
                    'tags' => $tagIds,
                    'boost' => 2,
                ],
            ];
        }
        $searchResult = \App\Helpers\Elasticsearch::search($searchParams, config('eetree.es.index.project'));
        if ($searchResult) {
            $ids = [];
            foreach ($searchResult['hits'] as $row) {
                array_push($ids, $row['_id']);
            }
            $flip = array_flip($ids);
            $result = Project::with(['cloud', 'user:id,nickname,avatar'])->whereIn('id', $ids)->whereNotNull('last_publish_at')->get();
        } else {
            $result = collect([]);
        }
        return $result;
    }
}

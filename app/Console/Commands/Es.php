<?php

namespace App\Console\Commands;

use App\Helpers\Elasticsearch;
use App\Models\Doc;
use App\Models\Project;
use Illuminate\Console\Command;

class Es extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'es {action}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'elastic search: initEs,recreate,create(index),delete(index),firstBulk(init data),bulk(update data)';
    protected $elastic;
    protected $client;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $action = $this->argument('action');
        $this->$action();
    }

    private function initEs()
    {
        $params = [
            'name' => config('eetree.es.index.doc'),
            'body' => [
                'template' => '*',
                'settings' => [
                    'number_of_shards' => 1,
                ],
                'mappings' => [
                    'dynamic_templates' => [
                        [
                            'strings' => [
                                'match_mapping_type' => 'string',
                                'mapping' => [
                                    'type' => 'text',
                                    'analyzer' => 'ik_max_word',
                                    'search_analyzer' => 'ik_smart',
                                    'fields' => [
                                        'keyword' => [
                                            'type' => 'keyword',
                                            'ignore_above' => 256,
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];
        $response = Elasticsearch::getClient()->indices()->putTemplate($params);

        $params['name'] = config('eetree.es.index.project');
        $response = Elasticsearch::getClient()->indices()->putTemplate($params);
        $this->create();
        $this->firstBulk();
    }

    private function recreate()
    {
        $this->delete();
        $this->create();
        $this->firstBulk();
    }

    private function create()
    {
        $params = [
            'index' => config('eetree.es.index.doc'),
            'body' => [
                'settings' => [
                    'number_of_shards' => 1,
                    'number_of_replicas' => 0,
                ],
                'mappings' => [
                    'properties' => [
                        'type' => [
                            'type' => 'keyword',
                        ],
                    ],
                ],
            ],
        ];

        $response = Elasticsearch::getClient()->indices()->create($params);

        $params['index'] = config('eetree.es.index.project');
        unset($params['body']['mappings']);
        $response = Elasticsearch::getClient()->indices()->create($params);
    }

    private function delete()
    {
        $params = [
            'index' => config('eetree.es.index.doc'),
        ];
        $response = Elasticsearch::getClient()->indices()->delete($params);

        $params['index'] = config('eetree.es.index.project');
        $response = Elasticsearch::getClient()->indices()->delete($params);
    }

    private function firstBulk()
    {
        $this->bulk(false);
    }

    private function bulk($isUpdate = true)
    {
        $this->updateDoc($isUpdate);
        $this->updateProject($isUpdate);
    }

    private function updateDoc($isUpdate = true)
    {
        $lastUpdated = 0;
        if ($isUpdate) {
            $updatedSearch = Elasticsearch::search([
                'size' => 1,
                'sort' => [
                    'updated_at' => [
                        'order' => 'desc',
                    ],
                ],
            ], config('eetree.es.index.doc'));
            if ($updatedSearch) {
                $lastUpdated = \Carbon\Carbon::createFromTimeString($updatedSearch['hits'][0]['_source']['updated_at'], 'UTC')->timezone(config('app.timezone'))->toDateTimeString();
            }
        }
        $limit = 100;
        $offset = 0;
        while (1) {
            $docs = Doc::with(['docCategory', 'tags'])
                ->where([
                    ['updated_at', '>', $lastUpdated],
                    ['type', Doc::TYPE_DOC],
                ])
                ->orderBy('id', 'asc')
                ->offset($offset)
                ->limit($limit)
                ->get();
            if ($docs->isEmpty()) {
                break;
            }
            $offset += $limit;
            $params = ['body' => []];
            $docs->each(function ($item, $key) use (&$params) {
                $params['body'][] = [
                    'index' => [
                        '_index' => config('eetree.es.index.doc'),
                        '_id' => $item->id,
                    ],
                ];

                $params['body'][] = [
                    'title' => $item->title,
                    'description' => $item->description,
                    'content' => $this->_getContent($item->content['root']),
                    'publish_at' => $item->publish_at,
                    'view_count' => $item->view_count,
                    'fav_count' => $item->fav_count,
                    'like_count' => $item->like_count,
                    'updated_at' => $item->updated_at,
                    'category_id' => $item->docCategory->pluck('category_id'),
                    'tags' => $item->tags->pluck('id'),
                ];
            });
            $responses = Elasticsearch::getClient()->bulk($params);
            if ($responses['errors']) {
                foreach ($responses['items'] as $value) {
                    if (isset($value['index']['error'])) {
                        print_r($value);
                    }
                }
                break;
            }
        }
    }

    private function _getContent($node, $prefix = '')
    {
        if ($prefix == '') {
            $prefix = $node['data']['text'];
        } else {
            $prefix .= "\n" . $node['data']['text'];
        }
        if (strlen($prefix) > 3000) {
            return $prefix;
        }
        if (!empty($node['children'])) {
            foreach ($node['children'] as $child) {
                $prefix = $this->_getContent($child, $prefix);
            }
        }
        return $prefix;
    }

    private function updateProject($isUpdate = true)
    {
        $lastUpdated = 0;
        if ($isUpdate) {
            $updatedSearch = Elasticsearch::search([
                'size' => 1,
                'sort' => [
                    'updated_at' => [
                        'order' => 'desc',
                    ],
                ],
            ], config('eetree.es.index.project'));
            if ($updatedSearch) {
                $lastUpdated = \Carbon\Carbon::createFromTimeString($updatedSearch['hits'][0]['_source']['updated_at'], 'UTC')->timezone(config('app.timezone'))->toDateTimeString();
            }
        }
        $limit = 100;
        $offset = 0;
        while (1) {
            $projects = Project::with('tags')
                ->where([
                    ['updated_at', '>', $lastUpdated],
                ])
                ->orderBy('id', 'asc')
                ->offset($offset)
                ->limit($limit)
                ->get();
            if ($projects->isEmpty()) {
                break;
            }
            $offset += $limit;
            $params = ['body' => []];
            $projects->each(function ($item, $key) use (&$params) {
                $params['body'][] = [
                    'index' => [
                        '_index' => config('eetree.es.index.project'),
                        '_id' => $item->id,
                    ],
                ];

                $params['body'][] = [
                    'title' => $item->title,
                    'description' => $item->description,
                    'publish_at' => $item->last_publish_at,
                    'view_count' => $item->view_count,
                    'fav_count' => $item->fav_count,
                    'like_count' => $item->like_count,
                    'updated_at' => $item->updated_at,
                    'type' => $item->type,
                    'platform_id' => $item->platform_id,
                    'tags' => $item->tags->pluck('id'),
                    'pid' => $item->pid,
                ];
            });
            $responses = Elasticsearch::getClient()->bulk($params);
            if ($responses['errors']) {
                foreach ($responses['items'] as $value) {
                    if (isset($value['index']['error'])) {
                        print_r($value);
                    }
                }
                break;
            }
        }
    }
}

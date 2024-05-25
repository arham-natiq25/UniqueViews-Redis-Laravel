<?php

namespace App\Console\Commands;

use App\Models\Article;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class SyncArticleViewCount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sync-article-view-count';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $models = [
        Article::class,
    ];
    /**
     * Execute the console command.
     */
    public function handle()
    {
        // tetch all the ids
        // look up count with redis and patch up with our database
        // batch update back in db

        collect($this->models)->each(function ($model) {
            $views = $model::select('id')->pluck('id')->map(function ($id) use ($model) {
                return ['id' => $id, 'view_count' => Redis::pfcount(sprintf('%s.%s.views', (new $model)->getTable(), $id))];
            })
                ->toArray();

            batch()->update(new $model(), $views, 'id');
        });
    }
    }

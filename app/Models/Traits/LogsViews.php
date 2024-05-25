<?php

namespace App\Models\Traits;

use Illuminate\Support\Facades\Redis;

trait LogsViews
{
    public function logView()
    {
        Redis::pfadd(sprintf('%s.%s.views', $this->getTable(), $this->id), [request()->ip()]);
    }

    public function getViewCount()
    {
        return Redis::pfcount(sprintf('%s.%s.views', $this->getTable(), $this->id));

    }
}

<?php

namespace App\Models;

class Topic extends Model
{
    protected $fillable = ['title', 'body', 'category_id', 'excerpt', 'slug'];

    /**
     * [category 获取分类]
     * @return [type] [description]
     */
    public function category()
    {
        return $this->belongsTo(Categroy::class);
    }

    /**
     * [user 获取用户]
     * @return [type] [description]
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * [scopeWithOrder 排序]
     * @param  [type] $query [description]
     * @param  [type] $order [description]
     * @return [type]        [description]
     */
    public function scopeWithOrder($query, $order)
    {
        // 不同的排序，使用不同的数据读取逻辑
        switch ($order) {
            case 'recent':
                $query->recent();
                break;

            default:
                $query->recentReplied();
                break;
        }
        // 预加载防止 N+1 问题
        return $query->with('user', 'category');
    }



    /**
     * [scopeRecentReplied 更细时间倒序排序]
     * @param  [type] $query [description]
     * @return [type]        [description]
     */
    public function scopeRecentReplied($query)
    {
        // 当话题有新回复时，我们将编写逻辑来更新话题模型的 reply_count 属性，
        // 此时会自动触发框架对数据模型 updated_at 时间戳的更新
        return $query->orderBy('updated_at', 'desc');
    }

    /**
     * [scopeRecent 创建时间正序排序]
     * @param  [type] $query [description]
     * @return [type]        [description]
     */
    public function scopeRecent($query)
    {
        // 按照创建时间排序
        return $query->orderBy('created_at', 'desc');
    }
}

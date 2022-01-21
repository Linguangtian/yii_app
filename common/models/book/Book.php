<?php

namespace common\models\book;

use Yii;

/**
 * This is the model class for table "{{%book}}".
 *
 * @property int $id 书籍ID
 * @property int $channel_id 所属频道
 * @property int $cid 一级分类ID
 * @property string $name 作品名称
 * @property string $old_name 作品原名
 * @property string $note_name 作品备注
 * @property string $source 小说来源
 * @property int $source_id 小说来源ID
 * @property string $author 作者
 * @property int|null $author_id 作者id
 * @property string|null $author_note 作者寄语
 * @property string $description 作品简介
 * @property string $keywords 关键词
 * @property int $total_price 总定价
 * @property int $words_price 千字定价
 * @property int $chapter_price 章节定价
 * @property int $free_chapters 免费章节数
 * @property string $cover 封面
 * @property int $status 状态 1连载 2完结
 * @property int $online_status 上架状态 1上架 2下架
 * @property int $weight 权重
 * @property int $is_vip 是否付费 1是 0不是
 * @property int $is_baoyue 是否包月作品
 * @property int $is_hot 是否是热门作品
 * @property int $is_new 是否是新品
 * @property int $is_yy 是否是爽文
 * @property int $is_greatest 是否是精选作品
 * @property int $is_god 是否是大神作品
 * @property int $is_sensitivity 是否敏感书籍
 * @property int $total_words 总字数
 * @property int $total_chapters 章节数
 * @property int $total_views 总浏览
 * @property int $total_favors 总收藏数
 * @property int $last_chapter_id 最新章节ID
 * @property int $last_chapter_time 最新章节时间
 * @property int $chapter_update_remind 章节更新提醒
 * @property int $audio_id 关联有声id
 * @property int $store_type 存储方式 1数据库存储 2文件存储
 * @property int $lang_id
 * @property int $created_at 创建时间
 * @property int $updated_at 更新时间
 * @property int $deleted_at 删除时间
 * @property string|null $outhor_cover 作者头像
 */
class Book extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%book}}';
    }


}

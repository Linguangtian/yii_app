<?php
namespace frontend\models\book;


class Book extends \common\models\book\Book
{

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['channel_id', 'cid', 'source_id', 'author_id', 'total_price', 'words_price', 'chapter_price', 'free_chapters', 'status', 'online_status', 'weight', 'is_vip', 'is_baoyue', 'is_hot', 'is_new', 'is_yy', 'is_greatest', 'is_god', 'is_sensitivity', 'total_words', 'total_chapters', 'total_views', 'total_favors', 'last_chapter_id', 'last_chapter_time', 'chapter_update_remind', 'audio_id', 'store_type', 'lang_id', 'created_at', 'updated_at', 'deleted_at'], 'integer'],
            [['name', 'old_name', 'note_name', 'source'], 'string', 'max' => 256],
            [['author', 'outhor_cover'], 'string', 'max' => 128],
            [['author_note', 'description'], 'string', 'max' => 2048],
            [['keywords'], 'string', 'max' => 1024],
            [['cover'], 'string', 'max' => 512],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '书籍ID',
            'channel_id' => '所属频道',
            'cid' => '一级分类ID',
            'name' => '作品名称',
            'old_name' => '作品原名',
            'note_name' => '作品备注',
            'source' => '小说来源',
            'source_id' => '小说来源ID',
            'author' => '作者',
            'author_id' => '作者id',
            'author_note' => '作者寄语',
            'description' => '作品简介',
            'keywords' => '关键词',
            'total_price' => '总定价',
            'words_price' => '千字定价',
            'chapter_price' => '章节定价',
            'free_chapters' => '免费章节数',
            'cover' => '封面',
            'status' => '状态 1连载 2完结',
            'online_status' => '上架状态 1上架 2下架',
            'weight' => '权重',
            'is_vip' => '是否付费 1是 0不是',
            'is_baoyue' => '是否包月作品',
            'is_hot' => '是否是热门作品',
            'is_new' => '是否是新品',
            'is_yy' => '是否是爽文',
            'is_greatest' => '是否是精选作品',
            'is_god' => '是否是大神作品',
            'is_sensitivity' => '是否敏感书籍',
            'total_words' => '总字数',
            'total_chapters' => '章节数',
            'total_views' => '总浏览',
            'total_favors' => '总收藏数',
            'last_chapter_id' => '最新章节ID',
            'last_chapter_time' => '最新章节时间',
            'chapter_update_remind' => '章节更新提醒',
            'audio_id' => '关联有声id',
            'store_type' => '存储方式 1数据库存储 2文件存储',
            'lang_id' => 'Lang ID',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
            'deleted_at' => '删除时间',
            'outhor_cover' => '作者头像',
        ];
    }

}
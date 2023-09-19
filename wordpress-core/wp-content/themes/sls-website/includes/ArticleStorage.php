<?php
/**
 * Class ArticleStorage
 *
 * This simple class ensures, there won't be duplicated posts throughout the various widgets that has been output to a page
 *
 * @package SLS
 * @subpackage Widgets
 * @since 5.2.2
 */
class ArticleStorage
{
    /**
     * @var bool
     */
    private static $instance = false;
    /**
     * @var array
     */
    private $article_storage;

    /**
     * ArticleStorage constructor.
     */
    public function __construct()
    {
        $this->article_storage = [];
    }

    /**
     * Returns the same instance when called. (singleton)
     *
     * @return ArticleStorage|bool
     */
    public static function get_instance()
    {
        if (!self::$instance) {
            self::$instance = new ArticleStorage();
        }

        return self::$instance;
    }


    /**
     * Add array of post id-s here after every wp_query
     *
     * @param array $articles
     */
    public final function add_articles(array $articles)
    {
        $this->article_storage = array_merge($this->article_storage, $articles);
    }

    /**
     * Use this at the "post__not_in" query option for the new wp_query() objects to filter out previously shown posts
     *
     * @return array
     */
    public final function get_articles()
    {
        return $this->article_storage;
    }

    /**
     * Should not be used unless for some reason post id-s cant be filtered directly from query requests
     *
     * @param array $articles
     * @return array|mixed
     */
    public final function filter_available_articles(array $articles)
    {
        if (empty($articles)) {
            return $articles;
        }

        $available_articles = [];

        foreach ($articles as $article) {
            if (!array_key_exists($article, $this->article_storage)) {
                $available_articles = $article;
            }
        }

        return $available_articles;
    }

    /**
     * Queries posts and then adds the post ID-s to the ArticleStorage which is a common storage for storing post ID-s in case of avoiding duplicate posts on the same page
     *
     * @param $query_args
     * @return WP_Query
     */
    public final function get_posts($query_args)
    {
        $posts = new WP_Query($query_args + [
            'post_type' => 'post',
            'posts_per_page' => -1,
            'order' => 'DESC',
            'orderby' => 'post_date',
            'post__not_in' => ArticleStorage::get_instance()->get_articles(),
        ]);
        ArticleStorage::get_instance()->add_articles(wp_list_pluck($posts->posts, 'ID'));
        return $posts;
    }
}

<?php

namespace Webkul\Category\Models;

use Illuminate\Support\Facades\DB;
use Webkul\Core\Eloquent\TranslatableModel;
use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Webkul\Category\Contracts\Category as CategoryContract;
use Webkul\Attribute\Models\AttributeProxy;
use Webkul\Industry\Models\IndustryProxy;
use Webkul\Category\Repositories\CategoryRepository;

/**
 * Class Category
 *
 * @package Webkul\Category\Models
 *
 * @property-read string $url_path maintained by database triggers
 */
class Category extends TranslatableModel implements CategoryContract
{
    use NodeTrait;

    public $translatedAttributes = [
        'name',
        'description',
        'slug',
        'url_path',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    protected $fillable = ['position', 'status','industry_id', 'display_mode', 'parent_id'];

    protected $with = ['translations'];

    /**
     * Get image url for the category image.
     */
    public function image_url()
    {
        if (! $this->image)
            return;

        return Storage::url($this->image);
    }

    /**
     * Get image url for the category image.
     */
    public function getImageUrlAttribute()
    {
        return $this->image_url();
    }

     /**
     * The filterable attributes that belong to the category.
     */
    public function filterableAttributes()
    {
        return $this->belongsToMany(AttributeProxy::modelClass(), 'category_filterable_attributes')->with('options');
    }

    /**
     * The filterable attributes that belong to the category.
     */
    public function Industries()
    {
        return $this->belongsToMany(IndustryProxy::modelClass(),'category_industries');
    }

    /**
     * Getting the root category of a category
     * 
     * @return Category
     */
    public function getRootCategory(): Category
    {
        return Category::where([
            ['parent_id', '=', null],
            ['_lft', '<=', $this->_lft],
            ['_rgt', '>=', $this->_rgt],
        ])->first();
    }

    /**
     * Returns all categories within the category's path
     *
     * @return Category[]
     */
    public function getPathCategories(): array
    {
        $category = $this->findInTree();

        $categories = [$category];

        while (isset($category->parent)) {
            $category = $category->parent;
            $categories[] = $category;
        }

        return array_reverse($categories);
    }

    /**
     * Finds and returns the category within a nested category tree
     * will search in root category by default
     * is used to minimize the numbers of sql queries for it only uses the already cached tree
     *
     * @param Category[] $categoryTree
     * @return Category
     */
    public function findInTree($categoryTree = null): Category
    {
        if (! $categoryTree) {
            $categoryTree = app(CategoryRepository::class)->getVisibleCategoryTree($this->getRootCategory()->id);
        }

        $category = $categoryTree->first();

        if (! $category) {
            throw new NotFoundHttpException('category not found in tree');
        }

        if ($category->id === $this->id) {
            return $category;
        }
        
        return $this->findInTree($category->children);
    }

    public static function CategoryRawData($local = null)
    {
        if ($local) {
            return DB::select(DB::raw("SELECT category_translations.category_id, category_translations.name category_name, category_translations.url_path
        FROM categories
        INNER JOIN category_translations on category_translations.category_id = categories.id
        WHERE category_translations.locale = '$local'
        ORDER BY category_translations.category_id"));
        } else {
            return DB::select(DB::raw("SELECT category_translations.category_id, category_translations.name category_name, category_translations.url_path
            FROM categories
            INNER JOIN category_translations on category_translations.category_id = categories.id
            GROUP BY category_translations.category_id, category_translations.name, category_translations.url_path
            ORDER BY category_translations.category_id"));
        }

    }
}
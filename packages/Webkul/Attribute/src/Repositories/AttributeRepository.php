<?php

namespace Webkul\Attribute\Repositories;

use Illuminate\Support\Facades\DB;
use Webkul\Core\Eloquent\Repository;
use Illuminate\Support\Facades\Event;
use Webkul\Attribute\Repositories\AttributeOptionRepository;
use Illuminate\Container\Container as App;
use Illuminate\Support\Str;

class AttributeRepository extends Repository
{
    /**
     * AttributeOptionRepository object
     *
     * @var \Webkul\Attribute\Repositories\AttributeOptionRepository
     */
    protected $attributeOptionRepository;

    /**
     * Create a new repository instance.
     *
     * @param  \Webkul\Attribute\Repositories\AttributeOptionRepository  $attributeOptionRepository
     * @return void
     */
    public function __construct(
        AttributeOptionRepository $attributeOptionRepository,
        App $app
    )
    {
        $this->attributeOptionRepository = $attributeOptionRepository;

        parent::__construct($app);
    }

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Webkul\Attribute\Contracts\Attribute';
    }

    /**
     * @param  array  $data
     * @return \Webkul\Attribute\Contracts\Attribute
     */
    public function create(array $data)
    {
        Event::dispatch('catalog.attribute.create.before');

        $data = $this->validateUserInput($data);

        $options = isset($data['options']) ? $data['options'] : [];

        unset($data['options']);

        $attribute = $this->model->create($data);

        if (in_array($attribute->type, ['select', 'multiselect', 'checkbox']) && count($options)) {
            foreach ($options as $optionInputs) {
                $this->attributeOptionRepository->create(array_merge([
                    'attribute_id' => $attribute->id,
                ], $optionInputs));
            }
        }

        Event::dispatch('catalog.attribute.create.after', $attribute);

        return $attribute;
    }

    /**
     * @param  array  $data
     * @param  int $id
     * @param  string  $attribute
     * @return \Webkul\Attribute\Contracts\Attribute
     */
    public function update(array $data, $id, $attribute = "id")
    {
        $data = $this->validateUserInput($data);

        $attribute = $this->find($id);

        Event::dispatch('catalog.attribute.update.before', $id);

        $attribute->update($data);

        $previousOptionIds = $attribute->options()->pluck('id');

        if (in_array($attribute->type, ['select', 'multiselect', 'checkbox'])) {
            if (isset($data['options'])) {
                foreach ($data['options'] as $optionId => $optionInputs) {
                    if (Str::contains($optionId, 'option_')) {
                        $this->attributeOptionRepository->create(array_merge([
                            'attribute_id' => $attribute->id,
                        ], $optionInputs));
                    } else {
                        if (is_numeric($index = $previousOptionIds->search($optionId))) {
                            $previousOptionIds->forget($index);
                        }

                        $this->attributeOptionRepository->update($optionInputs, $optionId);
                    }
                }
            }
        }

        foreach ($previousOptionIds as $optionId) {
            $this->attributeOptionRepository->delete($optionId);
        }

        Event::dispatch('catalog.attribute.update.after', $attribute);

        return $attribute;
    }

    /**
     * @param  int  $id
     * @return void
     */
    public function delete($id)
    {
        Event::dispatch('catalog.attribute.delete.before', $id);

        parent::delete($id);

        Event::dispatch('catalog.attribute.delete.after', $id);
    }

    /**
     * @param  array  $data
     * @return array
     */
    public function validateUserInput($data)
    {
        if ($data['is_configurable']) {
            $data['value_per_channel'] = $data['value_per_locale'] = 0;
        }

        if (! in_array($data['type'], ['select', 'multiselect', 'price', 'checkbox', 'text'])) {
            $data['is_filterable'] = 0;
        }

        if (in_array($data['type'], ['select', 'multiselect', 'boolean'])) {
            unset($data['value_per_locale']);
        }

        return $data;
    }

    /**
     * @return array
     */
    public function getFilterAttributes()
    {
        return $this->model->where('is_filterable', 1)->with('options')->get();
    }

    /**
     *
     * @param  array  $codes
     * @return array
     */
    public function getProductDefaultAttributes($codes = null)
    {
        $attributeColumns  = ['id', 'code', 'value_per_channel', 'value_per_locale', 'type', 'is_filterable'];

        if (! is_array($codes) && ! $codes)
            return $this->findWhereIn('code', [
                'name',
                'description',
                'short_description',
                'url_key',
                'price',
                'special_price',
                'special_price_from',
                'special_price_to',
                'status',
            ], $attributeColumns);

        if (in_array('*', $codes)) {
            return $this->all($attributeColumns);
        }

        return $this->findWhereIn('code', $codes, $attributeColumns);
    }

    /**
     * @param  string  $code
     * @return \Webkul\Attribute\Contracts\Attribute
     */
    public function getAttributeByCode($code)
    {
        static $attributes = [];

        if (array_key_exists($code, $attributes)) {
            return $attributes[$code];
        }

        return $attributes[$code] = $this->findOneByField('code', $code);
    }

    /**
     * @param  \Webkul\Attribute\Contracts\AttributeFamily  $attributeFamily
     * @return \Webkul\Attribute\Contracts\Attribute
     */
    public function getFamilyAttributes($attributeFamily)
    {
        static $attributes = [];

        if (array_key_exists($attributeFamily->id, $attributes)) {
            return $attributes[$attributeFamily->id];
        }

        return $attributes[$attributeFamily->id] = $attributeFamily->custom_attributes;
    }

    /**
     * @return array
     */
    public function getPartial()
    {
        $attributes = $this->model->all();

        $trimmed = [];

        foreach($attributes as $key => $attribute) {
            if ($attribute->code != 'tax_category_id'
                && (
                    $attribute->type == 'select'
                    || $attribute->type == 'multiselect'
                    || $attribute->code == 'sku'
            )) {
                if ($attribute->options()->exists()) {
                    array_push($trimmed, [
                        'id'          => $attribute->id,
                        'name'        => $attribute->admin_name,
                        'type'        => $attribute->type,
                        'code'        => $attribute->code,
                        'has_options' => true,
                        'options'     => $attribute->options,
                    ]);
                } else {
                    array_push($trimmed, [
                        'id'          => $attribute->id,
                        'name'        => $attribute->admin_name,
                        'type'        => $attribute->type,
                        'code'        => $attribute->code,
                        'has_options' => false,
                        'options'     => null,
                    ]);
                }

            }
        }

        return $trimmed;
    }

    public function GetAttributeProperty()
    {
        $data = DB::select("SELECT attribute_translations.attribute_id id, attribute_translations.name admin_name, type
        FROM attributes
        INNER JOIN attribute_translations on attribute_translations.attribute_id = attributes.id
        WHERE type in ('text', 'price', 'select', 'multiselect', 'boolean', 'checkbox') 
        and locale = 'en'
        ORDER BY  admin_name");
        $main_data = [];
        foreach ($data as $key => $value) {
            $main_data[$key+1]['name'] = $value->admin_name;
            $main_data[$key+1]['type'] = $value->type;
            $main_data[$key+1]['options'] = $this->GetAttributeOptions($value->id);
        }

        return $main_data;
    }

    public function GetAttributeOptions($id)
    {
        return DB::select("SELECT id, admin_name FROM attribute_options
        WHERE attribute_id = $id");
    }

    public function GetAttributeOptionsByLabel($label)
    {
        return DB::select("SELECT attribute_options.id, attribute_options.admin_name FROM attribute_translations
        INNER JOIN attribute_options on attribute_options.attribute_id = attribute_translations.attribute_id
        WHERE attribute_translations.name = '$label'");
    }

    public function GetAttributeTypeRules($label)
    {
        $data['price'] = [
            [
                'operator' => '==',
                'label' => __('admin::app.promotions.catalog-rules.is-equal-to')
            ],
            [
                'operator'=> '!=',
                'label'=>  __('admin::app.promotions.catalog-rules.is-not-equal-to')
            ],
            [
                'operator'=> '>=',
                'label'=>  __('admin::app.promotions.catalog-rules.equals-or-greater-than')
            ],
            [
                'operator'=> '<=',
                'label'=>  __('admin::app.promotions.catalog-rules.equals-or-less-than')
            ],
            [
                'operator'=> '>',
                'label'=>  __('admin::app.promotions.catalog-rules.greater-than')
            ],
            [
                'operator'=> '<',
                'label'=>  __('admin::app.promotions.catalog-rules.less-than')
            ]
        ];
        $data['decimal'] = [
            [
                'operator'=> '==',
                'label'=>  __('admin::app.promotions.catalog-rules.is-equal-to')
            ],
            [
                'operator'=> '!=',
                'label'=>  __('admin::app.promotions.catalog-rules.is-not-equal-to')
            ],
            [
                'operator'=> '>=',
                'label'=>  __('admin::app.promotions.catalog-rules.equals-or-greater-than')
            ],
            [
                'operator'=> '<=',
                'label'=>  __('admin::app.promotions.catalog-rules.equals-or-less-than')
            ],
            [
                'operator'=> '>',
                'label'=>  __('admin::app.promotions.catalog-rules.greater-than')
            ],
            [
                'operator'=> '<',
                'label'=>  __('admin::app.promotions.catalog-rules.less-than')
            ]
        ];
        $data['integer'] = [
            [
                'operator'=> '==',
                'label'=>  __('admin::app.promotions.catalog-rules.is-equal-to')
            ],
            [
                'operator'=> '!=',
                'label'=>  __('admin::app.promotions.catalog-rules.is-not-equal-to')
            ],
            [
                'operator'=> '>=',
                'label'=>  __('admin::app.promotions.catalog-rules.equals-or-greater-than')
            ],
            [
                'operator'=> '<=',
                'label'=>  __('admin::app.promotions.catalog-rules.equals-or-less-than')
            ],
            [
                'operator'=> '>',
                'label'=>  __('admin::app.promotions.catalog-rules.greater-than')
            ],
            [
                'operator'=> '<',
                'label'=>  __('admin::app.promotions.catalog-rules.less-than')
            ]
        ];
        $data['text'] = [
            [
                'operator'=> '==',
                'label'=>  __('admin::app.promotions.catalog-rules.is-equal-to')
            ],
            [
                'operator'=> '!=',
                'label'=>  __('admin::app.promotions.catalog-rules.is-not-equal-to')
            ],
            [
                'operator'=> '{}',
                'label'=>  __('admin::app.promotions.catalog-rules.contain')
            ],
            [
                'operator'=> '!{}',
                'label'=>  __('admin::app.promotions.catalog-rules.does-not-contain')
            ],
        ];
        $data['boolean'] = [
            [
                'operator'=> '==',
                'label'=>  __('admin::app.promotions.catalog-rules.is-equal-to')
            ],
            [
                'operator'=> '!=',
                'label'=>  __('admin::app.promotions.catalog-rules.is-not-equal-to')
            ],
        ];
        $data['date'] = [
            [
                'operator'=> '==',
                'label'=>   __('admin::app.promotions.catalog-rules.is-equal-to')
            ],
            [
                'operator'=> '!=',
                'label'=>   __('admin::app.promotions.catalog-rules.is-not-equal-to')
            ],
            [
                'operator'=> '>=',
                'label'=>   __('admin::app.promotions.catalog-rules.equals-or-greater-than')
            ],
            [
                'operator'=> '<=',
                'label'=>   __('admin::app.promotions.catalog-rules.equals-or-less-than')
            ],
            [
                'operator'=> '>',
                'label'=>   __('admin::app.promotions.catalog-rules.greater-than')
            ],
            [
                'operator'=> '<',
                'label'=>   __('admin::app.promotions.catalog-rules.less-than')
            ],
        ];
        $data['datetime'] = [
            [
                'operator'=> '==',
                'label'=>   __('admin::app.promotions.catalog-rules.is-equal-to')
            ],
            [
                'operator'=> '!=',
                'label'=>   __('admin::app.promotions.catalog-rules.is-not-equal-to')
            ],
            [
                'operator'=> '>=',
                'label'=>   __('admin::app.promotions.catalog-rules.equals-or-greater-than')
            ],
            [
                'operator'=> '<=',
                'label'=>   __('admin::app.promotions.catalog-rules.equals-or-less-than')
            ],
            [
                'operator'=> '>',
                'label'=>   __('admin::app.promotions.catalog-rules.greater-than')
            ],
            [
                'operator'=> '<',
                'label'=>   __('admin::app.promotions.catalog-rules.less-than')
            ],
        ];
        $data['select'] = [
            [
                'operator'=> '==',
                'label'=>  __('admin::app.promotions.catalog-rules.is-equal-to')
            ],
            [
                'operator'=> '!=',
                'label'=>  __('admin::app.promotions.catalog-rules.is-not-equal-to')
            ],
        ];
        $data['radio'] = [
            [
                'operator'=> '==',
                'label'=>  __('admin::app.promotions.catalog-rules.is-equal-to')
            ],
            [
                'operator'=> '!=',
                'label'=>  __('admin::app.promotions.catalog-rules.is-not-equal-to')
            ],
        ];
        $data['multiselect'] = [
            [
                'operator'=> '{}',
                'label'=>  __('admin::app.promotions.catalog-rules.contains')
            ],
            [
                'operator'=> '!{}',
                'label'=>  __('admin::app.promotions.catalog-rules.does-not-contain')
            ],
        ];
        $data['checkbox'] = [
            [
                'operator'=> '{}',
                'label'=>  __('admin::app.promotions.catalog-rules.contains')
            ],
            [
                'operator'=> '!{}',
                'label'=>  __('admin::app.promotions.catalog-rules.does-not-contain')
            ],
        ];

        if ($label == "Categories") {
            return $data['multiselect'];
        } else {
            $da = DB::select("SELECT attributes.type FROM attribute_translations
            INNER JOIN attributes on attributes.id = attribute_translations.attribute_id
            WHERE attribute_translations.name = '$label'");
            return array_key_exists($da[0]->type, $data) ? $data[$da[0]->type] : [];
        }


    }
}

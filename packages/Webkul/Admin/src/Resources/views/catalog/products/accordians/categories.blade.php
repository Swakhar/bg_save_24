@if (count($categories))

{!! view_render_event('bagisto.admin.catalog.product.edit_form_accordian.categories.before', ['product' => $product]) !!}

<accordian :title="'{{ __('admin::app.catalog.products.categories') }}'" :active="false">
    <div slot="body">
        <div class="control-group select">
            <select class="control select2" style="width: 100%" name="categories" id="id" dff="">
                @foreach ($categories as $cate)
                    <?php var_dump($cate->category_id); ?>
                    <option value="{{ $cate->category_id }}" {{ ($cate->category_id == (isset($product->categories->pluck("id")[0])?$product->categories->pluck("id")[0]:"")) ? 'selected' : '' }} >
                        {{ ucwords(str_replace("-"," ",str_replace("/"," > ",$cate->url_path))) }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</accordian>

{!! view_render_event('bagisto.admin.catalog.product.edit_form_accordian.categories.after', ['product' => $product]) !!}

@endif
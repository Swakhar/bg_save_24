@if (count($categories))

{!! view_render_event('bagisto.admin.catalog.product.edit_form_accordian.categories.before', ['product' => $product]) !!}

<accordian :title="'{{ __('admin::app.catalog.products.categories') }}'" :active="false">
    <div slot="body">
        <div class="control-group select">
        <select class="control" name="categories" id="id" dff="">
            @foreach ($categories as $category)
                <option value="{{ $category->category_id }}" {{ ($category->category_id) == $product->categories->pluck("id")[0] ? 'selected' : '' }}>
                    {{ ucwords(str_replace("-"," ",str_replace("/"," > ",$category->url_path))) }}
                    @endforeach
                </option>
        </select>
        </div>
    </div>
</accordian>

{!! view_render_event('bagisto.admin.catalog.product.edit_form_accordian.categories.after', ['product' => $product]) !!}

@endif
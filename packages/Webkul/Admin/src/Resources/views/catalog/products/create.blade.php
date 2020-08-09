@extends('admin::layouts.content')

@section('page_title')
    {{ __('admin::app.catalog.products.add-title') }}
@stop

@section('css')
    <style>
        .table td .label {
            margin-right: 10px;
        }
        .table td .label:last-child {
            margin-right: 0;
        }
        .table td .label .icon {
            vertical-align: middle;
            cursor: pointer;
        }
    </style>
@stop

@section('content')
    <div class="content">
        <form method="POST" action="" @submit.prevent="onSubmit">

            <div class="page-header">
                <div class="page-title">
                    <h1>
                        <i class="icon angle-left-icon back-link" onclick="history.length > 1 ? history.go(-1) : window.location = '{{ url('/admin/dashboard') }}';"></i>

                        {{ __('admin::app.catalog.products.add-title') }}
                    </h1>
                </div>

                <div class="page-action">
                    <button type="submit" class="btn btn-lg btn-primary">
                        {{ __('admin::app.catalog.products.save-btn-title') }}
                    </button>
                </div>
            </div>

            <div class="page-content">
                @csrf()

                <?php $familyId = request()->input('family') ?>

                {!! view_render_event('bagisto.admin.catalog.product.create_form_accordian.general.before') !!}

                <accordian :title="'{{ __('admin::app.catalog.products.general') }}'" :active="true">
                    <div slot="body">

                        {!! view_render_event('bagisto.admin.catalog.product.create_form_accordian.general.controls.before') !!}

                        <div class="control-group" :class="[errors.has('type') ? 'has-error' : '']">
                            <label for="type" class="required">{{ __('admin::app.catalog.products.product-type') }}</label>
                            <select class="control" v-validate="'required'" id="type" name="type" {{ $familyId ? 'disabled' : '' }} data-vv-as="&quot;{{ __('admin::app.catalog.products.product-type') }}&quot;">

                                @foreach($productTypes as $key => $productType)
                                    <option value="{{ $key }}" {{ request()->input('type') == $productType['key'] ? 'selected' : '' }}>
                                        {{ $productType['name'] }}
                                    </option>
                                @endforeach

                            </select>

                            @if ($familyId)
                                <input type="hidden" name="type" value="{{ app('request')->input('type') }}"/>
                            @endif
                            <span class="control-error" v-if="errors.has('type')">@{{ errors.first('type') }}</span>
                        </div>

                        <div class="control-group" :class="[errors.has('attribute_family_id') ? 'has-error' : '']">
                            <label for="attribute_family_id" class="required">{{ __('admin::app.catalog.products.familiy') }}</label>
                            <select class="control" v-validate="'required'" id="attribute_family_id" name="attribute_family_id" {{ $familyId ? 'disabled' : '' }} data-vv-as="&quot;{{ __('admin::app.catalog.products.familiy') }}&quot;">
                                <option value=""></option>
                                @foreach ($families as $family)
                                    <option value="{{ $family->id }}" {{ ($familyId == $family->id || old('attribute_family_id') == $family->id) ? 'selected' : '' }}>{{ $family->name }}</option>
                                    @endforeach
                            </select>

                            @if ($familyId)
                                <input type="hidden" name="attribute_family_id" value="{{ $familyId }}"/>
                            @endif
                            <span class="control-error" v-if="errors.has('attribute_family_id')">@{{ errors.first('attribute_family_id') }}</span>
                        </div>

                        <div class="control-group" :class="[errors.has('sku') ? 'has-error' : '']">
                            <label for="sku" class="required">{{ __('admin::app.catalog.products.sku') }}</label>
                            <input type="text" v-validate="{ required: true, regex: /^[a-z0-9]+(?:-[a-z0-9]+)*$/ }" class="control" id="sku" name="sku" value="{{ request()->input('sku') ?: old('sku') }}" data-vv-as="&quot;{{ __('admin::app.catalog.products.sku') }}&quot;"/>
                            <span class="control-error" v-if="errors.has('sku')">@{{ errors.first('sku') }}</span>
                        </div>

                        {!! view_render_event('bagisto.admin.catalog.product.create_form_accordian.general.controls.after') !!}

                    </div>
                </accordian>

                {!! view_render_event('bagisto.admin.catalog.product.create_form_accordian.general.after') !!}

                @if ($familyId)

                    {!! view_render_event('bagisto.admin.catalog.product.create_form_accordian.configurable_attributes.before') !!}

                    <accordian :title="'{{ __('admin::app.catalog.products.configurable-attributes') }}'" :active="true">
                        <div slot="body">

                            {!! view_render_event('bagisto.admin.catalog.product.create_form_accordian.configurable_attributes.controls.before') !!}

                            <configurable-options-template></configurable-options-template>

                            {!! view_render_event('bagisto.admin.catalog.product.create_form_accordian.configurable_attributes.controls.after') !!}

                        </div>
                    </accordian>

                    {!! view_render_event('bagisto.admin.catalog.product.create_form_accordian.configurable_attributes.after') !!}
                @endif

            </div>

        </form>
    </div>
@stop

@push('scripts')
@push('scripts')

<script type="text/x-template" id="configurable-options">
    <div>
        <div class="table">
            <table>
                <thead>
                <tr>
                    <th>{{ __('admin::app.catalog.products.attribute-header') }}</th>
                    <th>{{ __('admin::app.catalog.products.attribute-option-header') }}</th>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                    <tr v-for="(config_attr, index) in configurable_attributes">
                        <td width="20%">
                            @{{ config_attr.admin_name }}
                        </td>
                        <td width="75%">
                            <multiselect
                                    v-model="config_attr.name"
                                    :options="config_attr.options"
                                    placeholder="Select Options"
                                    label="admin_name"
                                    :select-label="''"
                                    :multiple="true" :searchable="true"
                                    @input="select_change(index)"
                                    track-by="admin_name"></multiselect>
                            <input v-for="(name_field, index2) in config_attr.name" type="hidden"
                                   :name="`super_attributes[${config_attr.code}][]`" :value="name_field.id"/>
                        </td>
                        <td width="5%" class="actions">
                            <i class="icon trash-icon"></i>
                        </td>
                    </tr>
                </tbody>

            </table>
        </div>
    </div>
</script>

    <script>
        $(document).ready(function () {
            $('.label .cross-icon').on('click', function(e) {
                $(e.target).parent().remove();
            })

            $('.actions .trash-icon').on('click', function(e) {
                $(e.target).parents('tr').remove();
            })
        });

        Vue.component('configurable-options-template', {

            template: '#configurable-options',

            data: function() {
                return {
                    configurable_attributes: [],
                    configurable_attributes_admin_name: [],
                }
            },

            created: function () {
                @foreach($configurable_attributes as $key => $value)
                    this.configurable_attributes.push(@json($value));
                @endforeach

            },

            methods: {
                select_change: function (index) {
                    console.log(this.configurable_attributes[index].name)
                },



            },


            watch: {

            }
        })
    </script>
@endpush
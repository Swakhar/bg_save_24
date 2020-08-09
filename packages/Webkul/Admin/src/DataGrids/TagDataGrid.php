<?php

namespace Webkul\Admin\DataGrids;

use Illuminate\Support\Facades\DB;
use Webkul\Ui\DataGrid\DataGrid;

class TagDataGrid extends DataGrid
{
    protected $index = 'tag_id';

    protected $sortOrder = 'desc';

    public function prepareQueryBuilder()
    {
        $queryBuilder = DB::table('tags as tag')
            ->select('tag.id as tag_id', 'tag.admin_name', 'tag.status', 
            DB::raw('COUNT(DISTINCT ' . DB::getTablePrefix() . 'pt.product_id) as count'))
            ->leftJoin('product_tags as pt', 'tag.id', '=', 'pt.tag_id')
            ->groupBy('tag.id');


        $this->addFilter('tag_id', 'tag.id');

        $this->setQueryBuilder($queryBuilder);
    }

    public function addColumns()
    {
        $this->addColumn([
            'index'      => 'tag_id',
            'label'      => trans('admin::app.datagrid.id'),
            'type'       => 'number',
            'searchable' => false,
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'admin_name',
            'label'      => trans('admin::app.name'),
            'type'       => 'string',
            'searchable' => true,
            'sortable'   => true,
            'filterable' => true,
        ]);

        $this->addColumn([
            'index'      => 'status',
            'label'      => trans('admin::app.datagrid.status'),
            'type'       => 'boolean',
            'sortable'   => true,
            'searchable' => true,
            'filterable' => true,
            'wrapper'    => function($value) {
                if ($value->status == 1) {
                    return trans('admin::app.datagrid.active');
                } else {
                    return trans('admin::app.datagrid.inactive');
                }
            },
        ]);

        $this->addColumn([
            'index'      => 'count',
            'label'      => trans('admin::app.datagrid.no-of-products'),
            'type'       => 'number',
            'sortable'   => true,
            'searchable' => false,
            'filterable' => false,
        ]);
        
    }

    public function prepareActions()
    {
        $this->addAction([
            'title'  => trans('admin::app.datagrid.edit'),
            'method' => 'GET',
            'route'  => 'admin.catalog.tags.edit',
            'icon'   => 'icon pencil-lg-icon',
        ]);

        $this->addAction([
            'title'  => trans('admin::app.datagrid.delete'),
            'method' => 'POST',
            'route'  => 'admin.catalog.tags.delete',
            'icon'  => 'icon trash-icon',
        ]);
    }

    /*public function prepareMassActions()
    {
        $this->addMassAction([
            'type'   => 'delete',
            'action' => route('admin.catalog.industries.massdelete'),
            'label'  => trans('admin::app.datagrid.delete'),
            'index'  => 'admin_name',
            'method' => 'DELETE',
        ]);
    }*/
}

<?php

namespace App\DataTables;

use App\Models\Pelayanan;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PelayananDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('image', function ($pelayanan) {
                return view('admin.pelayanan.pelayanan_image', compact('pelayanan'));
            })
            ->addColumn('url', function($pelayanan) {
              return view('admin.pelayanan.pelayanan_url', compact('pelayanan'));
            })
            ->addColumn('action', function($pelayanan) {
              return view('admin.pelayanan.pelayanan_action', compact('pelayanan'));
            })
            ->rawColumns(['action', 'image', 'url'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Pelayanan $model): QueryBuilder
    {
        return $model->select('id', 'image', 'url');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('pelayanan-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('B<"row"<"col-6"l><"col-6"f>>rtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('pdf'),
                        Button::make('print'),
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
          Column::computed('image')
          ->title('Foto')->orderable(false)
          ->searchable(false)
          ->exportable(false)
          ->printable(false)
          ->width(60)
          ->addClass('text-center'),
          Column::computed('url')
          ->title('Url Instagram')->orderable(false)
          ->searchable(false)
          ->exportable(false)
          ->printable(false)
          ->width(60)
          ->addClass('text-center'),
          Column::computed('action')
                  ->title('Aksi')->orderable(false)
                  ->searchable(false)
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Pelayanan_' . date('YmdHis');
    }
}

<?php

namespace App\DataTables;

use App\Models\Aduan;
use App\Models\History;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class HistoryDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($aduan) {
                return view('admin.history.history_action', compact('aduan'));
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Aduan $model): QueryBuilder
    {
        return $model
            ->leftJoin('users', 'users.id', '=', 'aduan.id_user')
            ->leftJoin('subkategori', 'subkategori.id', '=', 'aduan.id_subkategori')
            ->where('aduan.id_status', 1)
            ->where('aduan.id_aduan', null)
            ->select('users.name AS users_name', 'subkategori.name AS subkategori_name', 'aduan.aduan', 'aduan.response', 'aduan.id');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('history-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('B<"row"<"col-6"l><"col-6"f>>rtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([Button::make('excel'), Button::make('pdf'), Button::make('print')]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('users_name')->title('Nama'),
            Column::make('subkategori_name')->title('Kategori'),
            Column::make('aduan')->title('Aduan'),
            Column::make('response')->title('Respon'),
            Column::computed('action')
                ->title('Publish')
                ->orderable(false)
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
        return 'History_' . date('YmdHis');
    }
}

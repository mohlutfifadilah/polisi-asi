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
            ->addColumn('action', 'history.action')
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Aduan $model): QueryBuilder
    {
        return $model
            ->leftJoin('users', 'users.id', '=', 'aduan.id_user')
            ->leftJoin('subkategori', 'subkategori.id', '=', 'aduan.id_subkategori')
            ->select('users.name AS users_name', 'users.age AS users_age', 'users.job_or_position AS users_job_or_position', 'subkategori.name AS subkategori_name', 'aduan.aduan', 'aduan.response');
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
            Column::make('users_name')->title('Nama'),
            Column::make('users_age')->title('Umur'),
            Column::make('users_job_or_position')->title('Jabatan/Pekerjaan'),
            Column::make('subkategori_name')->title('Kategori'),
            Column::make('aduan')->title('Aduan'),
            Column::make('response')->title('Respon'),
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

<?php

namespace App\DataTables;

use App\Models\Aduan;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AduanDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $userRole = Auth::user()->id_role;
        if ($userRole != 1) {
            return (new EloquentDataTable($query))
                ->addColumn('action', function ($aduan) {
                    return view('admin.aduan.aduan_action', compact('aduan'));
                })
                ->addColumn('response', function ($aduan) use ($userRole) {
                    if (($userRole === 3) | ($userRole === 4 || $userRole === 6)) {
                        // Hanya tampilkan kolom respon jika user memiliki id_role 3
                        return view('admin.aduan.aduan_response', compact('aduan'));
                    } else {
                        // Jika bukan id_role 3, kosongkan kolom respon
                        return '';
                    }
                })
                ->addColumn('bukti', function ($aduan) {
                    return view('admin.aduan.aduan_bukti', compact('aduan'));
                })
                ->setRowId('id')
                ->rawColumns(['action', 'response']);
        } else {
            return (new EloquentDataTable($query))
                ->addColumn('status', function ($aduan) {
                    return view('admin.aduan.aduan_status', compact('aduan'));
                  })
                  ->addColumn('bukti', function ($aduan) {
                  return view('admin.aduan.aduan_bukti', compact('aduan'));
                    // $url = asset('storage/app/aduan/' . $aduan->bukti);
                    // return '<img src="' . $url . '" border="0" width="40" class="img-rounded" align="center" />';
                })
                ->setRowId('id')
                ->rawColumns(['status']);
        }
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Aduan $model): QueryBuilder
    {
        $userIdRole = Auth::user()->id_role;
        if ($userIdRole != 1) {
            return $model
                ->leftJoin('users', 'users.id', '=', 'aduan.id_user')
                ->leftJoin('subkategori', 'subkategori.id', '=', 'aduan.id_subkategori')
                ->where('aduan.id_role', $userIdRole)
                ->where('aduan.id_status', 0)
                ->select('users.name AS users_name', 'users.age AS users_age', 'users.job_or_position AS users_job_or_position', 'aduan.bukti', 'subkategori.name AS subkategori_name', 'aduan.aduan')
                ->limit(1);
        } else {
            return $model
                ->leftJoin('users', 'users.id', '=', 'aduan.id_user')
                ->leftJoin('subkategori', 'subkategori.id', '=', 'aduan.id_subkategori')
                ->select('users.name AS users_name', 'aduan.id_role', 'users.age AS users_age', 'users.job_or_position AS users_job_or_position', 'aduan.bukti', 'subkategori.name AS subkategori_name', 'aduan.aduan')
                ->where('aduan.id_aduan', null)
                ->limit(1);
        }
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('aduan-table')
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
        if (Auth::user()->id_role === 1) {
            return [
                Column::make('users_name')->title('Nama'),
                // Column::make('users_age')->title('Umur'),
                // Column::make('users_job_or_position')->title('Jabatan/Pekerjaan'),
                Column::make('subkategori_name')->title('Kategori'),
                Column::make('aduan')->title('Aduan'),
                Column::computed('bukti')
                    ->title('Bukti')
                    ->orderable(false)
                    ->searchable(false)
                    ->exportable(false)
                    ->printable(false)
                    ->width(60)
                    ->addClass('text-center'),
                Column::computed('status')
                    ->title('Status')
                    ->orderable(false)
                    ->searchable(false)
                    ->exportable(false)
                    ->printable(false)
                    ->width(60)
                    ->addClass('text-center'),
            ];
        } else if (Auth::user()->id_role === 2){
          return [
                Column::make('users_name')->title('Nama'),
                // Column::make('users_age')->title('Umur'),
                // Column::make('users_job_or_position')->title('Jabatan/Pekerjaan'),
                Column::make('subkategori_name')->title('Kategori'),
                Column::make('aduan')->title('Aduan'),
                Column::computed('bukti')
                    ->title('Bukti')
                    ->orderable(false)
                    ->searchable(false)
                    ->exportable(false)
                    ->printable(false)
                    ->width(60)
                    ->addClass('text-center'),
                Column::computed('action')
                    ->title('Disposisi')
                    ->orderable(false)
                    ->searchable(false)
                    ->exportable(false)
                    ->printable(false)
                    ->width(60)
                    ->addClass('text-center')
            ];
        }else if(Auth::user()->id_role === 3 || Auth::user()->id_role === 4 || Auth::user()->id_role === 6){
          return [
                Column::make('users_name')->title('Nama'),
                // Column::make('users_age')->title('Umur'),
                // Column::make('users_job_or_position')->title('Jabatan/Pekerjaan'),
                Column::make('subkategori_name')->title('Kategori'),
                Column::make('aduan')->title('Aduan'),
                Column::computed('bukti')
                    ->title('Bukti')
                    ->orderable(false)
                    ->searchable(false)
                    ->exportable(false)
                    ->printable(false)
                    ->width(60)
                    ->addClass('text-center'),
                Column::computed('action')
                    ->title('Disposisi')
                    ->orderable(false)
                    ->searchable(false)
                    ->exportable(false)
                    ->printable(false)
                    ->width(60)
                    ->addClass('text-center'),
                Column::computed('response')
                    ->title('Aksi')
                    ->orderable(false)
                    ->searchable(false)
                    ->exportable(false)
                    ->printable(false)
                    ->width(60)
                    ->addClass('text-center'),
            ];
        }
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Aduan_' . date('YmdHis');
    }
}

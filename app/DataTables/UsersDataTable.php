<?php

namespace App\DataTables;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function($user) {
              // $user = $user->name;
              return view('admin.users.user_action', compact('user'));
            })
            ->setRowId('id')
            ->addColumn('user_info', function ($user) {
                return view('admin.users.user_info', compact('user'));
            })
            ->addColumn('user_role', function ($user) {
                $role = Role::find($user->id_role);
                return view('admin.users.user_role', compact('role'));
            })
            ->rawColumns(['user_info', 'action']);;
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {
        return $model->leftJoin('role', 'users.id_role', '=', 'role.id')->select('users.profile_photo_path', 'users.name', 'users.email', 'users.age', 'users.job_or_position', 'users.address', 'role.name AS role_name');

    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
    ->setTableId('users-table')
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
            Column::make('name')->title('Nama'),
            Column::make('email')->title('Email'),
            Column::make('role_name')->title('Role')->searchable(false),
            Column::make('age')->title('Umur'),
            Column::make('job_or_position')->title('Pekerjaan'),
            Column::make('address')->title('Alamat'),
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
        return 'Users_' . date('YmdHis');
    }

}

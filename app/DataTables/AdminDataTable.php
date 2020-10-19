<?php

namespace App\DataTables;

use App\Model\Admin;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class AdminDataTable extends DataTable{

    private $displayStart;
    private $pageLength;
    private $column;
    private $dir;

    public function __construct($displayStart,$pageLength,$column,$dir){
        $this->pageLength =$pageLength;
        $this->displayStart = $displayStart;
        $this->column = $column;
        $this->dir = $dir;
    }

    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('status', 'admin.admins.btn.status')
            ->addColumn('checkbox', 'admin.admins.btn.checkbox')
            ->addColumn('edit', 'admin.admins.btn.edit')
            ->addColumn('delete', 'admin.admins.btn.delete')
            ->rawColumns([
                'status',
                'edit',
                'delete',
                'checkbox',
            ])
            ;
    }

    /**
     * Get query source of dataTable.
     *
     *
     * @return Builder
     */
    public function query()
    {
        return Admin::query();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    // أزاز استخراج الجدول كملف اكسل
    public function html()
    {
        return $this->builder()
            ->setTableId('admindatatable-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->displayStart($this->displayStart)
            ->pageLength($this->pageLength)
            ->orderBy($this->column,$this->dir)
            ->dom("<'row'<'col-sm-12 col-md-12'B>>" .
                "<'row-padding'>".
                "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" .
                "<'row'<'col-sm-12'tr>>" .
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>")
            ->orderBy(1)
            ->lengthMenu([[25,50,100,-1],[25,50,100,trans('admin.All Record')]])
            ->language(datatableLang())
            /*
             * this use for search inside columns
            ->initComplete('function () {
                this.api().columns([1,2,3,4,5]).every(function () {
                    var column = this;
                    var input = document.createElement("input");
                    $(input).appendTo($(column.footer()).empty())
                    .on("keyup", function () {
                        var val = $.fn.dataTable.util.escapeRegex($(this).val());

                        column.search(val ? val : "", true, false).draw();
                    });
                });
            }')
            */
            ->buttons(
                Button::make('create')
                    ->className('btn btn-success btn-sm')
                    ->text('<i class="fas fa-plus fa-sm"></i> '.trans("admin.New Admin")),
                Button::make('export')
                    ->className('btn btn-info btn-sm')
                    ->text('<i class="fas fa-download fa-sm"></i> '.trans('admin.Export')),
                Button::make('print')
                    ->className('btn btn-primary btn-sm')
                    ->text('<i class="fas fa-print fa-sm"></i> '.trans('admin.Print')),
                Button::make('reset')
                    ->className('btn btn-default btn-sm')
                    ->text('<i class="fas fa-undo fa-sm"></i> '.trans('admin.Reset')),
                Button::make('reload')
                    ->className('btn btn-warning btn-sm')
                    ->text('<i class="fas fa-refresh fa-sm"></i> '.trans('admin.Reload')),

                Button::make('pdf')->className('btn btn-dark btn-sm'),
                Button::make('excel')->className('btn btn-light btn-sm'),
                Button::make('csv')->className('btn btn-secondary btn-sm'),
                Button::make('create')->action('www.google.com')
                    ->className('btn btn-danger del-btn btn-sm')
                    ->text('<i class="fas fa-trash fa-sm"></i> '.trans('admin.Delete'))

            );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    // أسماء اعمدة الجدول
    protected function getColumns()
    {
        return [
            Column::computed('checkbox')
                ->title('<input type="checkbox" class="check-all" onclick="check_all()">')
                ->exportable(false)
                ->printable(false)
                ->searchable(false)
                ->orderable(false)
                ->addClass('text-center'),
            Column::make('id')->name('id')->title('ID')->width(0),
            Column::make('name')->name('name')->title(trans('admin.Name')),
            Column::make('email')->name('email')->title(trans('admin.Email')),
            Column::make('job_title')->name('job_title')->title(trans('admin.Job title')),
            Column::computed('status')->name('status')->title(trans('admin.Status'))->addClass('text-center'),
            Column::computed('edit')
                ->title(trans('admin.Edit'))
                ->exportable(false)
                ->printable(false)
                ->searchable(false)
                ->orderable(false)
                ->addClass('text-center'),
            Column::computed('delete')
                ->title(trans('admin.Delete'))
                ->exportable(false)
                ->printable(false)
                ->searchable(false)
                ->orderable(false)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Admin_' . date('YmdHis');
    }
}

<?php

namespace App\DataTables;

use App\Model\City;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CityDataTable extends DataTable{

    private $displayStart =0;
    private $pageLength =10;
    private $column =0;
    private $dir ='desc';

//    public function __construct($displayStart,$pageLength,$column,$dir){
//        $this->pageLength =$pageLength;
//        $this->displayStart = $displayStart;
//        $this->column = $column;
//        $this->dir = $dir;
//    }


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
            ->addColumn('checkbox', 'admin.cities.btn.checkbox')
            ->addColumn('edit', 'admin.cities.btn.edit')
            ->addColumn('delete', 'admin.cities.btn.delete')
            ->rawColumns([
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
        return City::query();
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
            ->setTableId('citydatatable-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom("<'row'<'col-sm-12 col-md-12'B>>" .
                "<'row-padding'>".
                "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" .
                "<'row'<'col-sm-12'tr>>" .
                "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>")
            ->orderBy(1)
            ->lengthMenu([[10,25,50,-1],[10,25,50,trans('admin.All Record')]])
            ->language(datatableLang())
            ->buttons(
                Button::make('create')
                    ->className('btn btn-success btn-sm')
                    ->text('<i class="fas fa-plus fa-sm"></i> '.trans("admin.New City")),
                Button::make('print')
                    ->className('btn btn-primary btn-sm')
                    ->text('<i class="fas fa-print fa-sm"></i> '.trans('admin.Print')),
                Button::make('excel')->className('btn btn-info btn-sm')
                    ->text('<i class="fas fa-file-excel"></i> '.trans('admin.Excel')),
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
            Column::make('city_name_ar')->name('city_name_ar')->title(trans('admin.Arabic City Name')),
            Column::make('city_name_en')->name('city_name_en')->title(trans('admin.English City Name')),
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
        return 'City_' . date('YmdHis');
    }
}

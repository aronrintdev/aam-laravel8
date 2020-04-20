<?php

namespace App\DataTables;

use App\Models\Swing;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use App\Service\SlyQueryDataTable;

class SwingDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new SlyQueryDataTable($query);

        return $dataTable->addColumn('action', 'swings.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Swing $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Swing $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '120px', 'printable' => false], 1)
            ->parameters([
                'dom'       => 'Bfrtip',
                'stateSave' => true,
                'order'     => [[0, 'desc']],
                'buttons'   => [
                    ['extend' => 'create', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'export', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'print', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reset', 'className' => 'btn btn-default btn-sm no-corner',],
                    ['extend' => 'reload', 'className' => 'btn btn-default btn-sm no-corner',],
                ],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
//            'LessLogID',
            'AcademyID',
//            'BillError',
//            'InstructorID',
            'DateAnalyzed',
//            'ProCharge',
//            'Rating',
            'SwingStatusID',
//            'DateRated',
            'DateUploaded',
            'DateAccepted',
            'Description',
//            'Paid',
            'CCSwingID',
            'VideoPath',
            'VimeoID',
//            'Billed',
            'Deleted',
            'AccountID',
//            'SocialQ',
//            'ProInvoice',
//            'Charge',
//            'SportID',
//            'BillDate',
            'AnalysisPath',
//            'LastViewed',
//            'RatingIP',
//            'LastViewByInstructor',
//            'Description_U',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'swingsdatatable_' . time();
    }
}

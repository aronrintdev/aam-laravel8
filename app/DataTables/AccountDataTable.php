<?php

namespace App\DataTables;

use App\Models\Account;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;
use App\Service\SlyQueryDataTable;

class AccountDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'accounts.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Account $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Account $model)
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
//            'OldAccountID',
//            'CardExpires',
//            'BillPhone',
//            'LastName_U',
//            'LessonLevel',
//            'CxnSpeed',
            'FirstName',
            'LastName',
//            'Birthdate',
//            'AlwaysUseDefault',
//            'CardType',
//            'Phone',
//            'AutoSMS',
//            'NotifyMe',
            'Email',
//            'Vimeo_Token',
//            'PasswordEx',
//            'PasswordSalt',
//            'BillState',
//            'Address',
//            'Optout',
//            'Password',
//            'LessonLocation',
//            'SiteID',
//            'CardNumberEx',
//            'Zip',
//            'BillPhoneExt',
//            'BillStreet',
//            'LessonAgeRange',
//            'OS',
//            'Balance',
//            'CardCVV',
//            'InstructorID',
//            'CardDescript',
//            'ProCodeUpdate',
//            'BillApt',
//            'CookieLogin',
//            'AutoFB',
//            'Closed',
//            'FB_OAuth_Token',
//            'BillZip',
//            'City',
//            'CardHolder',
//            'FB_UserID',
//            'Country',
//            'State',
//            'BillCompany',
//            'FB_SessionKey',
//            'LessonGender',
//            'LastAccessed',
//            'DateOpened',
//            'PasswordHash',
//            'AddressHeader',
//            'BillCity',
//            'CardNumber',
//            'LessonFeeRange',
//            'FirstName_U',
//            'Gender'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'accountsdatatable_' . time();
    }
}

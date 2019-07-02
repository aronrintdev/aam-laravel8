<?php

namespace App\DataTables;

use App\Models\Academy;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class AcademyDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable->addColumn('action', 'academies.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Academy $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Academy $model)
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
            ->addAction(['width' => '120px', 'printable' => false], 1)
            ->minifiedAjax()
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
            'HiddenFlag',
//            'AdamPaid',
//            'BaseColorLt',
//            'MinMonthlyLessonsInc',
//            'DateHolidayEnds',
            'DisplayV1Models',
//            'YT_Password',
            'Name',
            'AdminAccountID',
            'ContactName',
            'ContactEmail',
//            'SendMoveEmail',
//            'HidePoweredBy',
            'Logo',
//            'ContractPDF',
            'Live',
//            'ProAdv_Serial',
//            'TW_Secret',
//            'CreatedWebURL',
            'PrivateFlag',
//            'FB_UserID',
//            'SecondarySalesPerson',
//            'SampleLesson',
//            'DateTraining',
//            'NotBuiltFlag',
            'LogInGraphic',
            'ModelsPage',
//            'EndDate',
//            'FB_OAuth_Token',
//            'PromoID',
//            'BillingStatusID',
//            'DivideByThreshold',
//            'SportID',
//            'BodyText',
//            'TW_Password',
//            'SelectedColorMed',
//            'MailChimpKey',
//            'FB_URL_Long',
//            'SecureFlag',
//            'DateLessonCaddy',
//            'StartDate',
            'DateAdded',
//            'BaseColorMed',
//            'MinMonthlyBilling',
//            'CreatedWebPW',
//            'HashTagFlag',
//            'TopTextSelectedColor',
//            'DateTrainingContact',
//            'SendAnalysisEmail',
//            'LessonCharge',
//            'CommissionPercentage',
//            'EndNotes',
//            'CreditCard',
//            'TW_Key',
            'DateV1ProApp',
//            'CreatedWebLogin',
//            'TopTextBaseColor',
//            'FB_FanPage_ID',
//            'EmailBody',
//            'DiscountFlag',
//            'V1GA_Locker',
//            'AnnualRenewFee',
//            'PrePayedMonths',
//            'SalesPerson',
//            'SelectedColor',
//            'FreeLessons',
            'RatingFlag',
//            'BodyFont',
//            'FrontPageText2',
//            'YT_URL',
//            'YT_UserName',
//            'YT_Login',
//            'YT_Refresh',
//            'YT_ChannelFlag',
//            'CreditCard_Exp',
//            'CommissionPercentage_YearPlus',
//            'SplitCommission',
//            'BG_LightDark',
//            'SaveAsFlag',
//            'TopTextFont',
//            'FB_SessionKey',
//            'IFrame_URL',
//            'IFrame_Width',
//            'IFrame_Height',
//            'BGColor',
//            'BaseColor',
//            'CommissionPercentage_Overage',
            'AcademyCountry',
//            'CreditCard_Name',
            'DisplayV1Drills',
//            'PlayerPartnerLogos',
            'Description',
//            'TW_Login',
//            'FrontPageText1',
//            'SelectedColorLt',
            'Startup',
//            'FB_URL',
//            'DateV1ProSoftware',
            'BannerText',
//            'LessonThreshold',
//            'Translate',
//            'Notes'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'academiesdatatable_' . time();
    }
}

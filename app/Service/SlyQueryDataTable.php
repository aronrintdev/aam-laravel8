<?php
namespace App\Service;

use Illuminate\Support\Str;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Utilityes\Helper;

class SlyQueryDataTable extends
    EloquentDataTable {

    /**
     * Prepare search keyword based on configurations.
     *
     * Don't put % around both parts of keyword
     * putting % in front and back removes any
     * indexes and always does full table scane
     *
     * This is controlled by the "smart" setting
     *
     * @override
     * @param string $keyword
     * @return string
     */
    protected function prepareKeyword($keyword)
    {
        if ($this->config->isCaseInsensitive()) {
            $keyword = Str::lower($keyword);
        }

        if ($this->config->isWildcard()) {
            $keyword = Helper::wildcardLikeString($keyword);
        }

        if ($this->config->isSmartSearch()) {
            $keyword = "$keyword%";
        }

        return $keyword;
    }
}

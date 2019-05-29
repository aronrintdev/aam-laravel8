<?php

namespace App\Repositories;

use App\Models\Swing;
use App\Repositories\BaseRepository;

/**
 * Class SwingRepository
 * @package App\Repositories
 * @version April 2, 2019, 10:19 pm UTC
*/

class SwingRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'AccountID',
        'DateUploaded'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Swing::class;
    }
}

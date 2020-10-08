<?php

namespace App\Repositories;

use App\Models\SwingExample;
use App\Models\SwingExamplePlus;
use App\Repositories\BaseRepository;

/**
 * Class SwingExamplePlusRepository
 * @package App\Repositories
 * @version April 2, 2019, 10:19 pm UTC
*/

class SwingExamplePlusRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'SwingID',
        'AccountID',
        'SwingStatusID',
        'InstructorID',
        'DateUploaded',
        'DateAnalyzed',
        'Deleted',
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
        return SwingExamplePlus::class;
    }
}

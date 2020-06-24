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
        'SwingID',
        'AccountID',
        'SwingStatusID',
        'InstructorID',
        'DateUploaded',
        'DateAnalyzed',
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

    /**
     * Retrieve all records with given filter criteria
     *
     * @param array $search
     * @param int|null $skip
     * @param int|null $limit
     * @param array $columns
     *
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function searchBrokenVideos($search = [], $dateAnalyzed, $skip = null, $limit = null, $columns = ['*'])
    {
        $query = $this->model->newQuery();

        if (count($search)) {
            foreach($search as $key => $value) {
                if (in_array($key, $this->getFieldsSearchable())) {
                    if (is_array($value) && $value[0] instanceof \Datetime) {
                        $query->where($key, $value[1], $value[0]->format('Y-m-d H:i:s.v'));
                    } elseif (is_array($value)) {
                        $query->whereIn($key, $value);
                    } else {
                        $query->where($key, $value);
                    }
                }
            }
        }
        //jake thurm experiencing problems when we try to combine
        //type 2 and 3.  We might need this in the future,
        //but for now we also want to sort by DateAnalyzed DESC
        //so joining type 2 where no DateAnalyzed exists is
        //not worth it.
        $query->orWhere('DateAnalyzed', '>=', $dateAnalyzed);
        //join type 2 with type 3
        /*
        $query->where(function($q) use ($dateAnalyzed) {
            $q->orWhere('DateAnalyzed', '>=', $dateAnalyzed);
            $q->orWhereNull('DateAnalyzed');
            return $q;
        });
         */

        if (!is_null($skip)) {
            $query->skip($skip);
        }

        if (!is_null($limit)) {
            $query->limit($limit);
        }
        $query->orderBy('DateAnalyzed', 'DESC');

        return $query->get($columns);
    }

    /**
     * Copy of SP Account_ListSwings
     *
     * CREATE PROCEDURE [isa_login].[Account_ListSwings](@AccountID integer)
     */
    public function loadStudentSwings($instructorId) {
        $spAccountListSwings =
        "
            SELECT
              dbo.Swings.SwingID
            , dbo.Swings.DateUploaded
            , dbo.Swings.Description
            , dbo.Swings.SwingStatusID
            , dbo.SwingStatusIDs.Description AS SwingStatus
            , dbo.Accounts.FirstName + ' ' + dbo.Accounts.LastName AS Instructor
            , dbo.Swings.VideoPath
            , dbo.Swings.AnalysisPath
            , dbo.Swings.SportID
            , dbo.SportsIDs.Description AS SportDesc
            , dbo.Swings.DateAnalyzed
            , dbo.Swings.InstructorID
            , dbo.Swings.DateAccepted
            , dbo.Swings.Description_U
            , dbo.Swings.AcademyID
            , dbo.Swings.Rating
            FROM
            dbo.Swings
                INNER JOIN dbo.SwingStatusIDs
                    ON dbo.Swings.SwingStatusID = dbo.SwingStatusIDs.SwingStatusID
                INNER JOIN dbo.SportsIDs
                    ON dbo.Swings.SportID = dbo.SportsIDs.SportID
                INNER JOIN dbo.Accounts
                    ON dbo.Swings.InstructorID = dbo.Accounts.AccountID
            WHERE
                    (dbo.Swings.AccountID = :instructorId)
                AND (dbo.Swings.Deleted = 0)
            ORDER BY dbo.Swings.SwingID DESC
";
        \DB::select($spAccountListSwings, ['instructorId' => $instructorId]);
    }
}

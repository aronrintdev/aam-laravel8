<?php

namespace App\Http\Controllers;

use App\DataTables\AcademyDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateAcademyRequest;
use App\Http\Requests\UpdateAcademyRequest;
use App\Repositories\AcademyRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class AcademyController extends AppBaseController
{
    /** @var  AcademyRepository */
    private $academyRepository;

    public function __construct(AcademyRepository $academyRepo)
    {
        $this->academyRepository = $academyRepo;
    }

    /**
     * Display a listing of the Academy.
     *
     * @param AcademyDataTable $academyDataTable
     * @return Response
     */
    public function index(AcademyDataTable $academyDataTable)
    {
        return $academyDataTable->render('academies.index');
    }

    /**
     * Show the form for creating a new Academy.
     *
     * @return Response
     */
    public function create()
    {
        return view('academies.create');
    }

    /**
     * Store a newly created Academy in storage.
     *
     * @param CreateAcademyRequest $request
     *
     * @return Response
     */
    public function store(CreateAcademyRequest $request)
    {
        return;
        $input = $request->all();

        $academy = $this->academyRepository->create($input);

        Flash::success('Academy saved successfully.');

        return redirect(route('academies.index'));
    }

    /**
     * Display the specified Academy.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $academy = $this->academyRepository->find($id);

        if (empty($academy)) {
            Flash::error('Academy not found');

            return redirect(route('academies.index'));
        }

        return view('academies.show')->with('academy', $academy)->with('instructors', $academy->instructors);
    }

    /**
     * Show the form for editing the specified Academy.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        return;
        $academy = $this->academyRepository->find($id);

        if (empty($academy)) {
            Flash::error('Academy not found');

            return redirect(route('academies.index'));
        }

        return view('academies.edit')->with('academy', $academy);
    }

    /**
     * Update the specified Academy in storage.
     *
     * @param  int              $id
     * @param UpdateAcademyRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAcademyRequest $request)
    {
        return;
        $academy = $this->academyRepository->find($id);

        if (empty($academy)) {
            Flash::error('Academy not found');

            return redirect(route('academies.index'));
        }

        $academy = $this->academyRepository->update($request->all(), $id);

        Flash::success('Academy updated successfully.');

        return redirect(route('academies.index'));
    }

    /**
     * Remove the specified Academy from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        return;
        $academy = $this->academyRepository->find($id);

        if (empty($academy)) {
            Flash::error('Academy not found');

            return redirect(route('academies.index'));
        }

        $this->academyRepository->delete($id);

        Flash::success('Academy deleted successfully.');

        return redirect(route('academies.index'));
    }
}

<?php

namespace App\Http\Controllers;

use App\DataTables\SwingDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateSwingRequest;
use App\Http\Requests\UpdateSwingRequest;
use App\Repositories\SwingRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class SwingController extends AppBaseController
{
    /** @var  SwingRepository */
    private $swingRepository;

    public function __construct(SwingRepository $swingRepo)
    {
        $this->swingRepository = $swingRepo;
    }

    /**
     * Display a listing of the Swing.
     *
     * @param SwingDataTable $swingDataTable
     * @return Response
     */
    public function index(SwingDataTable $swingDataTable)
    {
        return $swingDataTable->render('swings.index');
    }

    /**
     * Show the form for creating a new Swing.
     *
     * @return Response
     */
    public function create()
    {
        return view('swings.create');
    }

    /**
     * Store a newly created Swing in storage.
     *
     * @param CreateSwingRequest $request
     *
     * @return Response
     */
    public function store(CreateSwingRequest $request)
    {
        $input = $request->all();

        $swing = $this->swingRepository->create($input);

        Flash::success('Swing saved successfully.');

        return redirect(route('swings.index'));
    }

    /**
     * Display the specified Swing.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $swing = $this->swingRepository->find($id);

        if (empty($swing)) {
            Flash::error('Swing not found');

            return redirect(route('swings.index'));
        }

        return view('swings.show')->with('swing', $swing);
    }

    /**
     * Show the form for editing the specified Swing.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $swing = $this->swingRepository->find($id);

        if (empty($swing)) {
            Flash::error('Swing not found');

            return redirect(route('swings.index'));
        }

        return view('swings.edit')->with('swing', $swing);
    }

    /**
     * Update the specified Swing in storage.
     *
     * @param  int              $id
     * @param UpdateSwingRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSwingRequest $request)
    {
        $swing = $this->swingRepository->find($id);

        if (empty($swing)) {
            Flash::error('Swing not found');

            return redirect(route('swings.index'));
        }

        $swing = $this->swingRepository->update($request->all(), $id);

        Flash::success('Swing updated successfully.');

        return redirect(route('swings.index'));
    }

    /**
     * Remove the specified Swing from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $swing = $this->swingRepository->find($id);

        if (empty($swing)) {
            Flash::error('Swing not found');

            return redirect(route('swings.index'));
        }

        $this->swingRepository->delete($id);

        Flash::success('Swing deleted successfully.');

        return redirect(route('swings.index'));
    }
}

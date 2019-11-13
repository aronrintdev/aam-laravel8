<?php

namespace App\Http\Controllers;

use App\DataTables\AccountAvatarDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateAccountAvatarRequest;
use App\Http\Requests\UpdateAccountAvatarRequest;
use App\Repositories\AccountAvatarRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class AccountAvatarController extends AppBaseController
{
    /** @var  AccountAvatarRepository */
    private $accountAvatarRepository;

    public function __construct(AccountAvatarRepository $accountAvatarRepo)
    {
        $this->accountAvatarRepository = $accountAvatarRepo;
    }

    /**
     * Display a listing of the AccountAvatar.
     *
     * @param AccountAvatarDataTable $accountAvatarDataTable
     * @return Response
     */
    public function index(AccountAvatarDataTable $accountAvatarDataTable)
    {
        return $accountAvatarDataTable->render('account_avatars.index');
    }

    /**
     * Show the form for creating a new AccountAvatar.
     *
     * @return Response
     */
    public function create()
    {
        return view('account_avatars.create');
    }

    /**
     * Store a newly created AccountAvatar in storage.
     *
     * @param CreateAccountAvatarRequest $request
     *
     * @return Response
     */
    public function store(CreateAccountAvatarRequest $request)
    {
        $input = $request->all();

        $accountAvatar = $this->accountAvatarRepository->create($input);

        Flash::success('Account Avatar saved successfully.');

        return redirect(route('accountAvatars.index'));
    }

    /**
     * Display the specified AccountAvatar.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $accountAvatar = $this->accountAvatarRepository->find($id);

        if (empty($accountAvatar)) {
            Flash::error('Account Avatar not found');

            return redirect(route('accountAvatars.index'));
        }

        return view('account_avatars.show')->with('accountAvatar', $accountAvatar);
    }

    /**
     * Show the form for editing the specified AccountAvatar.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $accountAvatar = $this->accountAvatarRepository->find($id);

        if (empty($accountAvatar)) {
            Flash::error('Account Avatar not found');

            return redirect(route('accountAvatars.index'));
        }

        return view('account_avatars.edit')->with('accountAvatar', $accountAvatar);
    }

    /**
     * Update the specified AccountAvatar in storage.
     *
     * @param  int              $id
     * @param UpdateAccountAvatarRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAccountAvatarRequest $request)
    {
        $accountAvatar = $this->accountAvatarRepository->find($id);

        if (empty($accountAvatar)) {
            Flash::error('Account Avatar not found');

            return redirect(route('accountAvatars.index'));
        }

        $accountAvatar = $this->accountAvatarRepository->update($request->all(), $id);

        Flash::success('Account Avatar updated successfully.');

        return redirect(route('accountAvatars.index'));
    }

    /**
     * Remove the specified AccountAvatar from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $accountAvatar = $this->accountAvatarRepository->find($id);

        if (empty($accountAvatar)) {
            Flash::error('Account Avatar not found');

            return redirect(route('accountAvatars.index'));
        }

        $this->accountAvatarRepository->delete($id);

        Flash::success('Account Avatar deleted successfully.');

        return redirect(route('accountAvatars.index'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Presenters\PaginationPresenter;
use App\Http\Requests\UserRequest;
use Core\Modules\User\UseCases\CreatedUseCase;
use Core\Modules\User\UseCases\ListUseCase;
use Core\Modules\User\UseCases\DTO\List\Input as ListInput;
use Core\Modules\User\UseCases\DTO\Created\Input as CreatedInput;
use Core\Modules\User\UseCases\DTO\Find\Input as FindInput;
use Core\Modules\User\UseCases\DTO\Updated\Input as UpdatedInput;
use Core\Modules\User\UseCases\FindUseCase;
use Core\Modules\User\UseCases\UpdatedUseCase;
use Core\Shared\ValueObjects\Input\LoginInputObject;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(ListUseCase $uc, PaginationPresenter $paginationPresenter, Request $request)
    {
        $ret = $uc->handle(new ListInput(filter: $request->all()));

        return view('admin.user.user.index', [
            'data' => $paginationPresenter->render($ret),
        ]);
    }

    public function create()
    {
        return view('admin.user.user.create');
    }

    public function store(UserRequest $request, CreatedUseCase $uc)
    {
        $resp = $uc->handle(new CreatedInput(
            name: $request->name,
            login: new LoginInputObject($request->login),
            password: $request->password,
        ));

        return redirect()->route('user.index')
            ->with('success', 'Usuário cadastrado com sucesso')
            ->with('model', $resp);
    }

    public function show($id, FindUseCase $uc)
    {
        $resp = $uc->handle(new FindInput($id));
        return view('admin.user.user.show', [
            'model' => $resp,
        ]);
    }

    public function edit($id, FindUseCase $uc)
    {
        $resp = $uc->handle(new FindInput($id));
        return view('admin.user.user.edit', [
            'model' => $resp,
        ]);
    }

    public function update(UserRequest $request, $id, UpdatedUseCase $uc)
    {
        $resp = $uc->handle(new UpdatedInput(
            id: $id,
            name: $request->name,
            login: new LoginInputObject($request->login),
        ));

        return redirect()->route('user.index')
            ->with('success', 'Usuário editado com sucesso')
            ->with('model', $resp);
    }

    public function destroy($id)
    {
        //
    }
}

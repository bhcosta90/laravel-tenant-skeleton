<?php

namespace App\Http\Controllers\Web;

use App\Filters\User\{EmailFilter, NameFilter};
use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\Presenters\PaginationPresenter;
use App\Http\Requests\UserRequest;
use Core\Modules\User\UseCases\{
    CreatedUseCase,
    DeleteUseCase,
    ListUseCase,
    FindUseCase,
    UpdatedUseCase,
    DTO\List\Input as ListInput,
    DTO\Created\Input as CreatedInput,
    DTO\Find\Input as FindInput,
    DTO\Updated\Input as UpdatedInput,
};
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(
        ListUseCase $uc,
        PaginationPresenter $paginationPresenter,
        Request $request,
        NameFilter $nameFilter,
        EmailFilter $emailFilter,
    ) {
        $ret = $uc->handle(new ListInput(filter: $request->all()));

        return view('admin.user.user.index', [
            'data' => $paginationPresenter->render($ret),
            'filter' => [$nameFilter, $emailFilter],
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
            login: $request->login,
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
            login: $request->login,
        ));

        return redirect()->route('user.index')
            ->with('success', 'Usuário editado com sucesso')
            ->with('model', $resp);
    }

    public function destroy($id, DeleteUseCase $uc)
    {
        $resp = $uc->handle(new FindInput($id, auth()->user()->id));

        return redirect()->route('user.index')
            ->with('success', 'Usuário deletado com sucesso')
            ->with('model', $resp);
    }
}

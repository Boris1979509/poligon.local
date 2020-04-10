<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\Users\UpdateRequest;
use App\Http\Requests\Admin\Users\CreateRequest;
use App\Models\User;
use App\UseCases\Auth\RegisterService;
use Illuminate\View\View;

class UsersController extends Controller
{

    private $register;

    /**
     * UsersController constructor.
     * @param RegisterService $register
     */
    public function __construct(RegisterService $register)
    {
        $this->register = $register;
        //$this->middleware('can:manage-users');
    }

    public function index(Request $request)
    {
        $query = User::orderByDesc('id');

        if (!empty($value = $request->get('id'))) {
            $query->where('id', $value);
        }

        if (!empty($value = $request->get('name'))) {
            $query->where('name', 'like', '%' . $value . '%');
        }

        if (!empty($value = $request->get('email'))) {
            $query->where('email', 'like', '%' . $value . '%');
        }

        if (!empty($value = $request->get('status'))) {
            $query->where('status', $value);
        }

        if (!empty($value = $request->get('role'))) {
            $query->where('role', $value);
        }

        $users = $query->paginate(20);

        $statuses = [
            User::STATUS_WAIT   => 'Waiting',
            User::STATUS_ACTIVE => 'Active',
        ];

        $roles = User::rolesList();

        return view('admin.users.index', compact('users', 'statuses', 'roles'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * @param CreateRequest $request
     * @return RedirectResponse
     */
    public function store(CreateRequest $request): RedirectResponse
    {
        $user = User::new(
            $request['name'],
            $request['email']
        );

        return redirect()->route('admin.users.show', $user);
    }

    /**
     * @param User $user
     * @return View
     */
    public function show(User $user): View
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * @param User $user
     * @return View
     */
    public function edit(User $user): View
    {
        $roles = User::rolesList();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * @param UpdateRequest $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, User $user): RedirectResponse
    {
        try {
            $user->update($request->only(['name', 'email']));
            //throw new QueryException('Database error');
        } catch (QueryException $er) {
            return back()->with('error', $er->getMessage());
        }


        if ($request['role'] !== $user->role) {
            $user->changeRole($request['role']);
        }

        return redirect()->route('admin.users.show', $user);
    }

    /**
     * @param User $user
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return redirect()->route('admin.users.index');
    }

    /**
     * @param User $user
     * @return RedirectResponse
     */
    public function verify(User $user): RedirectResponse
    {
        $this->register->verify($user->id);

        return redirect()->route('admin.users.show', $user);
    }
}

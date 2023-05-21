<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Users;
use App\Http\Requests\UserRequest;


class UserController extends Controller
{
    private Users $user;
    const PERPAGE = 4;

    public function __construct()
    {
        $this->user = new Users();
    }

    public function index(Request $request)
    {
//        $statement = $this->user->statementUser('select * from users where flag_deleted = false');
//        dd($statement);
        $title = 'List user';
        $filters = [];
        $keySearch = null;

        if (!empty($request->status)) {
            $status = $request->status;
            if ($status == 'active') {
                $status = 1;
            } else {
                $status = 0;
            }
            $filters[] = ['users.status', '=', $status];
        }

        if (!empty($request->group_id)) {
            $group_id = $request->group_id;
            $filters[] = ['users.group_id', '=', $group_id];
        }

        if (!empty($request->keySearch)) {
            $keySearch = $request->keySearch;
        }

        // handle logic sort
        $sortBy = $request->input('sort-by');
        $sortType = $request->input('sort-type');
        $allowSort = ['asc', 'desc'];
        if (!empty($sortType) && in_array($sortType, $allowSort)) {
            if ($sortType == 'desc') {
                $sortType = 'asc';
            } else {
                $sortType = 'desc';
            }
        } else {
            $sortType = 'asc';
        }
        $sortArr = [
            'sortBy' => $sortBy,
            'sortType' => $sortType,
        ];

        $userList = $this->user->getAllUsers($filters,
            $keySearch,
            $sortArr,
            self::PERPAGE);
//        $this->user->learnQueryBuilder();

        return view('clients.user.list', compact('title', 'userList', 'sortType'));
    }

    public function add()
    {
        $title = 'Add user';
        $groupList = getAllGroup();
        return view('clients.user.add', compact('title', 'groupList'));

    }

//    public function postAdd(Request $request)
    public function postAdd(UserRequest $request)
    {
//        $request->validate([
//            'fullname' => 'required|min:5',
//            'email' => 'required|email|unique:users',
//            'group_id' => ['required','integer', function ($attribute, $value, $fail) {
//                if ($value === 0) {
//                    $fail('Must choose group');
//                }
//            }],
//            'status' => 'required|integer'
//        ], [
//            'fullname.required' => 'Name not be required',
//            'fullname.min' => 'Name must be bigger than :min characters',
//            'email.required' => 'Email not be required',
//            'email.email' => 'Email must correct format email',
//            'email.unique' => 'Email exists',
//            'group_id.required' => 'Group not be required',
//            'group_id.integer' => 'Group no correctly',
//            'status.required' => 'Status not be required',
//            'status.integer' => 'Status no correctly',
//        ]);


        $dataInsert = [
            'fullname' => $request->fullname,
            'email' => $request->email,
            'group_id' => $request->group_id,
            'status' => $request->status,
            'create_at' => date('Y-m-d H:i:s')
        ];
        $this->user->addUser($dataInsert);
        return redirect(route('users.index'))->with('msg', 'Add user successfully');
    }

    public function getIdEdit($id, Request $request)
    {
        $title = 'Edit user';
        $groupList = getAllGroup();
        if (!empty($id)) {
            $userDetail = $this->user->findById($id);
            if (!empty($userDetail[0])) {
                $userDetail = $userDetail[0];
                $request->session()->put('id', $id);
            } else {
                return redirect(route('users.index'))->with('msg', 'User not found');
            }
        } else {
            return redirect(route('users.index'))->with('msg', 'URL not found');
        }

        return view('clients.user.edit', compact('title', 'userDetail', 'groupList'));
    }

    public function postEdit(UserRequest $request)
    {
        $id = session('id');
        if (empty($id)) {
            return back()->with('msg', 'URL not found');
        }
//        $request->validate([
//            'fullname' => 'required|min:5',
//            'email' => 'required|email|unique:users,email,'.$id,
//            'group_id' => ['required','integer', function ($attribute, $value, $fail) {
//                if ($value === 0) {
//                    $fail('Must choose group');
//                }
//            }],
//            'status' => 'required|integer'
//        ], [
//            'fullname.required' => 'Name not be required',
//            'fullname.min' => 'Name must be bigger than :min characters',
//            'email.required' => 'Email not be required',
//            'email.email' => 'Email must correct format email',
//            'email.unique' => 'Email exists',
//            'group_id.required' => 'Group not be required',
//            'group_id.integer' => 'Group no correctly',
//            'status.required' => 'Status not be required',
//            'status.integer' => 'Status no correctly',
//        ]);
        $dataUpdate = [
            'fullname' => $request->fullname,
            'email' => $request->email,
            'group_id' => $request->group_id,
            'status' => $request->status,
            'update_at' => date('Y-m-d H:i:s')
        ];
        $this->user->updateUser($dataUpdate, $id);
        return back()->with('msg', 'Edit successful');
    }

    public function deleteUser($id, Request $request)
    {
        if (!empty($id)) {
            $userDelete = $this->user->findById($id);
            if (!empty($userDelete[0])) {
                $dataDelete = [
                    'flag_deleted' => true
                ];
                $deleteStatus = $this->user->deleteUser($id, $dataDelete);
                if ($deleteStatus) {
                    $msg = 'Delete successful';
                } else {
                    $msg = 'Can not delete. Retry then!!';
                }
            } else {
                $msg = 'User not found';
            }
        } else {
            $msg = 'URL not found';
        }
        return redirect(route('users.index'))->with('msg', $msg);
    }
}

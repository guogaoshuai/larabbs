<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Handlers\ImageUploadHandler;
use App\Http\Requests\UserRequest;
use App\Models\User;

class UsersController extends Controller
{

    /**
     * [___construct 进行权限校验]
     * @return [type] [description]
     */
    public function ___construct()
    {
        $this->Middleware('auth', ['except' => ['show']]);
    }

    /**
     * [show 显示用户]
     * @param  User   $user [description]
     * @return [type]       [description]
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * [update 修改用户]
     * @return [type] [description]
     */
    public function update(UserRequest $request, User $user)
    {
        $this->authorize('update', $user);
        $data = $request->all();
        if ($request->file('avater')) {
            $file   = new ImageUploadHandler();
            $result = $file->save($request->file('avater'), 'avatars', $user->id, 326);
            if ($result) {
                $data['avater'] = $result['path'];
            }
        }

        $user->update($data);
        return redirect()->route('users.show', $user->id)->with('success', '个人资料更新成功！');

    }

    /**
     * [edit 编辑]
     * @return [type] [description]
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user); //进行策略验证
        return view('users.edit', compact('user'));

    }
}
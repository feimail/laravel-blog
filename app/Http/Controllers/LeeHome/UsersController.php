<?php

namespace App\Http\Controllers\LeeAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Handlers\ImageUploadHandler;
use App\Policies\UserPolicy;

class UsersController extends Controller
{

    public function __construct()
    {
      $this->middleware('auth');
    }
    //编辑页面
    public function edit(User $user)
    {
        return view('lee_admin/users/edit',compact('user'));
    }
    //修改
    public function update(UserRequest $request,ImageUploadHandler $uploader,User $user)
    {
        //验证 只能自己操作自己的数据
        $this->authorize('update', $user);
        $data = $request->all();

        if ($request->avatar) {
            $result = $uploader->save($request->avatar, 'avatars', $user->id, 362);
            if ($result) {
                $data['avatar'] = $result['path'];
            }
        }
        $user->update($data);
        return redirect()->route('users.edit', $user->id)->with('success', '个人资料更新成功！');
    }
}

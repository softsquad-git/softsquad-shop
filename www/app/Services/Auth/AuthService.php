<?php

namespace App\Services;

use App\Helpers\Conf;
use App\Helpers\Role;
use App\Helpers\VerificationEmail;
use App\Mail\Auth\Welcome;
use App\Models\Users\SpecificData;
use App\User;
use Dotenv\Exception\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use \Exception;
use Illuminate\Support\Facades\Mail;

class AuthService
{

    /**
     * @param array $data
     * @return bool
     * @throws Exception
     */
    public function registerUser(array $data)
    {
        $conf = Conf::get();
        $isAcceptNewUser = $conf->is_accept_new_user;
        if ($isAcceptNewUser == 0)
            $data['is_activate'] = 1;
        DB::beginTransaction();
        try {
            $data['password'] = Hash::make($data['password']);
            $data['role'] = Role::SS_R_USER;
            $user = User::create($data);
        } catch (ValidationException $e) {
            DB::rollBack();
            throw new Exception(trans('auth.user.createdError'));
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
        try {
            $data['user_id'] = $user->id;
            SpecificData::create($data);
        } catch (ValidationException $e) {
            DB::rollBack();
            throw new Exception(trans('auth.user.createdError'));
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
        if ($isAcceptNewUser == 1) {
            try {
                VerificationEmail::sendEmail($user->email);
            } catch (ValidationException $e) {
                DB::rollBack();
                throw new Exception(trans('auth.user.errorSendEmail'));
            } catch (Exception $e) {
                DB::rollBack();
                throw $e;
            }
        } else {
            Mail::to($user->email)->send(new Welcome());
        }
        DB::commit();
        return true;
    }
}

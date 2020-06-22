<?php

namespace App\Services;

use App\Helpers\Role;
use App\Mail\Conf\RegisterAdminMail;
use App\Models\Conf\Configuration;
use App\Models\Users\SpecificData;
use App\Repositories\ConfigurationRepository;
use App\User;
use Dotenv\Exception\ValidationException;
use \Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ConfigurationService extends ConfigurationRepository
{
    /**
     * @var ConfigurationRepository
     */
    private $configurationRepository;

    /**
     * @param ConfigurationRepository $configurationRepository
     */
    public function __construct(ConfigurationRepository $configurationRepository)
    {
        $this->configurationRepository = $configurationRepository;
    }

    /**
     * @param array $data
     * @return bool
     * @throws Exception
     */
    public function createPage(array $data)
    {
        $SSc = count($this->check());
        if ($SSc > 0)
            throw new Exception(trans('page.register.alreadyExists'));
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
        } catch (ValidationException $exception) {
            DB::rollBack();
            throw new Exception(trans('auth.user.createdError'));
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
        try {
            $data['g_admin_id'] = $user->id;
            Configuration::create($data);
        } catch (ValidationException $e) {
            DB::rollBack();
            throw new Exception(trans('page.register.error'));
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
        DB::commit();
        try {
            Mail::to(config('app.admin.email'))->send(new RegisterAdminMail());
        } catch (Exception $e) {
            throw new Exception(trans('page.register.sendEmail'));
        }
        return true;
    }
}

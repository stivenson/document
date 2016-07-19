<?php

namespace document\Repositories;

use document\User;
use InfyOm\Generator\Common\BaseRepository;
use Helpers\Image;
use Hash;

class UserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name','email'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return User::class;
    }

    /**
     * @param  array $input
     * @return mixed
     */
    public function register($input){

      $input['password'] = Hash::make($input['password']);
      $input['email'] = strtolower($input['email']);

      return $this->create($input);

    }


    /**
     * @param  array $input
     * @param  int $id
     * @return mixed
     */
    public function editRegister($input,$id){

        $user = $this->find($id);
        if(trim($input['password']) != ''){
          $input['password'] = Hash::make($input['password']);
        }

        $input['email'] = strtolower($input['email']);

        if (empty($user)) {
            return Response::json(ResponseUtil::makeError('User not found'), 404);
        }

        return $this->update($input, $id);

    }



    public function validateRepeatUser($user){

      $arr = $this->findWhere(['email'=>$user]);

      if( count($arr) > 0 ){
        return true;
      }else{
        return false;
      }

    }

}

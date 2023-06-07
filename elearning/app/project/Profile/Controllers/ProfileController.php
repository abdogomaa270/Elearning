<?php

namespace App\project\Profile\Controllers;

use App\project\Profile\Services\ProfileService;

class ProfileController
{
    private ProfileService $ProfileService ;
    public function __construct(ProfileService $ProfileService) {

        $this->ProfileService = $ProfileService;
    }
    public function setCerificate($id){
        return $this->ProfileService->setCerificate($id);
    }
    public function getMyCertificates(){
        return $this->ProfileService->getMyCertificates();
    }
    public function getMyCourses(){
        return $this->ProfileService->getMyCourses();
    }
    public function myData(){
        return $this->ProfileService->myData();
    }



}

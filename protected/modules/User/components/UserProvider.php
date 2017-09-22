<?php

/**
 * class UserProvider provides data from interconnected modules.
 *
 * @author Victor Martin <vectormartin@gmail.com>
 */
class UserProvider
{

    /**
     * @return all departments.
     **/
    public static function getDepartments()
    {
        $departments = array();
        $module = Yii::app()->getModule('Clasificator');
        if ($module) {
            $departments = Department::model()->findAll();
        }
        return $departments;
    }

    public static function getDepartmentName($id)
    {
        $department = self::getDepartment($id);
        if ($department) {
            return $department->name;
        } else {
            return null;
        }
    }

    /**
     * @return department based on a given $id
     **/
    public static function getDepartment($id)
    {
        $department = null;
        $module = Yii::app()->getModule('Clasificator');
        if ($module) {
            $department = Department::model()->findByPk($id);
        }
        return $department;
    }

    public static function getSubsidiaries()
    {
        $subsidiaries = array();
        $module = Yii::app()->getModule('Clasificator');
        if ($module) {
            $subsidiaries = Subsidiary::model()->findAll();
        }
        return $subsidiaries;
    }

    public static function getSubsidiaryName($id)
    {
        $subsidiary = self::getSubsidiary($id);
        if ($subsidiary) {
            return $subsidiary->name;
        } else {
            return null;
        }
    }

    public static function getSubsidiary($id)
    {
        $subsidiary = null;
        $module = Yii::app()->getModule('Clasificator');
        if ($module) {
            $subsidiary = Subsidiary::model()->findByPk($id);
        }
        return $subsidiary;
    }

    public static function getServices()
    {
        $services = array();
        $servicesModule = Yii::app()->getModule('Services');
        if ($servicesModule) {
            $services = Service::model()->findAll();
        }
        return $services;
    }

    public static function getServiceName($id)
    {
        $service = self::getService($id);
        if ($service) {
            return $service->name;
        } else {
            return null;
        }
    }

    public static function getService($id)
    {
        $service = null;
        $servicesModule = Yii::app()->getModule('Services');
        if ($servicesModule) {
            $service = Service::model()->findByPk($id);
        }
        return $service;
    }

    public static function getServiceCategories()
    {
        $categories = array();
        $servicesModule = Yii::app()->getModule('Services');
        if ($servicesModule) {
            $categories = ServiceCategory::model()->findAll();
        }
        return $categories;
    }

    public static function getServiceCategoryName($id)
    {
        $category = self::getServiceCategory($id);
        if ($category) {
            return $category->name;
        } else {
            return null;
        }
    }

    public static function getServiceCategory($id)
    {
        $category = null;
        $servicesModule = Yii::app()->getModule('Services');
        if ($servicesModule) {
            $category = ServiceCategory::model()->findByPk($id);
        }
        return $category;
    }
}
<?php

require_once 'database/db_connect.php';

class User
{
    private $chatID;

    public function __construct($chatID)
    {
        $this->chatID = $chatID;

        if (!$this->isUserSet()) $this->makeUser();
    }
//    public function makeAdmin(){
//        global $db;
//
//        $admin_name = $this->getAdminName();
//        $admin_id  = $this->getAdminId();
//
//
//        $query = "insert into `admin`(name,chat_id) values('{$admin_name}',{$admin_id})";
//
//        if (!$db->query($query))
//
//            die("пользователя создать не удалось");
//
//    }
    function setShowLang($data)
    {

        $this->setKeyValue('showlang', $data);

    }

    function getShowLang()
    {

        return $this->getKeyValue('showlang');

    }
    function setAddPhone($data)
    {

        $this->setKeyValue('addPhone', $data);

    }

    function getAddPhone()
    {

        return $this->getKeyValue('addPhone');

    }
    function setSubject($data)
    {

        $this->setKeyValue('subject', $data);

    }

    function getSubject()
    {

        return $this->getKeyValue('subject');

    }
    function setMap($data)
    {

        $this->setKeyValue('map', $data);

    }

    function getMap()
    {

        return $this->getKeyValue('map');

    }
    function setUniver($name){

        $this->setKeyValue('university',$name);

    }
    function getUniver(){

       return  $this->getKeyValue('university');
    }
    function setYear($year){

      $this->setKeyValue('year',$year);

    }
    function getYear(){

      return  $this->getKeyValue('year');

    }
    private function makeUser()
    {

        global $db;

        $chatID = $db->real_escape_string($this->chatID);


        $query = "insert into `users`(chatID) values('{$chatID}')";

        if (!$db->query($query))

            die("пользователя создать не удалось");

    }
    private function isUserSet()
    {

        global $db;

        $chatID = $db->real_escape_string($this->chatID);


        $result = $db->query("select * from `users` where chatID='$chatID' LIMIT 1");

        $myArray = (array)($result->fetch_array());

        if (!empty($myArray)) return true;

        return false;

    }
    function setProduct($product)
    {

        $this->setKeyValue('product', json_encode($product, JSON_UNESCAPED_UNICODE));

    }

    function getProduct()
    {

        return json_decode($this->getKeyValue('product'), true);

    }


    function setLanguage($lang)
    {

        $this->setKeyValue('lang', $lang);

    }

    function getLanguage()
    {

        return $this->getKeyValue('lang');

    }

    function setPage($page)
    {

        return $this->setKeyValue('page', $page);

    }

    function getPage()
    {

        return $this->getKeyValue('page');

    }
    function setCategoryId($category)
    {

        $this->setKeyValue('categoryId', $category);

    }

    function getCategoryId()
    {

        return $this->getKeyValue('categoryId');

    }

    function setYearSubject($data)
    {

        $this->setKeyValue('subject_year', $data);

    }

    function getYearSubject()
    {

        return $this->getKeyValue('subject_year');

    }

    function setCourse($data)
    {

        $this->setKeyValue('course', $data);

    }

    function getCourse()
    {

        return $this->getKeyValue('course');

    }
    function setPhoneNumber($phoneNumber)
    {

        $this->setKeyValue('phoneNumber', $phoneNumber);

    }

    function getPhoneNumber()
    {

        return $this->getKeyValue('phoneNumber');

    }
    function setFirstName($data)
    {

        $this->setKeyValue('firstName', $data);

    }

    function getFirstName()
    {

        return $this->getKeyValue('firstName');

    }
    function setOrderType($orderType)
    {

        $this->setKeyValue('orderType', $orderType);

    }

    function setZavuchYear($data)
    {

        $this->setKeyValue('zavuch_year', $data);

    }

    function getZavuchYear()
    {

        return $this->getKeyValue('zavuch_year');

    }
    function getOrderType()
    {

        return $this->getKeyValue('orderType');

    }



    function setKeyValue($key, $value)
    {

        global $db;

        $chatID = $db->real_escape_string($this->chatID);

        $value = base64_encode($value);

        if (!$this->isUserSet()) {

            $this->makeUser(); // если каким-то чудом этот пользователь не зарегистрирован в базе

        }

        $data = $this->getData();

        $data[$key] = $value;

        $data = json_encode($data, JSON_UNESCAPED_UNICODE);

        return $db->query("update `users` SET data_json = '{$data}' WHERE chatID = '{$chatID}'"); // обновляем запись в базе

    }

    function getKeyValue($key)
    {

        $data = $this->getData();

        if (array_key_exists($key, $data)) {

            return base64_decode($data[$key]);

        }

        return "";


    }

    private function getData()
    {

        global $db;

        $res = array();

        $chatID = $db->real_escape_string($this->chatID);

        $result = $db->query("select * from `users` where chatID='$chatID'");

        $arr = $result->fetch_assoc();

        if (isset($arr['data_json'])) {

            $res = json_decode($arr['data_json'], true);

        }


        return $res;

    }
    public function getUsers(){
        global $db;
        $res = array();
        $result = $db->query("select*from `users`");
        while($row = $result->fetch_assoc()) {
            if(isset($row['data_json']) && isset($row['chatID'])){
                array_push($res,$row);
            }
        }
        return $res;
    }

}
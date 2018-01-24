<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/11/10 0010
 * Time: 9:50
 */

namespace App;


class RegexTool
{
    private $validate = array(
        'require' => '/.+/',
        'email' => '/^\w+(\.\w)*@\w+(\.\w+)+$/',
        'url' => '/^(https?://)?(\w+\.)+[a-zA-Z]+(/\w+)*(\?\w+=.*)*$/',
        'number' => '/^\d+$/',
        'mobile' => '/^1[34578]\d{9}/$'
    );

    private $returnMatchResult = false;
    private $fixMode = null;
    private $matches = array();
    private $isMatch = false;


    public function __construct($returnMatchResult = false, $fixMode = null)
    {
        $this->returnMatchResult = $returnMatchResult;
        $this->fixMode = $fixMode;
    }

    private function regex($pattern, $subject)
    {
        if (array_key_exists(strtolower($pattern), $this->validate)) {
            $pattern = $this->validate[$pattern] . $this->fixMode;
        }

        $this->returnMatchResult ?
            preg_match_all($pattern, $subject, $this->matches) :
            $this->isMatch = preg_match($pattern, $subject) === 1;

        return $this->getRegexReturn();
    }

    private function getRegexReturn()
    {
        if ($this->returnMatchResult) {
            return $this->matches;
        } else {
            return $this->isMatch;
        }
    }

    public function toggleReturnType($bool = null)
    {
        if (empty($bool)) {
            $this->returnMatchResult = !$this->returnMatchResult;
        } else {
            $this->returnMatchResult = is_bool($bool) ? $bool : (bool)$bool;
        }
    }

    public function setFixMode($fixMode)
    {
        $this->fixMode = $fixMode;
    }

    public function noEmpty($str)
    {
        return $this->regex('require', $str);
    }

    public function isEmail($email)
    {
        return $this->regex('email', $email);
    }

    public function isMobile($mobile)
    {
        return $this->regex('mobile', $mobile);
    }

    public function check($pattern, $subject)
    {
        return $this->regex($pattern, $subject);
    }
}

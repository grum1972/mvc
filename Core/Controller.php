<?php
namespace Core;
use App\Models\User;

class Controller {
    /** @var View */
    public $view;
    /** @var Session */
    protected $session;
    /** @var bool  */
    protected $_render=true;
    protected $tpl = null;

    public function getUser(): ?User
    {
        $userId = $this->session->getUserId();
        if (!$userId) {
            return null;
        }

        $user = User::getById($userId);
        if (!$user) {
            return null;
        }

        return $user;
    }

    public function getUserId()
    {
        if ($user = $this->getUser()) {
            return $user->getId();
        }

        return false;
    }
    public function getTpl()
    {
        return $this->tpl;
    }
    public function setSession(Session $session)
    {
        $this->session = $session;
    }

    /**
     * @return bool
     */
    public function needRender(): bool
    {
        return $this->_render;
    }

    public function exitAction()
    {
        $this->_render = false;
        $this->session->exit();
        $this->tpl = 'mvc/';
    }

    /** @var array  */
    protected $_jsonData = [];

    public function json()
    {
        header('Content-type: application/json');
        echo json_encode($this->_jsonData);
    }

}
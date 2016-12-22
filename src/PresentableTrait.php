<?php

namespace KennedyTedesco\Presenter;

use KennedyTedesco\Presenter\Interfaces\PresenterInterface;
use KennedyTedesco\Presenter\Exceptions\PresenterException;
use KennedyTedesco\Presenter\Interfaces\PresentableInterface;

trait PresentableTrait
{
    /**
     * @var null|PresenterInterface
     */
    private $_presenter;

    /**
     * @return PresenterInterface|null
     * @throws PresenterException
     */
    public function present()
    {
        if ($this->_presenter) {
            return $this->_presenter;
        }

        if ($this instanceof PresentableInterface) {
            $class = $this->presenter();
            $presenter = new $class($this);

            if (! $presenter instanceof PresenterInterface) {
                throw new PresenterException('You need to set a valid presenter class.');
            }

            return $this->_presenter = $presenter;
        }

        throw new PresenterException('You must set the presenter() method on ' . get_class($this));
    }
}

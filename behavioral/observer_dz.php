<?php

/**
 * PHP имеет несколько встроенных интерфейсов, связанных с паттерном
 * Наблюдатель.
 *
 * Вот как выглядит интерфейс Издателя:
 *
 * @link http://php.net/manual/ru/class.splsubject.php
 *
 *     interface SplSubject
 *     {
 *         // Присоединяет наблюдателя к издателю.
 *         public function attach(SplObserver $observer);
 *
 *         // Отсоединяет наблюдателя от издателя.
 *         public function detach(SplObserver $observer);
 *
 *         // Уведомляет всех наблюдателей о событии.
 *         public function notify();
 *     }
 *
 * Также имеется встроенный интерфейс для Наблюдателей:
 *
 * @link http://php.net/manual/ru/class.splobserver.php
 *
 *     interface SplObserver
 *     {
 *         public function update(SplSubject $subject);
 *     }
 */

/**
 * Издатель владеет некоторым важным состоянием и оповещает наблюдателей о его
 * изменениях.
 */
class Subject implements \SplSubject
{
    /**
     * @var int Для удобства в этой переменной хранится состояние Издателя,
     * необходимое всем подписчикам.
     */
    public $state;

    /**
     * @var \SplObjectStorage Список подписчиков. В реальной жизни список
     * подписчиков может храниться в более подробном виде (классифицируется по
     * типу события и т.д.)
     */
    private $observers;

    public function __construct()
    {

        $this->observers = new \SplObjectStorage();
    }

    /**
     * Методы управления подпиской.
     */
    public function attach(\SplObserver $observer) : void
    {

        echo "Subject: Attached an observer.<br/>";
        $this->observers->attach($observer);
    }

    public function detach(\SplObserver $observer) : void
    {

        $this->observers->detach($observer);
        echo "Subject: Detached an observer.<br/>";
    }

    /**
     * Запуск обновления в каждом подписчике.
     */
    public function notify() : void
    {

        echo "Subject: Notifying observers...<br/>";
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }

    /**
     * Обычно логика подписки – только часть того, что делает Издатель. Издатели
     * часто содержат некоторую важную бизнес-логику, которая запускает метод
     * уведомления всякий раз, когда должно произойти что-то важное (или после
     * этого).
     */
    public function someBusinessLogic() : void
    {

        echo "<br/>Subject: I'm doing something important.<br/>";
        $this->state = rand(0, 10);

        echo "Subject: My state has just changed to: {$this->state}<br/>";
        $this->notify();
    }
}

/**
 * Конкретные Наблюдатели реагируют на обновления, выпущенные Издателем, к
 * которому они прикреплены.
 */
class ConcreteObserverA implements \SplObserver
{
    private $name;
    private $email;
    private $experience;
    
    public function __construct( $name, $email, $experience)
    {

        $this->name = $name;
        $this->email = $email;
        $this->experience = $experience;
    }
    
    public function update(\SplSubject $subject) : void
    {

            $name = $this->name;
            echo "Получено уведомление:  $name <br/>";
       
    }
}



/**
 * Клиентский код.
 */

$subject = new Subject();

$o1 = new ConcreteObserverA("Alexs","ffff","1");
$subject->attach($o1);

$o2 = new ConcreteObserverA("Nikolay","rrrr","3");
$subject->attach($o2);

$o3 = new ConcreteObserverA("Andrey","yyyy","4");
$subject->attach($o3);

$subject->someBusinessLogic();

//отписался от получения уведомлений
$subject->detach($o2);

$subject->someBusinessLogic();

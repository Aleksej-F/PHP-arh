<?php

/**
 * Интерфейс Команды объявляет метод для выполнения команд.
 */
interface Command
{
    public function execute() : void;
}


/**
 *  есть и команды, которые делегируют более сложные операции другим объектам,
 * называемым «получателями».
 */
class ComplexCommand implements Command
{
    /**
     * @var Receiver
     */
    private $receiver;

    /**
     * Данные о контексте, необходимые для запуска методов получателя.
     */
    private $a;

    private $b;

    /**
     * Сложные команды могут принимать один или несколько объектов-получателей
     * вместе с любыми данными о контексте через конструктор.
     */
    public function __construct( $receiver,  $a,  $b=0)
    {

        $this->receiver = $receiver;
        $this->a = $a;
        $this->b = $b;
    }

    /**
     * Команды могут делегировать выполнение любым методам получателя.
     */
    public function execute() : void
    {
        echo "Выполняю операцию...<br/>";
       
        $this->receiver->doPerformingOperation($this->a, $this->b);
        $this->receiver->doLogging();
    }
}

/**
 * Классы Получателей .
 */
class Сopying
{
    public function doLogging() 
    {
         /**
             * логирование
             */
        echo "Выполнено копирование<br/>";
    }

    public function doPerformingOperation($a, $b) 
    {
            /**
             * логика - Сopying
             */
        echo "Сopying from $a before $b <br/>";
    }
}

class Delete
{
    public function doLogging() 
    {
         /**
             * логирование
             */
        echo "Выполнено удаление<br/>";
    }

    public function doPerformingOperation($a, $b) 
    {
            /**
             * логика - удаления
             */
        echo "Delete from $a before $b <br/>";
    }
}

class Paste
{
    public function doLogging() 
    {
         /**
             * логирование
             */
        echo "Выполнено вставить<br/>";
    }

    public function doPerformingOperation($a) 
    {
            /**
             * логика - вставить текст
             */
        echo "Paste from $a   <br/>";
    }
}

/**
 * Отправитель связан с одной или несколькими командами. Он отправляет запрос
 * команде.
 */
class Invoker
{
    /**
     * @var Command
     */
    private $onStart;

    /**
     * @var Command
     */
    private $onFinish;

    /**
     * Инициализация команд.
     */
    public function setOnStart(Command $command) : void
    {

        $this->onStart = $command;
    }

    public function setOnFinish(Command $command) : void
    {

        $this->onFinish = $command;
    }

    /**
     * Отправитель не зависит от классов конкретных команд и получателей.
     * Отправитель передаёт запрос получателю косвенно, выполняя команду.
     */
    public function doSomethingImportant() : void
    {

       
        if ($this->onStart instanceof Command) {
            $this->onStart->execute();
        }

        
        if ($this->onFinish instanceof Command) {
            $this->onFinish->execute();
        }
    }
}

/**
 * Клиентский код может параметризовать отправителя любыми командами.
 */
$invoker = new Invoker();
$receiver = new Сopying();
$invoker->setOnStart(new ComplexCommand($receiver, 10, 20));
$invoker->doSomethingImportant();
echo "<br/>";
$receiver = new Delete();
$invoker->setOnStart(new ComplexCommand($receiver, 20, 30));
$invoker->doSomethingImportant();
echo "<br/>";
$receiver = new Paste();
$invoker->setOnStart(new ComplexCommand($receiver, 40));
$invoker->doSomethingImportant();
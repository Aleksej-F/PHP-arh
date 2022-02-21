<?php


class Context
{
    
    private $strategy;

    
    public function __construct(Strategy $strategy)
    {

        $this->strategy = $strategy;
    }

 
    public function setStrategy(Strategy $strategy)
    {

        $this->strategy = $strategy;
    }

    /**
     * Вместо того, чтобы самостоятельно реализовывать множественные версии
     * алгоритма, Контекст делегирует некоторую работу объекту Стратегии.
     */
    public function doSomeBusinessLogic($summ, $phone) 
    {

        // ...

        echo "Проводим оплату<br/>";
        $result = $this->strategy->doAlgorithm($summ, $phone);
        echo "Оплата выполнена через: $result" . "<br/>";

        // ...
    }
}

/**
 * Интерфейс Стратегии объявляет операции, общие для всех поддерживаемых версий
 * некоторого алгоритма.
 *
 * Контекст использует этот интерфейс для вызова алгоритма, определённого
 * Конкретными Стратегиями.
 */
interface Strategy
{
    public function doAlgorithm($summ, $phone);
}

/**
 * Конкретные Стратегии реализуют алгоритм, следуя базовому интерфейсу
 * Стратегии. Этот интерфейс делает их взаимозаменяемыми в Контексте.
 */
class StrategyPaymentQiwi implements Strategy
{
    public function doAlgorithm( $summ, $phone) 
    {

        return "Qiwi сумма $summ, -   $phone";

       
    }
}

class StrategyPaymentYandex implements Strategy
{
    public function doAlgorithm($summ, $phone) 
    {

        return "Yandex сумма $summ, -   $phone";
    }
}

class StrategyPaymentWebMoney implements Strategy
{
    public function doAlgorithm($summ, $phone) 
    {

        
        return "WebMoney сумма $summ, -   $phone";
    }
}

/**
 * Клиентский код выбирает конкретную стратегию и передаёт её в контекст. Клиент
 * должен знать о различиях между стратегиями, чтобы сделать правильный выбор.
 */
$context = new Context(new StrategyPaymentQiwi());
echo "Оплата Qiwi.<br/>";
$context->doSomeBusinessLogic(1000, 545454545);

echo "<br/>";

echo "Оплата Yandex.<br/>";
$context->setStrategy(new StrategyPaymentYandex());
$context->doSomeBusinessLogic(1200, 6776767);

echo "<br/>";

echo "Оплата WebMoney.<br/>";
$context->setStrategy(new StrategyPaymentWebMoney());
$context->doSomeBusinessLogic(1500, 989898);